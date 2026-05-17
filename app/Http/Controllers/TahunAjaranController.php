<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunAjaranController extends Controller
{
    /**
     * Menampilkan halaman utama split grid tahun ajaran
     */
    public function index()
    {
        // Mengambil semua data tahun ajaran, diurutkan dari yang terbaru
        $tahunAjarans = TahunAjaran::orderBy('id', 'desc')->get();

        // Mengambil tahun ajaran yang sedang aktif saat ini
        $tahunAktif = TahunAjaran::aktif()->first();

        return view('admin.tahun-ajaran.index', compact('tahunAjarans', 'tahunAktif'));
    }

    /**
     * Menyimpan data Tahun Ajaran baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_ajaran' => 'required|string|max:50|unique:tahun_ajarans,tahun_ajaran',
        ], [
            'tahun_ajaran.unique' => 'Identitas Tahun Ajaran tersebut sudah pernah terdaftar.'
        ]);

        // Cek jika ini adalah data pertama, otomatis kita set aktif saja
        $isFirstRecord = TahunAjaran::count() === 0;

        TahunAjaran::create([
            'tahun_ajaran' => $validated['tahun_ajaran'],
            'is_active' => $isFirstRecord ? true : false
        ]);

        return redirect()->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran baru berhasil ditambahkan ke kalender akademik.');
    }

    /**
     * Mengaktifkan satu periode dan otomatis mematikan periode lainnya (Aksi Sakral)
     */
    public function aktifkan($id)
    {
        DB::transaction(function () use ($id) {
            // 1. Matikan status aktif semua tahun ajaran yang ada saat ini
            TahunAjaran::where('is_active', true)->update(['is_active' => false]);

            // 2. Aktifkan tahun ajaran terpilih berdasarkan ID target
            $ta = TahunAjaran::findOrFail($id);
            $ta->update(['is_active' => true]);
        });

        return redirect()->route('admin.tahun-ajaran.index')
            ->with('success', 'Berhasil! Periode utama sistem sekarang berpindah.');
    }
}
