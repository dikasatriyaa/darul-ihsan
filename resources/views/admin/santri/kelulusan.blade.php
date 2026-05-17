<x-admin-layout>
    <x-slot:title>Kelulusan Santri</x-slot:title>
    <x-slot:pageHeader>Manajemen Kelulusan</x-slot:pageHeader>

    <div x-data="{
        selectedSantri: [],
        allIds: {{ json_encode($santris->pluck('id')->toArray()) }},
        toggleAll() {
            if (this.selectedSantri.length === this.allIds.length) {
                this.selectedSantri = [];
            } else {
                this.selectedSantri = [...this.allIds];
            }
        }
    }">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Proses Kelulusan Santri</h2>
                <p class="text-xs text-slate-500">Pilih santri yang telah menyelesaikan masa pendidikan untuk ditentukan
                    status kelulusannya.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3 rounded-xl mb-4">
                <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-700 text-sm px-4 py-3 rounded-xl mb-4">
                <i class="fa-solid fa-circle-exclamation mr-2"></i> {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.kelulusan.proses') }}" method="POST">
            @csrf

            <div class="bg-slate-50 border border-slate-200 p-4 rounded-2xl mb-4 flex flex-col lg:flex-row lg:items-center justify-between gap-4 transition-all"
                x-show="selectedSantri.length > 0" x-cloak x-transition>
                <div class="flex items-center gap-2 text-slate-700 text-sm">
                    <i class="fa-solid fa-user-graduate text-base text-slate-500"></i>
                    <span>Terpilih <strong x-text="selectedSantri.length" class="font-bold text-red-600"></strong>
                        santri untuk diproses.</span>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <input type="text" name="tahun_lulus" required placeholder="Tahun (Contoh: 2026)"
                        class="px-3 py-2 border border-slate-300 rounded-xl text-sm bg-white focus:outline-hidden focus:border-red-500 w-40">

                    <button type="submit" name="aksi" value="tidak lulus"
                        onclick="return confirm('Apakah Anda yakin menyatakan TIDAK LULUS bagi santri yang dipilih?')"
                        class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold py-2.5 px-4 rounded-xl transition shadow-xs flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-xmark"></i> Tidak Lulus
                    </button>

                    <button type="submit" name="aksi" value="lulus"
                        onclick="return confirm('Apakah Anda yakin ingin MELULUSKAN semua santri yang dipilih?')"
                        class="bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold py-2.5 px-4 rounded-xl transition shadow-xs flex items-center gap-1.5">
                        <i class="fa-solid fa-graduation-cap"></i> Proses Luluskan
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="py-4 px-6 w-12 text-center">
                                <input type="checkbox" @click="toggleAll()"
                                    :checked="selectedSantri.length === allIds.length && allIds.length > 0"
                                    class="rounded text-red-600 focus:ring-red-500 border-slate-300 w-4 h-4 cursor-pointer">
                            </th>
                            <th class="py-4 px-6">Nama Santri</th>
                            <th class="py-4 px-6">NISN / Identitas</th>
                            <th class="py-4 px-6 text-center">Kelas Saat Ini</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                        @forelse($santris as $santri)
                            <tr class="hover:bg-slate-50/80 transition"
                                :class="selectedSantri.includes({{ $santri->id }}) ? 'bg-slate-50' : ''">
                                <td class="py-4 px-6 text-center">
                                    <input type="checkbox" name="santri_ids[]" value="{{ $santri->id }}"
                                        x-model="selectedSantri"
                                        class="rounded text-red-600 focus:ring-red-500 border-slate-300 w-4 h-4 cursor-pointer">
                                </td>
                                <td class="py-4 px-6 font-semibold text-slate-900">{{ $santri->nama }}</td>
                                <td class="py-4 px-6 text-slate-500">{{ $santri->nisn ?? '-' }}</td>
                                <td class="py-4 px-6 text-center">
                                    <span
                                        class="bg-slate-100 text-slate-700 text-xs font-medium px-2.5 py-1 rounded-md">
                                        {{ $santri->kelas_terakhir ?? 'Tanpa Rombel' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-slate-400 italic">
                                    <i class="fa-solid fa-users-slash text-2xl block mb-2 text-slate-300"></i>
                                    Tidak ada data santri dengan status aktif saat ini untuk diluluskan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</x-admin-layout>
