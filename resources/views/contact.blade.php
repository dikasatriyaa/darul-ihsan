@extends('layouts.app')

@section('content')
    <section class="bg-white py-16 pt-30">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">

            {{-- Header --}}
            <div class="text-center mb-16" data-aos="fade-up">
                <h1 class="text-4xl font-bold text-slate-800">
                    Hubungi Kami
                </h1>
                <p class="mt-4 text-white">
                    Silakan hubungi kami untuk informasi pendaftaran atau kerja sama.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12">

                {{-- Info Kontak --}}
                <div data-aos="fade-right">
                    <div class="bg-gray-800 p-8 rounded-3xl shadow-sm space-y-6">

                        <div>
                            <h3 class="font-bold text-white">Alamat</h3>
                            <p class="text-white text-sm">
                                Jl. Jambi - Palembang KM.24, Desa Nagasari, Kec. Mestong, Kab. Muaro Jambi, Jambi, 36364
                            </p>
                        </div>

                        <div>
                            <h3 class="font-bold text-white">Telepon</h3>
                            <p class="text-white text-sm">
                                +62 851 2318 2539
                            </p>
                        </div>

                        <div>
                            <h3 class="font-bold text-white">Email</h3>
                            <p class="text-white text-sm">
                                darulihsancenter.contact@gmail.com
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Form Kontak --}}
                <div data-aos="fade-left">
                    @php
                        $type = session('success') ? 'success' : (session('error') ? 'error' : null);

                        $message = session('success') ?? session('error');
                    @endphp

                    @if ($message)
                        <x-alert :type="$type" :message="$message" />
                    @endif
                    <form action="{{ route('contact.send') }}" method="POST"
                        class="bg-white border border-red-300 shadow-sm p-8 rounded-3xl space-y-6">

                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" required title="Masukkan Nama Kamu"
                                placeholder="Masukkan Nama Kamu"
                                class="w-full border border-slate-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Email
                            </label>
                            <input type="email" name="email" required title="Masukkan email aktif"
                                placeholder="example@email.com"
                                class="w-full border border-slate-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Pesan
                            </label>
                            <textarea rows="4" name="message" required
                                class="w-full border border-slate-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-red-800 hover:bg-emerald-700 text-white font-semibold py-3 rounded-xl transition">
                            Kirim Pesan
                        </button>

                    </form>
                </div>

            </div>

        </div>
    </section>
@endsection
