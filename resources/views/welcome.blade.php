<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Koperasi Gumati') }}</title>

    @fonts

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body>
    <header class="p-4 flex fixed top-0 left-0 right-0 justify-between border border-b-gray-400">
        <div>
            <h3>KOPERASI GUMATI</h3>
        </div>
        <nav>
            <a href={{ route('savings.index') }}>
                Masuk
            </a>
        </nav>
    </header>

    <section class="min-h-dvh flex justify-center items-center">
        <div>
            <h1>Koperasi Gumati, Paguyuban Masyarakat Tani</h1>
            <p>Koperasi ini adalah perkumpulan masyarakat tani yang ada di desa ciwaru kabupaten Kuningan</p>
        </div>
    </section>
</body>

</html>
