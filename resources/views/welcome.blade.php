<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Koperasi Gumati') }} - Paguyuban Masyarakat Tani</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif
</head>

<body class="bg-slate-50 text-slate-800 antialiased selection:bg-emerald-500 selection:text-white">

    <header
        class="h-20 bg-white/80 backdrop-blur-md flex fixed top-0 left-0 right-0 justify-between items-center px-6 md:px-12 border-b border-slate-200/80 z-50 shadow-xs">
        <div class="flex items-center gap-2.5">
            <div class="bg-emerald-600 p-2 rounded-xl text-white shadow-xs">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M14 12a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <span class="text-base font-extrabold tracking-wider text-slate-900">KOPERASI GUMATI</span>
        </div>
        <nav>
            <a href="{{ route('login') }}"
                class="inline-flex items-center justify-center bg-slate-900 hover:bg-emerald-700 text-white text-sm font-semibold py-2.5 px-5 rounded-xl transition-all duration-200 shadow-xs hover:shadow-md cursor-pointer">
                Masuk ke Sistem
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </a>
        </nav>
    </header>

    <section
        class="min-h-screen flex items-center justify-center pt-20 px-6 relative overflow-hidden bg-radial from-emerald-50/60 to-slate-50">
        <div class="max-w-3xl text-center space-y-6">
            <span
                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60 tracking-wide uppercase">
                🌾 Paguyuban Masyarakat Tani
            </span>

            <h1
                class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-950 tracking-tight leading-none md:leading-tight">
                Membangun Kesejahteraan <br class="hidden md:block">
                <span class="text-green-600 bg-linear-to-r from-green-600 to-teal-600 bg-clip-text">Petani
                    Desa Ciwaru</span>
            </h1>

            <p class="text-base md:text-lg text-slate-600 font-medium max-w-2xl mx-auto leading-relaxed">
                Koperasi Gumati wadah resmi perkumpulan masyarakat tani di Desa Ciwaru, Kabupaten Kuningan. Berkomitmen
                mengelola simpan pinjam secara transparan demi kemajuan agribisnis lokal.
            </p>

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="pt-4 flex flex-col sm:flex-row justify-center gap-3">
                <a href="{{ route('login') }}"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-8 rounded-xl text-sm transition-all duration-200 shadow-sm shadow-emerald-600/20 hover:shadow-lg cursor-pointer">
                    Kelola Transaksi Simpan Pinjam
                </a>
                <a href="#tentang-kami"
                    class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold py-3.5 px-8 rounded-xl text-sm transition duration-150 shadow-2xs">
                    Pelajari Selengkapnya
                </a>
            </div>
        </div>
    </section>

</body>

</html>
