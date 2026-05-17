<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} | Darul Ihsan</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-slate-100 font-sans text-slate-800 antialiased">
    <div class="flex min-h-screen">

        <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col fixed h-full z-20">
            <div class="h-20 flex items-center px-6 border-b border-slate-800 gap-3 bg-slate-950">
                <div class="p-2 bg-red-600 rounded-xl text-white">
                    <i class="fa-solid fa-mosque"></i>
                </div>
                <div>
                    <h1 class="text-sm font-black text-white tracking-wide">DARUL IHSAN</h1>
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest">Admin Panel</p>
                </div>
            </div>

            <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto">
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-3 mb-2">Utama</p>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white font-medium shadow-sm' : 'hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                    <i class="fa-solid fa-chart-pie w-5 text-center"></i>
                    <span class="text-sm">Dashboard</span>
                </a>

                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-3 pt-4 mb-2">Akademik</p>
                <a href="{{ route('admin.santri.index') }}"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('admin.santri.*') ? 'bg-red-600 text-white font-medium shadow-sm' : 'hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                    <i class="fa-solid fa-user-graduate w-5 text-center"></i>
                    <span class="text-sm">Data Santri</span>
                </a>

                <a href="{{ route('admin.kelulusan') }}"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('admin.kelulusan') ? 'bg-red-600 text-white font-medium shadow-sm' : 'hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                    <i class="fa-solid fa-user-check w-5 text-center"></i>
                    <span class="text-sm">Kelulusan Santri</span>
                </a>

                <a href="{{ route('admin.kelas.index') }}"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('admin.kelas.*') ? 'bg-red-600 text-white font-medium shadow-sm' : 'hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                    <i class="fa-solid fa-school w-5 text-center"></i>
                    <span class="text-sm">Manajemen Kelas</span>
                </a>

                <a href="{{ route('admin.tahun-ajaran.index') }}"
                    class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('admin.tahun-ajaran.*') ? 'bg-red-600 text-white font-medium shadow-sm' : 'hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                    <i class="fa-solid fa-calendar-days w-5 text-center"></i>
                    <span class="text-sm">Tahun Ajaran</span>
                </a>
                <div class="mt-auto pt-6 border-t border-slate-800">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>

                    <button type="button"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="w-full flex items-center gap-3.5 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-rose-600/20 hover:border-rose-600/30 border border-transparent transition duration-200 group text-left cursor-pointer">
                        <i
                            class="fa-solid fa-right-from-bracket w-5 text-center text-slate-500 group-hover:text-rose-500 transition"></i>
                        <span class="text-sm font-medium group-hover:text-rose-400">Keluar Sistem</span>
                    </button>
                </div>
            </nav>
        </aside>

        <div class="flex-1 ml-64 flex flex-col min-h-screen">
            <header
                class="h-20 bg-white border-b border-slate-200/80 flex items-center justify-between px-8 sticky top-0 z-10">
                <div class="flex items-center gap-2 text-xs">
                    <span class="text-slate-400">Admin Panel</span>
                    <span class="text-slate-300">/</span>
                    <span class="text-slate-700 font-semibold">{{ $pageHeader ?? 'Dashboard' }}</span>
                </div>
                <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">TA
                    2026/2027</span>
            </header>

            <main class="flex-1 p-8 space-y-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>


</html>
