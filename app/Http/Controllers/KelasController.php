<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use App\Services\KelasService;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    protected $kelasService;

    public function __construct(KelasService $kelasService)
    {
        $this->kelasService = $kelasService;
    }

    public function index()
    {
        // 1. Ambil semua data terstruktur dari Service
        $data = $this->kelasService->getDataIndex();

        // 2. Cukup kirim array $data langsung. 
        // Di dalam view, Anda otomatis bisa memanggil $kelasGrouped, $santriTersedia, dll.
        return view('admin.kelas.index', $data);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas' => 'required|string|max:100',
            'wali_kelas_id' => 'required|integer',
            'santri_ids' => 'nullable|array'
        ]);

        $this->kelasService->store($validated);
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas baru berhasil dibuka.');
    }

    public function update(Request $request, $id)
    {
        // Digunakan untuk menambahkan santri satuan dari dalam modal detail
        $validated = $request->validate([
            'nama_kelas' => 'required|string',
            'santri_id' => 'required|integer'
        ]);

        $this->kelasService->addMember($validated);
        return redirect()->route('admin.kelas.index')->with('success', 'Santri berhasil digabungkan ke dalam kelas.');
    }

    public function destroy(Request $request, $id)
    {
        // Mendeteksi apakah menghapus 1 santri atau membubarkan 1 rombel penuh
        $mode = $request->input('mode', 'all');

        $this->kelasService->deleteRecord($id, $mode);

        $msg = $mode === 'single_santri' ? 'Santri berhasil dikeluarkan dari kelas.' : 'Rombongan belajar kelas berhasil dibubarkan.';
        return redirect()->route('admin.kelas.index')->with('success', $msg);
    }
}
