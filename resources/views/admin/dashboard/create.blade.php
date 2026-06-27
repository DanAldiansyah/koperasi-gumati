@extends('layouts.app')

@section('title', 'Tambah Pinjaman Baru')

@section('content')
    <div class="max-w-2xl mx-auto bg-slate-100 rounded-xl shadow-xs border border-slate-200 overflow-hidden">
        <div class="bg-slate-200 p-6 border-b border-slate-200">
            <h3 class="text-slate-900">Input Anggota Baru</h3>
            <p class="text-slate-500 mt-1">Pastikan Nama dan No Telpon sesuai.</p>
        </div>

        <form action="{{ route('admin.store') }}" method="POST" class="p-6 space-y-5">
            @csrf

            <div>
                <label for="name">Nama Anggota</label>
                <input type="text" name="name" required autocomplete="off">
            </div>
            
            <div>
                <label for="phone_number">Nomor Telpon</label>
                <input type="text" name="phone_number" required autocomplete="off">
            </div>

            <div>
                <label for="pasword">Masukan Password</label>
                <input type="password" name="password" required autocomplete="off">
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.index') }}"
                    class="bg-slate-50 border border-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg text-sm hover:bg-slate-50">Batal</a>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-slate-50 font-semibold py-2 px-5 rounded-lg text-sm shadow-xs cursor-pointer">Simpan
                    Anggota</button>
            </div>
        </form>
    </div>
@endsection
