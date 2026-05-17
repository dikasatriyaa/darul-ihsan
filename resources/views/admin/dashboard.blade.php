<x-admin-layout>
    <x-slot:title>Dashboard</x-slot:title>
    <x-slot:pageHeader>Ringkasan Informasi</x-slot:pageHeader>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Santri Aktif</p>
                <h3 class="text-3xl font-black text-slate-900">{{ $totalSantri }}</h3>
                <p class="text-[11px] text-slate-500">Terdaftar di sistem pangkalan data</p>
            </div>
            <div class="p-4 bg-red-50 text-red-600 rounded-xl text-xl">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Rombongan Belajar</p>
                <h3 class="text-3xl font-black text-slate-900">{{ $totalKelas }}</h3>
                <p class="text-[11px] text-slate-500">Kelas aktif pada periode ini</p>
            </div>
            <div class="p-4 bg-amber-50 text-amber-600 rounded-xl text-xl">
                <i class="fa-solid fa-school"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tahun Ajaran Aktif</p>
                <h3 class="text-xl font-bold text-emerald-600 truncate max-w-[180px]">
                    {{ $tahunAktif->tahun_ajaran ?? 'Belum Diatur' }}
                </h3>
                <span
                    class="inline-block text-[10px] font-bold bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-md uppercase mt-1">
                    <i class="fa-solid fa-circle-check mr-1"></i> Sistem Utama
                </span>
            </div>
            <div class="p-4 bg-emerald-50 text-emerald-600 rounded-xl text-xl">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col">
            <div class="mb-6">
                <h4 class="font-bold text-slate-800 text-sm">Grafik Distribusi Santri per Kelas</h4>
                <p class="text-xs text-slate-400">Visualisasi jumlah santri yang terplot pada tahun ajaran aktif.</p>
            </div>

            <div class="flex-1 flex items-end gap-4 h-64 pt-4 border-b border-l border-slate-100 px-2">
                @forelse($grafikKelas as $gfk)
                    @php
                        // Menghitung persentase tinggi batang agar proporsional (Max 100%)
                        $maxSantri = $grafikKelas->max('total_santri') ?: 1;
                        $persenTinggi = ($gfk->total_santri / $maxSantri) * 100;
                    @endphp
                    <div class="flex-1 flex flex-col items-center gap-2 group h-full justify-end">
                        <span
                            class="text-[10px] font-bold text-slate-700 opacity-0 group-hover:opacity-100 transition duration-200 bg-slate-100 px-1.5 py-0.5 rounded">
                            {{ $gfk->total_santri }}
                        </span>
                        <div style="height: {{ max($persenTinggi, 8) }}%;"
                            class="w-full bg-slate-900 group-hover:bg-red-600 rounded-t-lg transition-all duration-300 shadow-2xs">
                        </div>
                        <span class="text-[10px] font-semibold text-slate-500 truncate w-full text-center"
                            title="{{ $gfk->kelas }}">
                            {{ $gfk->kelas }}
                        </span>
                    </div>
                @empty
                    <div class="w-full h-full flex items-center justify-center text-xs text-slate-400 italic">
                        Belum ada data distribusi kelas untuk ditampilkan.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs space-y-4">
            <div>
                <h4 class="font-bold text-slate-800 text-sm">Akses Cepat Modul</h4>
                <p class="text-xs text-slate-400">Pintasan navigasi kilat manajemen akademik.</p>
            </div>

            <div class="space-y-2">
                <a href="{{ route('admin.santri.index') }}"
                    class="flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-red-200 hover:bg-red-50/20 transition group">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-slate-50 group-hover:bg-red-50 text-slate-600 group-hover:text-red-600 flex items-center justify-center text-xs transition">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <span class="text-xs font-semibold text-slate-700">Kelola Data Santri</span>
                    </div>
                    <i
                        class="fa-solid fa-chevron-right text-[10px] text-slate-300 group-hover:text-red-500 transition"></i>
                </a>

                <a href="{{ route('admin.kelas.index') }}"
                    class="flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-amber-200 hover:bg-amber-50/20 transition group">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-slate-50 group-hover:bg-amber-50 text-slate-600 group-hover:text-amber-600 flex items-center justify-center text-xs transition">
                            <i class="fa-solid fa-sliders"></i>
                        </div>
                        <span class="text-xs font-semibold text-slate-700">Plotting Anggota Kelas</span>
                    </div>
                    <i
                        class="fa-solid fa-chevron-right text-[10px] text-slate-300 group-hover:text-amber-500 transition"></i>
                </a>

                <a href="{{ route('admin.tahun-ajaran.index') }}"
                    class="flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50/20 transition group">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-slate-50 group-hover:bg-emerald-50 text-slate-600 group-hover:text-emerald-600 flex items-center justify-center text-xs transition">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <span class="text-xs font-semibold text-slate-700">Ganti Kalender Akademik</span>
                    </div>
                    <i
                        class="fa-solid fa-chevron-right text-[10px] text-slate-300 group-hover:text-emerald-500 transition"></i>
                </a>
            </div>
        </div>

    </div>
</x-admin-layout>
