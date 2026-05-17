<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Darul Ihsan Islamic Center</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-slate-100 font-sans text-slate-800 antialiased">

    <div class="flex min-h-screen">

        <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col fixed h-full z-20 transition-all duration-300">
            <div class="h-20 flex items-center px-6 border-b border-slate-800 gap-3 bg-slate-950">
                <div class="p-2 bg-red-600 rounded-xl text-white">
                    <i class="fa-solid fa-mosque text-lg"></i>
                </div>
                <div>
                    <h1 class="text-sm font-black text-white tracking-wide leading-tight">DARUL IHSAN</h1>
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest">Admin Panel</p>
                </div>
            </div>

            <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto">
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-3 mb-2">Utama</p>

                <a href="#"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-xl bg-red-600 text-white font-medium transition duration-200 shadow-sm shadow-red-900/20">
                    <i class="fa-solid fa-chart-pie text-sm w-5 text-center"></i>
                    <span class="text-sm">Dashboard</span>
                </a>

                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-3 pt-4 mb-2">Akademik</p>

                <a href="#"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white transition duration-200 group">
                    <i
                        class="fa-solid fa-user-graduate text-sm w-5 text-center text-slate-500 group-hover:text-red-500 transition"></i>
                    <span class="text-sm">Data Santri</span>
                </a>

                <a href="#"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white transition duration-200 group">
                    <i
                        class="fa-solid fa-school text-sm w-5 text-center text-slate-500 group-hover:text-red-500 transition"></i>
                    <span class="text-sm">Manajemen Kelas</span>
                </a>

                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-3 pt-4 mb-2">Konten</p>

                <a href="#"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white transition duration-200 group">
                    <i
                        class="fa-solid fa-newspaper text-sm w-5 text-center text-slate-500 group-hover:text-red-500 transition"></i>
                    <span class="text-sm">Artikel Blog</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800 bg-slate-950/50 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div
                        class="w-9 h-9 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-white font-bold text-sm">
                        AD
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-semibold text-white truncate">Administrator</p>
                        <p class="text-[10px] text-slate-500 truncate">admin@darulihsan.com</p>
                    </div>
                </div>
                <a href="#"
                    class="p-2 text-slate-500 hover:text-red-500 rounded-lg hover:bg-slate-800/50 transition"
                    title="Log Out">
                    <i class="fa-solid fa-right-from-bracket text-sm"></i>
                </a>
            </div>
        </aside>

        <div class="flex-1 ml-64 flex flex-col min-h-screen">

            <header
                class="h-20 bg-white border-b border-slate-200/80 flex items-center justify-between px-8 sticky top-0 z-10">
                <div class="flex items-center gap-2">
                    <span class="text-xs text-slate-400 font-medium">Halaman</span>
                    <span class="text-xs text-slate-300">/</span>
                    <span class="text-xs text-slate-700 font-semibold">Dashboard</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-slate-700">Tahun Ajaran Aktif</p>
                        <p
                            class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md inline-block mt-0.5">
                            2026/2027</p>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-8 space-y-8">

                <div
                    class="bg-white rounded-3xl p-6 border border-slate-200/60 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Assalamu'alaikum, Admin</h2>
                        <p class="text-xs text-slate-500 mt-1">Selamat datang kembali di panel administrasi Pondok
                            Pesantren Darul Ihsan Islamic Center.</p>
                    </div>
                    <span
                        class="text-xs font-medium text-slate-500 bg-slate-100 px-3 py-1.5 rounded-xl border border-slate-200/40">
                        <i class="fa-regular fa-calendar mr-1.5"></i> {{ date('d M Y') }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div
                        class="bg-white rounded-3xl p-6 border border-slate-200/60 shadow-sm relative overflow-hidden group">
                        <div class="flex justify-between items-start">
                            <div class="space-y-2">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Santri</p>
                                <h3 class="text-3xl font-black text-slate-900 tracking-tight">1,240</h3>
                            </div>
                            <div
                                class="p-3.5 bg-red-50 text-red-600 rounded-2xl group-hover:scale-110 transition duration-300">
                                <i class="fa-solid fa-user-group text-lg"></i>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-3xl p-6 border border-slate-200/60 shadow-sm relative overflow-hidden group">
                        <div class="flex justify-between items-start">
                            <div class="space-y-2">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kelas Aktif</p>
                                <h3 class="text-3xl font-black text-slate-900 tracking-tight">32</h3>
                            </div>
                            <div
                                class="p-3.5 bg-amber-50 text-amber-600 rounded-2xl group-hover:scale-110 transition duration-300">
                                <i class="fa-solid fa-chalkboard text-lg"></i>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-3xl p-6 border border-slate-200/60 shadow-sm relative overflow-hidden group">
                        <div class="flex justify-between items-start">
                            <div class="space-y-2">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Santri Lulus</p>
                                <h3 class="text-3xl font-black text-slate-900 tracking-tight">342</h3>
                            </div>
                            <div
                                class="p-3.5 bg-emerald-50 text-emerald-600 rounded-2xl group-hover:scale-110 transition duration-300">
                                <i class="fa-solid fa-graduation-cap text-lg"></i>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-3xl p-6 border border-slate-200/60 shadow-sm relative overflow-hidden group">
                        <div class="flex justify-between items-start">
                            <div class="space-y-2">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Artikel</p>
                                <h3 class="text-3xl font-black text-slate-900 tracking-tight">87</h3>
                            </div>
                            <div
                                class="p-3.5 bg-blue-50 text-blue-600 rounded-2xl group-hover:scale-110 transition duration-300">
                                <i class="fa-solid fa-file-lines text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div
                        class="bg-white rounded-3xl border border-slate-200/60 shadow-sm lg:col-span-2 overflow-hidden">
                        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">Pendaftaran Santri Terbaru</h4>
                                <p class="text-[11px] text-slate-400 mt-0.5">Daftar santri baru yang baru saja masuk ke
                                    sistem.</p>
                            </div>
                            <button class="text-xs font-bold text-red-600 hover:underline">Lihat Semua</button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-xs">
                                <thead>
                                    <tr
                                        class="bg-slate-50 text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100">
                                        <th class="p-4 pl-6">Nama Santri</th>
                                        <th class="p-4">NISN</th>
                                        <th class="p-4">Asal Sekolah</th>
                                        <th class="p-4 pr-6 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                                    <tr>
                                        <td class="p-4 pl-6 font-bold text-slate-900">Muhammad Al-Fatih</td>
                                        <td class="p-4 font-mono">0098453211</td>
                                        <td class="p-4">SMP N 1 Jakarta</td>
                                        <td class="p-4 pr-6 text-center">
                                            <span
                                                class="px-2 py-0.5 bg-emerald-50 text-emerald-600 rounded-md font-bold text-[10px] uppercase">Diterima</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-4 pl-6 font-bold text-slate-900">Aisyah Humaira</td>
                                        <td class="p-4 font-mono">0087432109</td>
                                        <td class="p-4">MTs Darul Hikmah</td>
                                        <td class="p-4 pr-6 text-center">
                                            <span
                                                class="px-2 py-0.5 bg-emerald-50 text-emerald-600 rounded-md font-bold text-[10px] uppercase">Diterima</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-4 pl-6 font-bold text-slate-900">Zaid bin Haritsah</td>
                                        <td class="p-4 font-mono">0102435678</td>
                                        <td class="p-4">SMP Al-Azhar</td>
                                        <td class="p-4 pr-6 text-center">
                                            <span
                                                class="px-2 py-0.5 bg-red-50 text-red-600 rounded-md font-bold text-[10px] uppercase">Ditolak</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-3xl border border-slate-200/60 shadow-sm overflow-hidden flex flex-col">
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h4 class="font-bold text-slate-900 text-sm">Artikel Populer (`blogs`)</h4>
                            <p class="text-[11px] text-slate-400 mt-0.5">Laporan tulisan yang paling banyak dibaca.</p>
                        </div>
                        <div class="p-6 space-y-4 flex-1 overflow-y-auto">
                            <div
                                class="flex gap-3.5 items-center pb-4 border-b border-slate-100 last:border-none last:pb-0">
                                <div
                                    class="w-12 h-12 bg-slate-100 rounded-xl flex-shrink-0 flex items-center justify-center text-slate-400">
                                    <i class="fa-regular fa-image text-lg"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <h5
                                        class="text-xs font-bold text-slate-900 truncate hover:text-red-600 cursor-pointer">
                                        Kegiatan Ramadhan di Pondok 1447 H</h5>
                                    <div class="flex items-center gap-2 text-[10px] text-slate-400 mt-1">
                                        <span><i class="fa-regular fa-eye mr-1"></i> 1,420 views</span>
                                        <span>•</span>
                                        <span class="font-bold text-red-600">Pendidikan</span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex gap-3.5 items-center pb-4 border-b border-slate-100 last:border-none last:pb-0">
                                <div
                                    class="w-12 h-12 bg-slate-100 rounded-xl flex-shrink-0 flex items-center justify-center text-slate-400">
                                    <i class="fa-regular fa-image text-lg"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <h5
                                        class="text-xs font-bold text-slate-900 truncate hover:text-red-600 cursor-pointer">
                                        Tips Menghafal Al-Qur'an Metode Sabak</h5>
                                    <div class="flex items-center gap-2 text-[10px] text-slate-400 mt-1">
                                        <span><i class="fa-regular fa-eye mr-1"></i> 932 views</span>
                                        <span>•</span>
                                        <span class="font-bold text-red-600">Tahfidz</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

</body>

</html>
