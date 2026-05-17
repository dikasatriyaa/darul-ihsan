<x-admin-layout>
    <x-slot:title>Manajemen Santri</x-slot>
    <x-slot:pageHeader>Data Santri</x-slot>

    <div x-data="{
        showAddModal: {{ $errors->any() && !$errors->has('file_excel') && !session('edit_id') ? 'true' : 'false' }},
        showEditModal: {{ session('edit_id') ? 'true' : 'false' }},
        showImportModal: {{ $errors->has('file_excel') ? 'true' : 'false' }},
        santri: {
            id: '',
            nama: '',
            nisn: '',
            nism: '',
            no_bpjs: '',
            asal_sekolah: '',
            nama_orang_tua: '',
            nomor_whatsapp: '',
            status: 'diterima'
        },
        actionUrl: ''
    }">

        @if (session('success'))
            <div
                class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-semibold flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-circle-check text-emerald-500"></i>
                {{ session('success') }}
            </div>
        @endif

        <div
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-3xl border border-slate-200/60 shadow-sm mb-6">
            <div>
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Daftar Seluruh Santri</h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola informasi profil dan status pendaftaran berkas santri.
                </p>
            </div>
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button @click="showImportModal = true"
                    class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs px-4 py-3 rounded-xl transition flex items-center gap-2 cursor-pointer border border-slate-200">
                    <i class="fa-solid fa-file-excel text-emerald-600"></i> Import Excel
                </button>
                <button @click="showAddModal = true"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold text-xs px-5 py-3 rounded-xl transition shadow-md flex items-center gap-2 active:scale-95 cursor-pointer">
                    <i class="fa-solid fa-plus"></i> Tambah Santri
                </button>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200/60 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr
                            class="bg-slate-50 text-slate-400 font-bold uppercase border-b border-slate-100 tracking-wider">
                            <th class="p-4 pl-6 text-center w-12">No</th>
                            <th class="p-4">Profil Santri / Asal</th>
                            <th class="p-4">Identitas (NISN/NISM)</th>
                            <th class="p-4">Wali / WhatsApp</th>
                            <th class="p-4 text-center">Status Berkas</th>
                            <th class="p-4 pr-6 text-center">Aksi Kerja</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                        @forelse($santris as $index => $s)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 pl-6 text-center text-slate-400">{{ $santris->firstItem() + $index }}
                                </td>
                                <td class="p-4">
                                    <p class="font-bold text-slate-900 text-sm">{{ $s->nama }}</p>
                                    <p class="text-[10px] text-slate-400 font-normal mt-0.5">Asal:
                                        {{ $s->asal_sekolah }}</p>
                                </td>
                                <td class="p-4 font-mono">
                                    <span class="text-slate-900 font-semibold">{{ $s->nisn }}</span>
                                    <span class="block text-[10px] text-slate-400 mt-0.5">NISM:
                                        {{ $s->nism }}</span>
                                </td>
                                <td class="p-4">
                                    <p class="text-slate-900 font-bold">{{ $s->nama_orang_tua }}</p>
                                    <p class="text-[10px] text-emerald-600 font-bold mt-0.5">
                                        <i class="fa-brands fa-whatsapp"></i> {{ $s->nomor_whatsapp }}
                                    </p>
                                </td>
                                <td class="p-4 text-center">
                                    <span
                                        class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider {{ $s->status === 'diterima' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-red-50 text-red-700 border border-red-100' }}">
                                        {{ $s->status }}
                                    </span>
                                </td>
                                <td class="p-4 pr-6 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button
                                            @click="
                                        santri = { 
                                            id: '{{ $s->id }}', 
                                            nama: '{{ $s->nama }}', 
                                            nisn: '{{ $s->nisn }}', 
                                            nism: '{{ $s->nism }}', 
                                            no_bpjs: '{{ $s->no_bpjs ?? '' }}', 
                                            asal_sekolah: '{{ $s->asal_sekolah }}', 
                                            nama_orang_tua: '{{ $s->nama_orang_tua }}', 
                                            nomor_whatsapp: '{{ $s->nomor_whatsapp }}', 
                                            status: '{{ $s->status }}' 
                                        };
                                        showEditModal = true;
                                    "
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition cursor-pointer">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </button>
                                        <form action="{{ route('admin.santri.destroy', $s->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Hapus data santri ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-600 hover:bg-red-50 rounded-xl transition cursor-pointer">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-slate-400">Belum ada data santri.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($santris->hasPages())
                <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $santris->links() }}
                </div>
            @endif
        </div>

        <div x-show="showAddModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0"
            role="dialog" aria-modal="true">
            <div x-show="showAddModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"
                @click="showAddModal = false"></div>
            <div x-show="showAddModal"
                class="relative bg-white rounded-[32px] text-left overflow-hidden shadow-2xl transform transition-all my-8 sm:max-w-2xl sm:w-full p-8 border border-slate-100 z-10 max-h-[90vh] overflow-y-auto">
                <div class="mb-6">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Tambah Santri Baru</h3>
                </div>
                <form action="{{ route('admin.santri.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="sm:col-span-2"><x-form-input name="nama" label="Nama Lengkap Santri" required />
                        </div>
                        <x-form-input name="nisn" label="NISN (10 Digit)" required />
                        <x-form-input name="nism" label="NISM" required />
                        <x-form-input name="asal_sekolah" label="Asal Sekolah" required />
                        <x-form-input name="nama_orang_tua" label="Nama Wali" required />
                        <x-form-input name="nomor_whatsapp" label="WhatsApp Wali" required />
                        <x-form-input name="no_bpjs" label="No. BPJS (Opsional)" />
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700 block">Status</label>
                            <select name="status"
                                class="w-full text-sm px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-red-500 bg-slate-50/50">
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-8 pt-4 border-t border-slate-100 flex justify-end gap-3">
                        <button type="button" @click="showAddModal = false"
                            class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 text-xs font-bold transition">Batal</button>
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-bold text-xs px-6 py-2.5 rounded-xl shadow-md transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="showEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0"
            role="dialog" aria-modal="true">
            <div x-show="showEditModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"
                @click="showEditModal = false"></div>
            <div x-show="showEditModal"
                class="relative bg-white rounded-[32px] text-left overflow-hidden shadow-2xl transform transition-all my-8 sm:max-w-2xl sm:w-full p-8 border border-slate-100 z-10 max-h-[90vh] overflow-y-auto">
                <div class="mb-6">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Perbarui Profil Master Santri</h3>
                </div>
                <form :action="'/admin/santri/' + santri.id" method="POST">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="sm:col-span-2">
                            <label class="text-xs font-bold text-slate-700 block mb-1.5">Nama Lengkap Santri</label>
                            <input type="text" name="nama" x-model="santri.nama" required
                                class="w-full text-sm px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 outline-none">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1.5">NISN</label>
                            <input type="text" name="nisn" x-model="santri.nisn" required
                                class="w-full text-sm px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 outline-none">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1.5">NISM</label>
                            <input type="text" name="nism" x-model="santri.nism" required
                                class="w-full text-sm px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 outline-none">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1.5">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" x-model="santri.asal_sekolah" required
                                class="w-full text-sm px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 outline-none">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1.5">Nama Wali</label>
                            <input type="text" name="nama_orang_tua" x-model="santri.nama_orang_tua" required
                                class="w-full text-sm px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 outline-none">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1.5">WhatsApp Wali</label>
                            <input type="text" name="nomor_whatsapp" x-model="santri.nomor_whatsapp" required
                                class="w-full text-sm px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 outline-none">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1.5">No. BPJS</label>
                            <input type="text" name="no_bpjs" x-model="santri.no_bpjs"
                                class="w-full text-sm px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 outline-none">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1.5">Status</label>
                            <select name="status" x-model="santri.status"
                                class="w-full text-sm px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 outline-none">
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-8 pt-4 border-t border-slate-100 flex justify-end gap-3">
                        <button type="button" @click="showEditModal = false"
                            class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 text-xs font-bold transition">Batal</button>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs px-6 py-2.5 rounded-xl shadow-md transition">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="showImportModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0"
            role="dialog" aria-modal="true">
            <div x-show="showImportModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"
                @click="showImportModal = false"></div>

            <div x-show="showImportModal"
                class="relative bg-white rounded-[32px] text-left overflow-hidden shadow-2xl transform transition-all my-8 sm:max-w-md sm:w-full p-8 border border-slate-100 z-10">
                <div class="mb-4">
                    <h3 class="text-lg font-black text-slate-900 tracking-tight">Import Masal via Excel</h3>
                    <p class="text-xs text-slate-500 mt-1">Unggah berkas spreadsheet dengan format kolom template.</p>
                </div>

                <div
                    class="p-3 bg-slate-50 border border-slate-200 rounded-2xl mb-5 text-[11px] text-slate-600 space-y-1 font-medium">
                    <p class="font-bold text-slate-800"><i class="fa-solid fa-circle-info text-blue-500"></i> Aturan
                        Struktur Kolom Header:</p>
                    <p class="font-mono text-[10px] text-red-600">nama | nisn | nism | no_bpjs | asal_sekolah |
                        nama_orang_tua | nomor_whatsapp | status</p>
                </div>

                <form action="{{ route('admin.santri.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-700 block">Pilih File Spreadsheet</label>
                        <input type="file" name="file_excel" required
                            class="w-full text-xs px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 outline-none file:mr-4 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] file:font-bold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300">
                        @error('file_excel')
                            <p class="text-[11px] text-red-600 font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex justify-end gap-2">
                        <button type="button" @click="showImportModal = false"
                            class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 text-xs font-bold transition">Batal</button>
                        <button type="submit"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-5 py-2 rounded-xl shadow-sm transition active:scale-95">Mulai
                            Import</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-admin-layout>
