<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Santri;
use App\Models\TahunAjaran;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Tahun Ajaran yang sedang Aktif Utama
        $tahunAktif = TahunAjaran::aktif()->first();
        $tahunAktifId = $tahunAktif?->id ?? 0;

        // 2. Hitung Total Santri Keseluruhan
        $totalSantri = Santri::count();

        // 3. Hitung Berapa Rombel Unik yang Berjalan di Tahun Ajaran Ini
        $totalKelas = Kelas::where('tahun_ajaran_id', $tahunAktifId)
            ->distinct('kelas')
            ->count('kelas');

        // 4. Ambil Data Agregasi untuk Grafik Batang Distribusi Santri Per Kelas
        $rawKelas = Kelas::where('tahun_ajaran_id', $tahunAktifId)
            ->with('santri')
            ->get();

        // Olah data menggunakan laravel collection groupBy agar aman dari syntax SQL strict mode
        $grafikKelas = $rawKelas->groupBy('kelas')->map(function ($group, $namaKelas) {
            return (object) [
                'kelas' => $namaKelas,
                'total_santri' => $group->whereNotNull('santri_id')->count()
            ];
        })->values();

        return view('admin.dashboard', compact('totalSantri', 'totalKelas', 'tahunAktif', 'grafikKelas'));
    }
}
