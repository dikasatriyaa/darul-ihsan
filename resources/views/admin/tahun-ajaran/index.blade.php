<x-admin-layout>
    <x-slot:title>Tahun Ajaran</x-slot:title>
    <x-slot:pageHeader>Pengaturan Periode Akademik</x-slot:pageHeader>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
            <h3 class="font-bold text-slate-800 text-base mb-1">Tambah Tahun Ajaran</h3>
            <p class="text-xs text-slate-400 mb-4">Buat rentang kalender akademik baru untuk instansi pesantren.</p>

            <form action="{{ route('admin.tahun-ajaran.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Identitas Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" required placeholder="Contoh: 2026/2027 Ganjil"
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:outline-hidden focus:border-red-500 transition text-sm">
                    @error('tahun_ajaran')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold py-3 px-4 rounded-xl transition shadow-xs flex items-center justify-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Periode
                </button>
            </form>
        </div>

        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="p-4 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 text-sm">Riwayat Kalender Akademik</h3>
            </div>

            @if (session('success'))
                <div class="bg-emerald-50 border-b border-emerald-100 text-emerald-700 text-xs px-4 py-3">
                    <i class="fa-solid fa-circle-check mr-1.5"></i> {{ session('success') }}
                </div>
            @endif

            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-slate-50 border-b border-slate-200 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3 px-6">Tahun Ajaran</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        <th class="py-3 px-6 text-right">Opsi Sakral</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($tahunAjarans as $ta)
                        <tr class="{{ $ta->is_active ? 'bg-emerald-50/40' : '' }} transition">
                            <td
                                class="py-4 px-6 font-semibold {{ $ta->is_active ? 'text-emerald-900' : 'text-slate-900' }}">
                                {{ $ta->tahun_ajaran }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if ($ta->is_active)
                                    <span
                                        class="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 rounded-md text-[11px] font-black border border-emerald-200 uppercase tracking-wide">
                                        Aktif Berjalan
                                    </span>
                                @else
                                    <span
                                        class="px-2.5 py-0.5 bg-slate-100 text-slate-400 rounded-md text-[11px] font-medium border border-slate-200">
                                        Non-Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                @if (!$ta->is_active)
                                    <form action="{{ route('admin.tahun-ajaran.aktifkan', $ta->id) }}" method="POST"
                                        onsubmit="return confirm('Mengubah Tahun Ajaran aktif akan memindahkan plotting rombel ke periode baru. Lanjutkan?')">
                                        @csrf
                                        <button type="submit"
                                            class="text-xs bg-amber-500 hover:bg-amber-600 text-white font-semibold py-1.5 px-3 rounded-lg transition shadow-2xs">
                                            Aktifkan
                                        </button>
                                    </form>
                                @else
                                    <span
                                        class="text-xs text-emerald-600 font-bold italic flex items-center justify-end gap-1">
                                        <i class="fa-solid fa-circle-check"></i> Utama
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-8 text-center text-slate-400 italic">Belum ada rekaman tahun
                                ajaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if (method_exists($tahunAjarans, 'hasPages') && $tahunAjarans->hasPages())
                <div class="p-4 bg-slate-50 border-t border-slate-100">
                    {{ $tahunAjarans->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
