<?php

namespace App\Services;

use App\Models\Santri;
use Illuminate\Support\Facades\DB;

class SantriService
{
    public function getAll($perPage = 10)
    {
        return Santri::query()
            ->select('id', 'nama', 'asal_sekolah', 'nama_orang_tua', 'nomor_whatsapp', 'nisn', 'nism', 'status')
            ->with([
                // Mengambil relasi kelas Many-to-Many dengan aman tanpa select yang merusak pivot
                'kelas' => function ($q) {
                    $q->select('kelas.id', 'kelas', 'tahun_ajaran_id', 'is_active')
                        ->with(['tahunAjaran:id,tahun_ajaran']);
                }
            ])
            ->latest()
            ->paginate($perPage);
    }


    public function findById($id)
    {
        return Santri::with([
            'kelas.tahunAjaran'
        ])
            ->findOrFail($id);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Santri::create($data);
        });
    }

    public function update($id, array $data)
    {
        $santri = Santri::findOrFail($id);

        return DB::transaction(function () use ($santri, $data) {
            $santri->update($data);
            return $santri;
        });
    }

    public function delete($id)
    {
        $santri = Santri::findOrFail($id);
        return $santri->delete();
    }

    public function periksaKelulusan(string $nisn): array
    {
        // 1. Dapatkan Tahun Ajaran yang sedang aktif utama
        $tahunAktif = \App\Models\TahunAjaran::aktif()->first();
        $tahunAktifId = $tahunAktif?->id ?? 0;

        // 2. Ambil data santri beserta jembatan kelasnya pada TA berjalan
        $santri = Santri::with(['kelas' => function ($query) use ($tahunAktifId) {
            $query->where('tahun_ajaran_id', $tahunAktifId);
        }])->where('nisn', $nisn)->first();

        // 3. JIKA DATA SANTRI TIDAK DITEMUKAN
        if (!$santri) {
            return [
                'status_code' => 'tidak_ditemukan',
                'data'        => ['nisn' => $nisn]
            ];
        }

        // 4. JIKA STATUS PENDAFTARANNYA DITOLAK
        // Catatan: Sesuai migrasi enum Anda, gunakan huruf kecil 'ditolak'
        if ($santri->status === 'ditolak') {
            return [
                'status_code' => 'ditolak',
                'data'        => [
                    'nama' => $santri->nama,
                    'nisn' => $santri->nisn,
                ]
            ];
        }

        // 5. AMBIL DATA KELAS PERIODE INI DENGAN AMAN
        // Menggunakan operator null coalescing ?? jika relasi bernilai null
        $kelasAktif = $santri->kelas ? $santri->kelas->first() : null;

        // JIKA REKAMAN KELAS TIDAK ADA ATAU KOSONG
        if (!$kelasAktif) {
            return [
                'status_code' => 'kelas_tidak_aktif',
                'data'        => [
                    'nama' => $santri->nama,
                    'nisn' => $santri->nisn,
                ]
            ];
        }

        // 6. KEMBALIKAN DATA BERDASARKAN STATUS KELAS (aktif, naik, lulus, keluar)
        return [
            'status_code' => strtolower($kelasAktif->status),
            'data'        => [
                'nama'            => $santri->nama,
                'nisn'            => $santri->nisn,
                'nism'            => $santri->nism,
                'no_bpjs'         => $santri->no_bpjs ?? '-',
                'asal_sekolah'    => $santri->asal_sekolah,
                'nama_orang_tua'  => $santri->nama_orang_tua,
                'nomor_whatsapp'  => $santri->nomor_whatsapp,
                'nama_kelas'      => $kelasAktif->kelas,
                'tahun_keluar'    => $kelasAktif->tahun_keluar ?? '-',
                'tahun_ajaran'    => $tahunAktif?->tahun_ajaran ?? '-'
            ]
        ];
    }
}
