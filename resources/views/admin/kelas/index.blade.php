<x-admin-layout>
    <x-slot:title>Manajemen Kelas</x-slot:title>
    <x-slot:pageHeader>Manajemen Kelas</x-slot:pageHeader>

    <div x-data="{
        openCreate: false,
        openDetail: false,
        detailNamaKelas: '',
        detailWaliKelas: '',
        detailKelasId: '',
        daftarSantri: []
    }">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Daftar Rombongan Belajar</h2>
                <p class="text-xs text-slate-500">Periode Aktif Utama:
                    <span class="font-bold text-red-600">{{ $tahunAktif->tahun_ajaran ?? 'Belum Ditentukan' }}</span>
                </p>
            </div>
            @if ($tahunAktif)
                <button @click="openCreate = true"
                    class="bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold py-2.5 px-4 rounded-xl transition shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Buka Kelas Baru
                </button>
            @endif
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3 rounded-xl mb-4">
                <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-4 px-6">Nama Kelas</th>
                        <th class="py-4 px-6">Wali Kelas / Ustadz</th>
                        <th class="py-4 px-6 text-center">Total Anggota</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($kelasGrouped as $item)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-6 font-semibold text-slate-900">{{ $item->kelas }}</td>
                            <td class="py-4 px-6 flex items-center gap-2">
                                <div
                                    class="w-7 h-7 bg-slate-100 rounded-full flex items-center justify-center text-slate-500 text-xs">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <span>{{ $item->wali_kelas_nama ?? 'Belum Ditunjuk' }}</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-red-50 text-red-700 text-xs font-bold px-2.5 py-1 rounded-lg">
                                    {{ $item->total_santri }} Santri
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-1">
                                <button
                                    @click="
                                    openDetail = true;
                                    detailNamaKelas = '{{ $item->kelas }}';
                                    detailWaliKelas = '{{ $item->wali_kelas_nama ?? 'Belum Ditunjuk' }}';
                                    detailKelasId = '{{ $item->kelas }}';
                                    daftarSantri = {{ json_encode($item->santris) }};
                                "
                                    class="text-slate-600 hover:text-blue-600 bg-slate-50 hover:bg-blue-50 text-xs font-medium py-1.5 px-3 rounded-lg transition">
                                    <i class="fa-solid fa-users mr-1"></i> Daftar Santri
                                </button>

                                <form action="{{ route('admin.kelas.destroy', $item->kelas) }}" method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Hapus seluruh rombel kelas ini? Semua santri di kelas ini akan dikeluarkan kembali ke daftar santri yang belum berkelas.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-slate-400 hover:text-red-600 p-1.5 transition"
                                        title="Bubarkan Kelas">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-slate-400 italic">
                                <i class="fa-solid fa-folder-open text-2xl block mb-2 text-slate-300"></i>
                                Belum ada kelas terdaftar pada periode aktif saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div x-show="openCreate" x-cloak
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center z-50 p-4">
            <div @click.outside="openCreate = false"
                class="bg-white rounded-2xl w-full max-w-xl shadow-xl flex flex-col max-h-[85vh]">
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800">Form Buka Kelas Baru</h3>
                    <button @click="openCreate = false" class="text-slate-400 hover:text-slate-600"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <form action="{{ route('admin.kelas.store') }}" method="POST"
                    class="overflow-y-auto p-6 space-y-4 flex-1">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Nama Ruang Kelas</label>
                        <input type="text" name="kelas" required placeholder="Misal: Kelas VII - B Mawaddah"
                            class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:outline-hidden focus:border-red-500 transition text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Pilih Wali Kelas</label>
                        <select name="wali_kelas_id" required
                            class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:outline-hidden focus:border-red-500 transition text-sm bg-white">
                            <option value="">-- Pilih Guru Pemimpin Rombel --</option>
                            @foreach ($walikelas as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Plotting Anggota Santri
                            Masal (Opsional)</label>
                        <div
                            class="border border-slate-200 rounded-xl divide-y divide-slate-100 max-h-44 overflow-y-auto p-2 bg-slate-50">
                            @forelse($santriTersedia as $santri)
                                <label
                                    class="flex items-center gap-3 p-2 hover:bg-white rounded-lg cursor-pointer transition">
                                    <input type="checkbox" name="santri_ids[]" value="{{ $santri->id }}"
                                        class="rounded text-red-600 focus:ring-red-500 border-slate-300 w-4 h-4">
                                    <span class="text-sm text-slate-700 font-medium">{{ $santri->nama }} <span
                                            class="text-slate-400 text-xs">({{ $santri->nisn }})</span></span>
                                </label>
                            @empty
                                <p class="text-xs text-slate-400 text-center py-4">Seluruh santri aktif sudah memiliki
                                    kelas.</p>
                            @endif
                        </div>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-2">
                        <button type="button" @click="openCreate = false"
                            class="px-4 py-2 text-slate-500 hover:bg-slate-100 rounded-xl text-sm transition font-medium">Batal</button>
                        <button type="submit"
                            class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-sm transition font-medium shadow-xs">Simpan
                            Rombel</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="openDetail" x-cloak
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center z-50 p-4">
            <div @click.outside="openDetail = false"
                class="bg-white rounded-2xl w-full max-w-2xl shadow-xl flex flex-col max-h-[85vh]">
                <div
                    class="px-6 py-4 border-b border-slate-100 bg-slate-50 rounded-t-2xl flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-slate-800 text-lg flex items-center gap-2">
                            <i class="fa-solid fa-school text-red-600"></i> Anggota <span
                                x-text="detailNamaKelas"></span>
                        </h3>
                        <p class="text-xs text-slate-500">Wali Kelas: <span x-text="detailWaliKelas"
                                class="font-medium"></span></p>
                    </div>
                    <button @click="openDetail = false" class="text-slate-400 hover:text-slate-600"><i
                            class="fa-solid fa-xmark text-lg"></i></button>
                </div>

                <div class="p-6 flex-1 flex flex-col overflow-hidden">
                    <form action="{{ route('admin.kelas.update', 'update-members') }}" method="POST"
                        class="mb-6 p-4 bg-slate-50 rounded-xl border border-slate-200 flex items-end gap-3">
                        @csrf @method('PUT')
                        <input type="hidden" name="nama_kelas" :value="detailNamaKelas">

                        <div class="flex-1">
                            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1.5">Masukkan Santri
                                Baru Berkelas</label>
                            <select name="santri_id" required
                                class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm bg-white">
                                <option value="">-- Pilih Santri yang Tersedia --</option>
                                @foreach ($santriTersedia as $st)
                                    <option value="{{ $st->id }}">{{ $st->nama }} ({{ $st->nisn }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold py-2 px-4 rounded-lg transition h-9">
                            <i class="fa-solid fa-user-plus mr-1"></i> Gabungkan
                        </button>
                    </form>

                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-2">Daftar Santri Saat
                        Ini</label>
                    <div
                        class="flex-1 overflow-y-auto border border-slate-100 rounded-xl divide-y divide-slate-100 bg-white">
                        <template x-if="daftarSantri.length === 0">
                            <p class="text-center py-8 text-sm text-slate-400 italic">Belum ada santri dimasukkan ke
                                kelas ini.</p>
                        </template>

                        <template x-for="(st, index) in daftarSantri" :key="st.id">
                            <div class="p-3 flex justify-between items-center hover:bg-slate-50 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 bg-red-50 text-red-600 rounded-full flex items-center justify-center text-xs font-bold"
                                        x-text="index + 1"></div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800" x-text="st.nama"></p>
                                        <p class="text-xs text-slate-400">NISN: <span x-text="st.nisn"></span></p>
                                    </div>
                                </div>

                                <form :action="'/admin/kelas/' + st.kelas_record_id" method="POST"
                                    onsubmit="return confirm('Keluarkan santri ini dari kelas?')">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="mode" value="single_santri">
                                    <button type="submit"
                                        class="text-slate-400 hover:text-red-600 text-xs p-1 rounded transition">
                                        <i class="fa-solid fa-user-minus"></i> Keluarkan
                                    </button>
                                </form>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
