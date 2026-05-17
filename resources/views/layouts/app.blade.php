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

<body class="bg-slate-50 ">
    @include('partials.navbar')
    <main class="">
        @yield('content')
    </main>
    @include('partials.footer')
</body>

<script>
    const navbar = document.querySelector("#nav");
    const menuBtn = document.querySelector("#hamburger");
    const navLinks = document.querySelector("#navlinks");
    const navLayer = document.querySelector("#navLayer");
    const links = document.querySelectorAll("#links-group a");

    function toggleMenu() {
        // 1. Mengubah rotasi hamburger menggunakan class bawaan script lama Anda jika masih dipakai
        navbar.classList.toggle("is-active");

        // 2. Memaksa menu & background hitam transparan muncul secara instan bypass aturan group
        navLinks.classList.toggle("invisible");
        navLinks.classList.toggle("opacity-0");
        navLinks.classList.toggle("scale-90");
        navLinks.classList.toggle("translate-y-2");

        // Membuka background backdrop mobile
        // navLayer.classList.toggle("scale-y-0");
        // navLayer.classList.toggle("scale-y-100");
    }

    if (menuBtn) {
        menuBtn.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleMenu();
        });
    }

    // Tutup menu kembali jika salah satu tautan di klik
    links.forEach(function(link) {
        link.addEventListener("click", function() {
            if (!navLinks.classList.contains("invisible")) {
                toggleMenu();
            }
        });
    });

    // Tutup menu jika area transparan (backdrop) diklik
    if (navLayer) {
        navLayer.addEventListener("click", toggleMenu);
    }
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</html>
