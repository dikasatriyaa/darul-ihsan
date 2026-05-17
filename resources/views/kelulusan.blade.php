<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PPS. Darul Ihsan Islamic Center</title>
    <meta name="description" content="Pondok Pesantren Modern, Mencetak Generasi Qur'ani BerAkhlak Mulia">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="PPS. Darul Ihsan Islamic Center">
    <meta property="og:description" content="Pondok Pesantren Modern, Mencetak Generasi Qur'ani BerAkhlak Mulia">
    <meta property="og:image" content="{{ asset('image/2.jpeg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>

<body>
    <div class="font-sans">


        <div class="min-h-screen bg-red-700 flex items-center justify-center p-4 sm:p-6 lg:p-8 font-sans">


            <div
                class="w-full max-w-5xl bg-white rounded-[32px] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.08)] flex flex-col md:flex-row overflow-hidden min-h-[550px] ">

                <div class="w-full md:w-5/12 relative min-h-[250px] md:min-h-auto flex flex-col justify-between p-8 text-white bg-cover bg-center"
                    style="background-image: url('{{ asset('image/h-0.jpeg') }}');">
                </div>

                <div class="w-full md:w-7/12 p-8 lg:p-12 flex flex-col justify-center bg-white">

                    <div class="mb-6">
                        <div
                            class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 text-[10px] font-bold tracking-wider uppercase px-3 py-1 rounded-full mb-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                            Tahun Ajaran 2026/2027
                        </div>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Cek Hasil Kelulusan Santri</h2>
                        <p class="text-sm text-gray-500 mt-1.5">Pondok Pesantren Darul Ihsan Islamic Center</p>
                    </div>

                    <div class="mb-8 p-4 bg-slate-50 border-l-4 border-red-600 rounded-r-xl">
                        <p class="text-xs italic text-gray-600 leading-relaxed">
                            "Tidak ada kekayaan yang lebih utama daripada akal, tidak ada keadaan yang lebih menyedihkan
                            daripada kebodohan, dan tidak ada warisan yang lebih baik daripada pendidikan."
                        </p>
                        <span class="block text-[10px] font-semibold text-gray-400 mt-1.5 uppercase tracking-wider">—
                            Ali
                            bin Abi Thalib</span>
                    </div>

                    @error('nomor_induk')
                        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl text-xs font-semibold">
                            {{ $message }}
                        </div>
                    @enderror

                    <form action="{{ route('periksa') }}" method="POST"
                        class="w-full bg-gray-50 p-2 rounded-2xl flex items-center border border-gray-200/60 focus-within:border-red-500 focus-within:ring-4 focus-within:ring-red-100 transition-all duration-300">
                        @csrf
                        <div class="flex-1 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <input type="text" name="nomor_induk" placeholder="Masukkan 10 digit NISN Santri..."
                                required
                                class="w-full pl-3 pr-2 py-3 bg-transparent text-gray-800 placeholder-gray-400 font-medium text-sm focus:outline-none" />
                        </div>

                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold text-sm px-5 sm:px-7 py-3 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md flex items-center gap-2 whitespace-nowrap active:scale-95">
                            <span>Periksa</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    </form>
                    <div
                        class="mt-8 pt-6 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-gray-400">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-4 h-4 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                            </svg>
                            <span>NISN tidak terdaftar atau bermasalah?</span>
                        </div>
                        <a href="#" class="text-red-600 font-medium hover:underline">Hubungi Sekretariat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('hasil_cek'))

        @if (session('status') === 'lulus')
            <div id="modal-hasil"
                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50">
                <div
                    class="bg-white rounded-[32px] w-full max-w-md overflow-hidden shadow-2xl p-6 text-center relative border border-gray-100">
                    <div class="absolute -top-10 -left-10 w-32 h-32 bg-emerald-50 rounded-full -z-0 opacity-60"></div>
                    <div
                        class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-emerald-50 text-emerald-600 mb-4 relative z-10">
                        <svg class="h-8 w-8 animate-bounce" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <span
                            class="text-[10px] font-bold tracking-widest uppercase text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">Selamat!</span>
                        <h3 class="text-2xl font-black text-gray-900 tracking-tight mt-2">Dinyatakan Lulus</h3>

                        <div
                            class="mt-4 p-4 bg-slate-50 rounded-2xl text-left space-y-2 text-xs border border-gray-100">
                            <div class="flex justify-between gap-4"><span class="text-gray-400">Nama Santri:</span>
                                <span
                                    class="font-bold text-gray-800 text-right">{{ session('santri_data')['nama'] }}</span>
                            </div>
                            <div class="flex justify-between"><span class="text-gray-400">NISN / NISM:</span> <span
                                    class="font-mono text-gray-800">{{ session('santri_data')['nisn'] }} /
                                    {{ session('santri_data')['nism'] }}</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Asal Sekolah:</span> <span
                                    class="font-semibold text-gray-800">{{ session('santri_data')['asal_sekolah'] }}</span>
                            </div>
                            <div class="flex justify-between"><span class="text-gray-400">Orang Tua/Wali:</span> <span
                                    class="font-semibold text-gray-800">{{ session('santri_data')['nama_orang_tua'] }}</span>
                            </div>
                            <div class="flex justify-between"><span class="text-gray-400">Kelas Kelulusan:</span>
                                <span class="font-bold text-red-600 uppercase">Kelas
                                    {{ session('santri_data')['nama_kelas'] }}</span>
                            </div>
                        </div>
                        <p class="mt-3 text-[11px] text-gray-500 leading-relaxed">Barakallah fiikum. Silakan unduh
                            bukti kelulusan resmi Anda untuk keperluan pemberkasan.</p>
                    </div>
                    <div class="mt-5 flex flex-col gap-2 relative z-10">
                        <button onclick="window.print()"
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm py-3 rounded-xl transition shadow-sm">Cetak
                            Bukti Lulus</button>
                        <button onclick="document.getElementById('modal-hasil').remove()"
                            class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium text-xs py-2.5 rounded-xl transition">Tutup</button>
                    </div>
                </div>
            </div>
        @elseif(session('status') === 'aktif' || session('status') === 'naik')
            <div id="modal-hasil"
                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50">
                <div
                    class="bg-white rounded-[32px] w-full max-w-md overflow-hidden shadow-2xl p-6 text-center relative border border-gray-100">
                    <div
                        class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-amber-50 text-amber-600 mb-5">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <span
                            class="text-[10px] font-bold tracking-widest uppercase text-amber-700 bg-amber-50 px-3 py-1 rounded-full">Informasi
                            Akademik</span>
                        <h3 class="text-2xl font-black text-gray-900 tracking-tight mt-3">Status Belum Lulus</h3>

                        <div
                            class="mt-4 p-4 bg-slate-50 rounded-2xl text-left space-y-2 text-xs border border-gray-100">
                            <div class="flex justify-between"><span class="text-gray-400">Nama:</span> <span
                                    class="font-semibold text-gray-800">{{ session('santri_data')['nama'] }}</span>
                            </div>
                            <div class="flex justify-between"><span class="text-gray-400">Kelas Aktif:</span> <span
                                    class="font-mono text-gray-800">{{ session('santri_data')['nama_kelas'] }}</span>
                            </div>
                            <div class="flex justify-between"><span class="text-gray-400">Status Evaluasi:</span>
                                <span class="font-bold text-amber-600 uppercase">STATUS {{ session('status') }}</span>
                            </div>
                        </div>
                        <p class="mt-4 text-xs text-gray-400 leading-relaxed">Santri yang bersangkutan saat ini masih
                            tercatat aktif mengikuti jenjang pendidikan normatif di kelas
                            {{ session('santri_data')['nama_kelas'] }}.</p>
                    </div>
                    <div class="mt-6 flex flex-col gap-2">
                        <button onclick="document.getElementById('modal-hasil').remove()"
                            class="w-full bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm py-3 rounded-xl transition">Kembali</button>
                    </div>
                </div>
            </div>
        @elseif(session('status') === 'ditolak')
            <div id="modal-hasil"
                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50">
                <div
                    class="bg-white rounded-[32px] w-full max-w-md overflow-hidden shadow-2xl p-6 text-center relative border border-gray-100">
                    <div
                        class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-50 text-red-600 mb-5">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                    <div>
                        <span
                            class="text-[10px] font-bold tracking-widest uppercase text-red-700 bg-red-50 px-3 py-1 rounded-full">Akses
                            Dibatasi</span>
                        <h3 class="text-2xl font-black text-gray-900 tracking-tight mt-3">Status Berkas Ditolak</h3>
                        <p class="mt-3 text-sm text-gray-500 leading-relaxed">
                            Maaf, akses kelulusan untuk Santri bernama <span
                                class="font-bold text-gray-800">{{ session('santri_data')['nama'] }}</span>
                            ditangguhkan karena alasan administrasi berkas.
                        </p>
                    </div>
                    <div class="mt-6 flex flex-col gap-2">
                        <button onclick="document.getElementById('modal-hasil').remove()"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold text-sm py-3 rounded-xl transition">Hubungi
                            Tata Usaha</button>
                    </div>
                </div>
            </div>
        @else
            <div id="modal-hasil"
                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50">
                <div
                    class="bg-white rounded-[32px] w-full max-w-md overflow-hidden shadow-2xl p-6 text-center relative border border-gray-100">
                    <div
                        class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-slate-100 text-slate-500 mb-5">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.603 10.603z" />
                        </svg>
                    </div>
                    <div>
                        <span
                            class="text-[10px] font-bold tracking-widest uppercase text-slate-700 bg-slate-100 px-3 py-1 rounded-full">Tidak
                            Ditemukan</span>
                        <h3 class="text-2xl font-black text-gray-900 tracking-tight mt-3">NISN Belum Terdaftar</h3>
                        <p class="mt-3 text-sm text-gray-500 leading-relaxed">
                            Nomor NISN <span
                                class="font-mono font-bold text-gray-800">{{ session('santri_data')['nisn'] }}</span>
                            tidak ditemukan pada database kelulusan aktif kami.
                        </p>
                    </div>
                    <div class="mt-6 flex flex-col gap-2">
                        <button onclick="document.getElementById('modal-hasil').remove()"
                            class="w-full bg-slate-800 hover:bg-slate-900 text-white font-semibold text-sm py-3 rounded-xl transition">Periksa
                            Kembali</button>
                    </div>
                </div>
            </div>
        @endif

    @endif
</body>

</html>
