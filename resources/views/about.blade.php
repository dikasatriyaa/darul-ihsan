@extends('layouts.app')

@section('content')
    <section class="bg-white py-16 pt-30">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">

            {{-- Header --}}
            <div class="text-center mb-16" data-aos="fade-up">
                <h1 class="text-4xl font-bold text-slate-800">
                    Tentang Kami
                </h1>
                <p class="mt-4 text-slate-500 max-w-2xl mx-auto">
                    PPS. Darul Ihsan Islamic Center adalah pesantren modern yang berkomitmen mencetak generasi Qur'ani,
                    berakhlak mulia, dan unggul dalam ilmu pengetahuan.
                </p>
            </div>

            {{-- Profil --}}
            <div class="grid lg:grid-cols-2 gap-12 items-center mb-20">

                <div data-aos="fade-right">
                    <img src="{{ asset('image/2.jpeg') }}" class="rounded-3xl shadow-lg w-full object-cover" alt="Pesantren">
                </div>

                <div data-aos="fade-left">
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">
                        Visi Kami
                    </h2>
                    <p class="text-slate-600 leading-relaxed mb-6">
                        Menjadi lembaga pendidikan Islam modern yang unggul dalam pembinaan karakter,
                        akademik, dan spiritualitas untuk membentuk generasi pemimpin masa depan.
                    </p>

                    <h2 class="text-2xl font-bold text-slate-800 mb-4">
                        Misi Kami
                    </h2>
                    <ul class="space-y-3 text-slate-600">
                        <li>• Membina santri berakhlak Qur'ani</li>
                        <li>• Mengintegrasikan kurikulum diniyah dan umum</li>
                        <li>• Mengembangkan potensi akademik dan non-akademik</li>
                        <li>• Menciptakan lingkungan belajar Islami dan modern</li>
                    </ul>
                </div>
            </div>

            {{-- Nilai --}}
            <div class="grid md:grid-cols-3 gap-8 text-center" data-aos="fade-up">

                <div class="bg-slate-50 p-8 rounded-3xl shadow-sm">
                    <h3 class="font-bold text-lg text-slate-800 mb-3">Keislaman</h3>
                    <p class="text-slate-500 text-sm">
                        Berlandaskan Al-Qur'an dan Sunnah dalam setiap aktivitas pendidikan.
                    </p>
                </div>

                <div class="bg-slate-50 p-8 rounded-3xl shadow-sm">
                    <h3 class="font-bold text-lg text-slate-800 mb-3">Integritas</h3>
                    <p class="text-slate-500 text-sm">
                        Menanamkan nilai kejujuran, disiplin, dan tanggung jawab.
                    </p>
                </div>

                <div class="bg-slate-50 p-8 rounded-3xl shadow-sm">
                    <h3 class="font-bold text-lg text-slate-800 mb-3">Keunggulan</h3>
                    <p class="text-slate-500 text-sm">
                        Mendorong santri untuk berprestasi di tingkat nasional dan internasional.
                    </p>
                </div>

            </div>

        </div>
    </section>
@endsection
