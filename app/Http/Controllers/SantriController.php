<?php

namespace App\Http\Controllers;

use App\Services\SantriService;
use App\Models\Santri;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Imports\SantriImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Validators\ValidationException;

class SantriController extends Controller
{
    protected $santriService;

    // Inject SantriService lewat Constructor
    public function __construct(SantriService $santriService)
    {
        $this->santriService = $santriService;
    }

    /**
     * Menampilkan daftar santri di halaman dashboard admin (Web)
     */
    public function index()
    {
        // Mengambil data santri yang sudah terpaginasi (10 data per halaman)
        $santris = $this->santriService->getAll(10);

        // Dioper ke halaman index CRUD admin santri
        return view('admin.santri.index', compact('santris'));
    }

    public function kelulusanHalaman()
    {
        // 1. Ambil Tahun Ajaran yang sedang aktif utama
        $tahunAktif = TahunAjaran::aktif()->first();
        $tahunAktifId = $tahunAktif?->id ?? 0;

        // 2. Ambil data santri yang global statusnya 'Diterima' 
        // DAN memiliki record di tabel 'kelas' dengan status 'Aktif' pada TA berjalan
        $santris = Santri::query()
            ->where('status', 'Pendaftaran Diterima') // Status global di tabel santris
            ->whereIn('id', function ($query) use ($tahunAktifId) {
                $query->select('santri_id')
                    ->from('kelas')
                    ->where('tahun_ajaran_id', $tahunAktifId)
                    ->where('status', 'Aktif') // Status plotting rombel di tabel kelas
                    ->whereNotNull('santri_id');
            })
            ->get()
            ->map(function ($santri) use ($tahunAktifId) {
                // Ambil informasi nama kelasnya untuk ditampilkan ke View
                $kelasRecord = \App\Models\Kelas::where('santri_id', $santri->id)
                    ->where('tahun_ajaran_id', $tahunAktifId)
                    ->where('status', 'Aktif')
                    ->first();

                $santri->kelas_terakhir = $kelasRecord?->kelas;
                return $santri;
            });

        return view('admin.santri.kelulusan', compact('santris'));
    }

    /**
     * Memproses kelulusan masal data santri terpilih
     */
    public function prosesKelulusan(Request $request)
    {
        $validated = $request->validate([
            'santri_ids' => 'required|array',
            'santri_ids.*' => 'integer|exists:santris,id',
            'aksi' => 'required',
            'tahun_lulus' => 'required|string|max:10'
        ], [
            'santri_ids.required' => 'Pilih minimal satu santri yang ingin diluluskan.'
        ]);

        DB::transaction(function () use ($validated) {
            // Update status santri masal menjadi alumni dan catat tahun kelulusannya
            Kelas::whereIn('santri_id', $validated['santri_ids'])->update([
                'status' => $validated['aksi'], // Sesuaikan jika string status kelulusan Anda berbeda (misal: 'lulus')
                'tahun_keluar' => $validated['tahun_lulus'] // Kolom pencatatan tahun keluar/alumni
            ]);
        });

        return redirect()->route('admin.kelulusan')
            ->with('success', count($validated['santri_ids']) . ' santri berhasil dideklarasikan sebagai alumni.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:3072', // Maksimal 3MB
        ], [
            'file_excel.required' => 'Silakan pilih file Excel terlebih dahulu.',
            'file_excel.mimes'    => 'Format file harus berupa .xlsx, .xls, atau .csv',
            'file_excel.max'      => 'Ukuran file maksimal adalah 3 Megabytes.'
        ]);

        try {
            Excel::import(new SantriImport, $request->file('file_excel'));

            return redirect()
                ->route('admin.santri.index')
                ->with('success', 'Data Berhasil disimpan.');
        } catch (ValidationException $e) {
            // 1. ERROR VALIDASI BARIS EXCEL (Menggunakan laravel-excel validation)
            $failures = $e->failures();
            $errorMessages = [];

            foreach ($failures as $failure) {
                // Menghimpun error: "Baris 3 (Kolom nisn): NISN sudah terdaftar di sistem."
                $errorMessages[] = "Baris {$failure->row()} (Kolom {$failure->attribute()}): " . implode(', ', $failure->errors());
            }

            return redirect()
                ->back()
                ->withErrors(['file_excel' => $errorMessages])
                ->withInput();
        } catch (\Throwable $e) {
            // 2. ERROR TEKNIS SISTEM / FORMAT HEADER CORRUPT
            // Menggunakan $e->getMessage() untuk mendapatkan error aslinya secara ringkas
            $technicalError = $e->getMessage();

            return redirect()
                ->back()
                ->withErrors([
                    'file_excel' => "Gagal memproses file. Pesan Sistem: '{$technicalError}'. Pastikan susunan header kolom sesuai template."
                ])
                ->withInput();
        }
    }

    /**
     * Menampilkan formulir tambah santri baru
     */
    public function create()
    {
        return view('admin.santri.create');
    }

    /**
     * Menyimpan data santri baru dari formulir
     */
    public function store(Request $request)
    {
        // Validasi input data sesuai skema database
        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'nisn'           => 'required|string|size:10|unique:santris,nisn',
            'nism'           => 'required|string|unique:santris,nism',
            'no_bpjs'        => 'nullable|string',
            'asal_sekolah'   => 'required|string|max:255',
            'nama_orang_tua' => 'required|string|max:255',
            'nomor_whatsapp' => 'required|string|max:20',
            'status'         => 'required|in:diterima,ditolak',
        ]);

        // Kirim array tervalidasi ke service layer
        $this->santriService->store($validated);

        return redirect()
            ->route('admin.santri.index')
            ->with('success', 'Data santri berhasil ditambahkan ke sistem.');
    }

    /**
     * Menampilkan formulir edit/ubah data santri
     */
    public function edit($id)
    {
        $santri = $this->santriService->findById($id);

        return view('admin.santri.edit', compact('santri'));
    }

    /**
     * Memperbarui data santri di database
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'nisn'           => 'required|string|size:10|unique:santris,nisn,' . $id,
            'nism'           => 'required|string|unique:santris,nism,' . $id,
            'no_bpjs'        => 'nullable|string',
            'asal_sekolah'   => 'required|string|max:255',
            'nama_orang_tua' => 'required|string|max:255',
            'nomor_whatsapp' => 'required|string|max:20',
            'status'         => 'required|in:diterima,ditolak',
        ]);

        $this->santriService->update($id, $validated);

        return redirect()
            ->route('admin.santri.index')
            ->with('success', 'Data profil santri berhasil diperbarui.');
    }

    /**
     * Menghapus data santri dari sistem
     */
    public function destroy($id)
    {
        $this->santriService->delete($id);

        return redirect()
            ->route('admin.santri.index')
            ->with('success', 'Data santri telah berhasil dihapus dari database.');
    }

    /**
     * Menampilkan halaman cek kelulusan publik (Front-end)
     */
    public function kelulusan()
    {
        return view('kelulusan');
    }

    /**
     * Memproses pengecekan kelulusan berdasarkan input form NISN
     */
    public function periksa(Request $request)
    {
        $request->validate([
            'nomor_induk' => 'required|numeric|digits:10',
        ], [
            'nomor_induk.required' => 'NISN wajib diisi.',
            'nomor_induk.numeric'  => 'NISN harus berupa angka.',
            'nomor_induk.digits'   => 'NISN harus berjumlah tepat 10 digit.',
        ]);

        // Memanggil logika pengecekan dari SantriService
        $hasil = $this->santriService->periksaKelulusan($request->nomor_induk);

        return redirect()->back()->with([
            'hasil_cek'   => true,
            'status'      => $hasil['status_code'],
            'santri_data' => $hasil['data']
        ]);
    }
}
