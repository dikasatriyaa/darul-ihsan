<header class="w-full pt-4 relative">
    <nav id="nav"
        class="absolute left-1/2 -translate-x-1/2 z-50 w-[92%] max-w-7xl bg-white rounded-full shadow-sm border border-black/5 transition-all duration-300">
        <x-container>
            <div class="relative flex flex-wrap lg:flex-nowrap items-center justify-between py-2.5 px-6">

                <div class="relative z-20 flex w-full justify-between md:px-0 lg:w-auto items-center gap-4">
                    <img src="{{ asset('image/logo.png') }}" alt="logo" width="150px">

                    <div class="hidden lg:block h-6 border-l border-gray-200 ml-2"></div>

                    <div class="relative flex max-h-10 items-center lg:hidden">
                        <button aria-label="humburger" id="hamburger"
                            class="relative -mr-6 p-6 active:scale-95 duration-300">
                            <div aria-hidden="true" id="line"
                                class="m-auto h-0.5 w-5 rounded bg-gray-950 transition duration-300 origin-top group-data-[state=active]:rotate-45 group-data-[state=active]:translate-y-1.5">
                            </div>
                            <div aria-hidden="true" id="line2"
                                class="m-auto mt-2 h-0.5 w-5 rounded bg-gray-950 transition duration-300 origin-bottom group-data-[state=active]:-rotate-45 group-data-[state=active]:-translate-y-1">
                            </div>
                        </button>
                    </div>
                </div>

                <div id="navLayer" aria-hidden="true"
                    class="fixed inset-0 z-10 h-screen w-screen origin-bottom scale-y-0 bg-white/70 backdrop-blur-2xl transition duration-500 group-data-[state=active]:origin-top group-data-[state=active]:scale-y-100 lg:hidden">
                </div>

                <div id="navlinks"
                    class="invisible absolute top-full left-0 z-20 w-full origin-top-right translate-y-1 scale-90 flex-col flex-wrap justify-end gap-6 rounded-3xl border border-gray-100 bg-white p-8 opacity-0 shadow-2xl shadow-gray-600/10 transition-all duration-300 lg:visible lg:relative lg:flex lg:flex-1 lg:flex-row lg:items-center lg:justify-between lg:gap-0 lg:border-none lg:bg-transparent lg:p-0 lg:opacity-100 lg:shadow-none group-data-[state=active]:visible group-data-[state=active]:scale-100 group-data-[state=active]:opacity-100 lg:group-data-[state=active]:translate-y-0 mx-4 lg:mx-0">

                    <div class="w-full text-gray-600 lg:w-auto lg:mx-auto lg:pt-0">
                        <div id="links-group"
                            class="flex flex-col gap-6 tracking-wide lg:flex-row lg:gap-2 lg:text-1xl">
                            <a href="/"
                                class="flex gap-2 font-semibold {{ request()->routeIs('home') ? 'text-primary transition hover:text-gray-700' : 'text-gray-700 transition hover:text-primary md:px-4' }}">
                                <span>Beranda</span>
                            </a>
                            <a href="/about"
                                class="flex gap-2 font-semibold {{ request()->routeIs('about') ? 'text-primary transition hover:text-gray-700' : 'text-gray-700 transition hover:text-primary md:px-4' }} md:px-4">
                                <span>Tentang Kami</span>
                            </a>
                            <a href="/publikasi"
                                class="flex gap-2 font-semibold {{ request()->routeIs('publikasi.index') ? 'text-primary transition hover:text-gray-700' : 'text-gray-700 transition hover:text-primary md:px-4' }} md:px-4">
                                <span>Publikasi</span>
                            </a>
                            <a href="/contact"
                                class="flex gap-2 font-semibold {{ request()->routeIs('contact') ? 'text-primary transition hover:text-gray-700' : 'text-gray-700 transition hover:text-primary md:px-4' }} md:px-4">
                                <span>Hubungi Kami</span>
                            </a>
                        </div>
                    </div>

                    <div class="mt-12 lg:mt-0 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                        <div class="text-sm font-medium text-gray-700 hidden xl:block">
                            <span class="text-gray-400 font-normal">Call Us:</span> +62 851 2318 2539
                        </div>

                        <a href="#"
                            class="relative flex h-10 w-full sm:w-max items-center justify-center px-6 rounded-full bg-primary hover:bg-primary/90 transition duration-300 shadow-sm">
                            <span class="relative text-xs font-bold text-white tracking-wide">Daftar Sekarang</span>
                        </a>
                    </div>
                </div>
            </div>
        </x-container>
    </nav>
</header>
