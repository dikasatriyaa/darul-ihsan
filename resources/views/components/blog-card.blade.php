    <div id="blog" class="bg-red-600 border-border  pt-20 pb-20">
        <x-container>
            <div class="mb-12  space-y-2 text-center">
                <h2 class="text-3xl font-bold text-white md:text-4xl">Publikasi Terakhir</h2>
                <p class="lg:mx-auto lg:w-6/12 text-white">
                    Informasi dan Publikasi terbaru Pondok Pesantren
                </p>
            </div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($blogs as $blog)
                    <div
                        class="group rounded-3xl bg-white border border-gray-100 bg-opacity-50 shadow-2xl shadow-gray-600/10 overflow-hidden">

                        <div class="relative overflow-hidden rounded-none">
                            <span
                                class="absolute top-4 left-4 z-10 rounded-full bg-red-600 px-4 py-1.5 text-xs font-semibold text-white shadow-md">
                                New
                            </span>
                            <img src="{{ asset($blog->image ?? 'image/1.jpeg') }}" alt="{{ $blog->title }}"
                                loading="lazy"
                                class="h-64 w-full object-cover object-top transition duration-500 group-hover:scale-105" />
                        </div>

                        <div class="p-6 sm:p-8 relative">
                            <h3 class="text-2xl font-semibold text-gray-800">
                                {{ $blog->title }}
                            </h3>

                            <p class="mt-2 text-sm text-gray-500">
                                Oleh {{ $blog->user->nama ?? 'Admin' }} •
                                {{ $blog->created_at->format('d M Y') }}
                            </p>

                            <p class="mt-4 mb-6 text-gray-600">
                                {{ \Illuminate\Support\Str::limit(strip_tags($blog->body), 120) }}
                            </p>

                            <a class="inline-block" href="{{ route('publikasi.show', $blog->slug) }}">
                                <span class="text-red-600 font-semibold">Baca Selengkapnya →</span>
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-3 text-center text-white">
                        Belum ada publikasi tersedia.
                    </div>
                @endforelse
            </div>
        </x-container>
    </div>
