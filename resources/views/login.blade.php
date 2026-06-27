<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Koperasi Gumati') }} - Login Sistem</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif
</head>

<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
        <div class="bg-slate-50 p-6 border-b border-slate-200 text-center">
            <div class="bg-emerald-600 p-2.5 rounded-xl text-white inline-block shadow-xs mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
            </div>
            <h2 class="text-slate-900">Portal Keamanan Admin</h2>
            <p class="text-slate-500 mt-1">Masukkan kredensial nomor telepon resmi Koperasi Gumati</p>
        </div>

        <form action="{{ url('/login') }}" method="POST" class="p-6 space-y-4">
            @csrf

            @if ($errors->any())
                <div class="bg-rose-50 border border-rose-100 text-rose-700 text-xs p-3.5 rounded-xl font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <label for="phone_number">No. Telepon Admin</label>
                <input type="text" name="phone_number" id="phone_number" autocomplete="off" required placeholder="08....."
                    value="{{ old('phone_number') }}">
            </div>

            <div>
                <label for="password">Kata Sandi (Password)</label>
                <input type="password" name="password" id="password" autocomplete="off" required placeholder="••••••••">
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" class="m-0! w-4! h-4!">
                <label class="m-0! items-center cursor-pointer">Ingat Akun</label>
            </div>

            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-green-50 font-bold py-3 px-4 rounded-xl text-sm transition shadow-xs hover:shadow-md cursor-pointer pt-3">
                Masuk Sebagai Admin
            </button>

            <a href="{{ url('/') }}"
                class="block text-center text-xs text-slate-400 hover:text-slate-600 transition pt-1">
                Kembali ke Beranda Utama
            </a>
        </form>
    </div>

</body>

</html>
