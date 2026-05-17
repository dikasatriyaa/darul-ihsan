@extends('layouts.app')

@section('content')
    <!-- Article header — full width dengan background muted -->
    <div class="bg-cover bg-center bg-no-repeat border-b border-border py-12 px-6 pt-36 -mt-10"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.625), rgba(0, 0, 0, 0.636)), url('{{ asset($blog->image ?? 'image/1.jpeg') }}');">

        <div class="max-w-6xl mx-auto">
            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-sm text-white mb-6">
                <a href="{{ route('publikasi.index') }}" class="hover:text-red-700 transition-colors">Index</a>
                <span>›</span>
                <span>{{ $blog->first_tag }}</span>
                <span>›</span>
                <span class="text-white font-medium truncate">{{ $blog->title }}</span>
            </div>

            <!-- Kategori pill -->
            <span
                class="inline-flex items-center px-3 py-1.5 bg-red-800 border border-primary/20 rounded-full text-white text-xs font-semibold mb-4">{{ $blog->first_tag }}</span>

            <!-- Judul -->
            <h1 class="text-3xl text-white md:text-4xl font-extrabold tracking-tight leading-snug mb-5 max-w-3xl">
                {{ $blog->title }}
            </h1>

            <!-- Meta info -->
            <div class="flex flex-wrap items-center gap-4 text-sm text-white">
                <div class="flex items-center gap-2 text-white">
                    <div
                        class="w-7 h-7 rounded-full bg-primary flex items-center justify-center text-white text-xs font-bold shrink-0">
                        {{ $blog->user->initial ?? 'A' }}</div>
                    <span class="font-medium text-white">{{ $blog->user->name ?? 'Admin' }}</span>
                </div>
                <span>·</span>
                <span>{{ $blog->created_at->format('d F Y') }}</span>
                <span>·</span>
                <span>{{ $blog->read_time }} menit baca</span>
                <span>·</span>
                <span>{{ $blog->formatted_views }} dibaca</span>
            </div>
        </div>
    </div>

    <!-- Main layout: artikel + sidebar -->
    <div class="max-w-6xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- ══ KONTEN ARTIKEL ══ -->
            <article class="lg:col-span-2 min-w-0">

                <!-- Cover image placeholder -->
                <div class="w-full h-56 bg-muted border border-border rounded-3xl flex items-center justify-center mb-8">
                    <img src="{{ asset($blog->image ?? 'image/1.jpeg') }}" alt="{{ $blog->title }}"
                        class="w-full h-full object-cover">
                </div>

                <!-- Isi artikel -->
                <div class="space-y-5">
                    {!! $blog->body !!}
                </div>

                <!-- Tags -->
                <div class="flex flex-wrap gap-2 mt-10 pt-8 border-t border-border">
                    @forelse ($blog->tag_array as $tag)
                        <span
                            class="px-3 py-1.5 bg-muted border border-border rounded-full text-black text-xs font-semibold hover:border-primary/30 hover:text-black transition-colors cursor-pointer">
                            {{ $tag }}
                        </span>
                    @empty
                        <span
                            class="px-3 py-1.5 bg-muted border border-border rounded-full text-black text-xs font-semibold">
                            Artikel
                        </span>
                    @endforelse
                </div>

                <!-- Author bio -->
                <div class="mt-8 bg-muted border border-border rounded-3xl p-6 flex items-start gap-4">
                    <div
                        class="w-14 h-14 rounded-full bg-primary flex items-center justify-center text-white font-bold shrink-0">
                        {{ $blog->user->initial ?? 'A' }}</div>
                    <div>
                        <p class="font-bold text-fore">{{ $blog->user->name ?? 'Admin' }}</p>
                        <p class="text-xs text-black mb-2">{{ $blog->user->pekerjaan ?? '' }}</p>
                        <p class="text-sm text-black leading-relaxed">{{ $blog->user->deskripsi ?? '' }}
                        </p>
                    </div>
                </div>

            </article>

            <!-- ══ SIDEBAR ══ -->
            <aside class="lg:col-span-1">
                <div class="lg:sticky lg:top-24 space-y-5">

                    <!-- CTA card -->
                    <div class="bg-primary border border-primary rounded-3xl p-6 relative overflow-hidden">
                        <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-white/5 rounded-full"></div>
                        <div class="relative">
                            <p class="font-bold text-white mb-2">Mau tahu lebih banyak Darul Ihsan?</p>
                            <p class="text-blue-100 text-sm leading-relaxed mb-4">Yuk! ikuti seluruh publikasi keseharian
                                dan keseruan lainnya di
                                Darul Ihsan</p>
                            <a href="{{ route('publikasi.index') }}"
                                class="flex items-center justify-center gap-2 w-full py-2.5 bg-white hover:bg-blue-50 active:scale-95 text-black font-bold text-sm rounded-full transition-all cursor-pointer border-0">
                                Lihat Publikasi
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white border border-border rounded-3xl p-5">
                        <p class="font-semibold text-fore text-sm mb-4">Artikel Terkait</p>

                        <div class="space-y-4">
                            @forelse($relatedBlogs as $item)
                                <a href="{{ route('publikasi.show', $item->slug) }}" class="flex gap-3 group">

                                    <div
                                        class="w-16 h-16 bg-muted border border-border rounded-2xl overflow-hidden shrink-0">
                                        <img src="{{ asset($item->image ?? 'image/1.jpeg') }}"
                                            class="w-full h-full object-cover">
                                    </div>`

                                    <div class="min-w-0">
                                        <p
                                            class="text-sm font-semibold text-fore leading-snug group-hover:text-black transition-colors line-clamp-2">
                                            {{ $item->title }}
                                        </p>
                                        <p class="text-xs text-black mt-1">
                                            {{ $item->read_time }} menit baca
                                        </p>
                                    </div>
                                </a>
                            @empty
                                <p class="text-xs text-black">Belum ada artikel terkait.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Kategori dari Blog Ini --}}
                    <div class="bg-white border border-border rounded-3xl p-5">
                        <p class="font-semibold text-fore text-sm mb-4">Kategori</p>

                        <div class="flex flex-wrap gap-2">
                            @foreach ($blog->tag_array as $tag)
                                <span
                                    class="px-3 py-1.5 bg-primary/10 border border-primary/20 rounded-full text-black text-xs font-semibold">
                                    {{ trim($tag) }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                </div>
            </aside>

        </div>
    </div>
@endsection
