<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif

    <title>@yield('title', 'Dashboard') - Koperasi Gumati</title>
</head>

<body class="bg-slate-100 text-slate-800">
    <header
        class="h-16 bg-slate-50 flex fixed top-0 left-0 right-0 justify-between items-center px-6 border-b border-slate-200 z-50 shadow-xs">
        <div class="flex items-center gap-3">
            <h2 class="text-slate-900">Koperasi <span class="upercase text-green-600">Gumati</span></h2>
        </div>
        <nav class="flex items-center gap-4">
            <span class="text-sm text-slate-500 font-medium hidden sm:inline">Halo, Admin</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 bg-rose-50 hover:bg-rose-100 text-rose-600 text-sm font-semibold py-2 px-4 rounded-lg transition duration-200 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Keluar
                </button>
            </form>
        </nav>
    </header>

    <div class="min-h-screen flex pt-16">

        <aside
            class="bg-slate-50 border-r border-slate-200 w-64 fixed top-16 bottom-0 left-0 p-4 hidden md:block overflow-y-auto z-40">
            <p class=" text-slate-400 px-3 mb-3">Menu Utama</p>
            <nav class="space-y-1">
                <a class="block px-3 py-2.5 rounded-lg text-sm font-semibold transition duration-150 {{ request()->routeIs('admin.*') ? 'bg-green-50 text-green-600' : 'text-slate-600 hover:bg-green-50 hover:text-green-900' }}"
                    href="{{ route('admin.index') }}">
                    Dashboard
                </a>

                <a class="block px-3 py-2.5 rounded-lg text-sm font-semibold transition duration-150 {{ request()->routeIs('savings.*') ? 'bg-green-50 text-green-600' : 'text-slate-600 hover:bg-green-50 hover:text-green-900' }}"
                    href="{{ route('savings.index') }}">
                    Simpanan
                </a>

                <a class="block px-3 py-2.5 rounded-lg text-sm font-semibold transition duration-150 {{ request()->routeIs('loans.*') ? 'bg-green-50 text-green-600' : 'text-slate-600 hover:bg-green-50 hover:text-green-900' }}"
                    href="{{ route('loans.index') }}">
                    Piutang Pinjaman
                </a>
            </nav>
        </aside>

        <main class="flex-1 md:pl-64 min-w-0">
            <div class="p-6 md:p-8 max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>

    </div>

</body>

</html>
