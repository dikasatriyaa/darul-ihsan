<?php

namespace App\Services;

use App\Models\Kelas;
use App\Models\Santri;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class KelasService
{
    public function getDataIndex(): array
    {
        $tahunAktif = TahunAjaran::aktif()->first();
        $tahunAktifId = $tahunAktif?->id ?? 0;

        // 1. Dapatkan daftar kelas unik beserta wali kelas dan kumpulan santri di dalamnya
        $rawKelas = Kelas::query()
            ->where('tahun_ajaran_id', $tahunAktifId)
            ->with(['waliKelas', 'santri'])
            ->get();

        // Kelompokkan berdasarkan nama kelas di level Collection
        $kelasGrouped = $rawKelas->groupBy('kelas')->map(function ($group) {
            $first = $group->first();
            return (object) [
                'kelas' => $first->kelas,
                // PERBAIKAN: Menggunakan ->name sesuai dengan skema tabel users Anda
                'wali_kelas_nama' => $first->waliKelas->name ?? 'Belum Ditunjuk',
                'total_santri' => $group->whereNotNull('santri_id')->count(),
                'santris' => $group->whereNotNull('santri_id')->map(function ($item) {
                    return [
                        'id' => $item->santri->id ?? 0,
                        'kelas_record_id' => $item->id, // ID primary key dari tabel kelas
                        'nama' => $item->santri->nama ?? 'Tanpa Nama',
                        'nisn' => $item->santri->nisn ?? '-'
                    ];
                })->values()->all()
            ];
        })->values();

        // 2. Ambil daftar guru untuk dropdown pilihan Wali Kelas di view
        $walikelas = User::query()->where('role', 'guru')->get();

        // 3. Ambil santri yang belum terdaftar di kelas manapun pada tahun ajaran aktif ini
        $santriTersedia = Santri::query()->whereNotExists(function ($query) use ($tahunAktifId) {
            $query->select(\Illuminate\Support\Facades\DB::raw(1))
                ->from('kelas')
                ->whereRaw('kelas.santri_id = santris.id')
                ->where('kelas.tahun_ajaran_id', $tahunAktifId);
        })->get();

        return compact('kelasGrouped', 'santriTersedia', 'walikelas', 'tahunAktif');
    }

    public function store(array $data): void
    {
        $tahunAktif = TahunAjaran::aktif()->first();
        if (!$tahunAktif) {
            throw new \Exception('Aktifkan Tahun Ajaran terlebih dahulu.');
        }

        DB::transaction(function () use ($data, $tahunAktif) {
            if (!empty($data['santri_ids'])) {
                // Jika user langsung memilih santri pas buat kelas baru
                foreach ($data['santri_ids'] as $santriId) {
                    Kelas::create([
                        'tahun_ajaran_id' => $tahunAktif->id,
                        'kelas'           => $data['kelas'],
                        'wali_kelas_id'   => $data['wali_kelas_id'],
                        'santri_id'       => $santriId
                    ]);
                }
            } else {
                // Buat baris kosong kelas jika belum ada santri yang dimasukkan
                Kelas::create([
                    'tahun_ajaran_id' => $tahunAktif->id,
                    'kelas'           => $data['kelas'],
                    'wali_kelas_id'   => $data['wali_kelas_id'],
                    'santri_id'       => null
                ]);
            }
        });
    }

    public function addMember(array $data): void
    {
        $tahunAktif = TahunAjaran::aktif()->first();

        // Cari informasi wali kelas terakhir dari nama kelas yang sama agar sinkron
        $existingKelas = Kelas::where('kelas', $data['nama_kelas'])
            ->where('tahun_ajaran_id', $tahunAktif->id)
            ->first();

        // Masukkan baris baru untuk santri tersebut di kelas ini
        Kelas::create([
            'tahun_ajaran_id' => $tahunAktif->id,
            'kelas'           => $data['nama_kelas'],
            'wali_kelas_id'   => $existingKelas?->wali_kelas_id,
            'santri_id'       => $data['santri_id']
        ]);
    }

    public function deleteRecord(string $idOrName, string $mode = 'all'): void
    {
        $tahunAktif = TahunAjaran::aktif()->first();
        $tahunAktifId = $tahunAktif?->id ?? 0;

        if ($mode === 'single_santri') {
            // Hapus baris plotting satu santri saja
            Kelas::findOrFail($idOrName)->delete();
        } else {
            // Hapus satu nama kelas (bubarkan kelas) untuk tahun ajaran aktif
            Kelas::where('kelas', $idOrName)
                ->where('tahun_ajaran_id', $tahunAktifId)
                ->delete();
        }
    }
}
