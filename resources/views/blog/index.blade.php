@extends('layouts.app') {{-- sesuaikan jika nama layout berbeda --}}

@section('content')
    <section class="bg-white py-16 pt-30">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Header --}}
            <div class="text-center mb-14" data-aos="fade-up">
                <h1 class="text-4xl font-bold text-slate-800">
                    Publikasi & Artikel
                </h1>
                <p class="mt-4 text-slate-500 max-w-2xl mx-auto">
                    Informasi terbaru kegiatan pesantren, prestasi santri, dan artikel edukatif Islami.
                </p>
            </div>

            {{-- Grid Blog --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse($blogs as $blog)
                    <article
                        class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition duration-300 overflow-hidden border border-slate-100"
                        data-aos="fade-up">

                        {{-- Gambar --}}
                        <a href="{{ route('publikasi.show', $blog->slug) }}">
                            <img src="{{ asset($blog->image ?? 'image/2.jpeg') }}" class="w-full h-52 object-cover"
                                alt="{{ $blog->title }}">
                        </a>

                        <div class="p-6">

                            {{-- Tag --}}
                            <span
                                class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 mb-3">
                                {{ $blog->first_tag }}
                            </span>

                            {{-- Judul --}}
                            <h2 class="text-lg font-bold text-slate-800 leading-snug mb-3">
                                <a href="{{ route('publikasi.show', $blog->slug) }}"
                                    class="hover:text-emerald-600 transition">
                                    {{ $blog->title }}
                                </a>
                            </h2>

                            {{-- Excerpt --}}
                            <p class="text-sm text-slate-500 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($blog->body), 120) }}
                            </p>

                            {{-- Meta --}}
                            <div class="flex items-center justify-between text-xs text-slate-400">

                                <div class="flex items-center gap-2">
                                    <span>{{ $blog->user->name ?? 'Admin' }}</span>
                                    <span>•</span>
                                    <span>{{ $blog->created_at->format('d M Y') }}</span>
                                </div>

                                <div class="flex items-center gap-1">
                                    <span>{{ $blog->formatted_views ?? 0 }}</span>
                                    <span>dibaca</span>
                                </div>

                            </div>
                        </div>
                    </article>

                @empty
                    <div class="col-span-3 text-center py-20 text-slate-400">
                        Belum ada artikel tersedia.
                    </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-14">
                {{ $blogs->links() }}
            </div>

        </div>
    </section>
@endsection
