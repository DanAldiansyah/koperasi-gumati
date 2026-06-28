@extends('layouts.app')

@section('title', 'Tambah Pinjaman Baru')

@section('content')
    <div class="max-w-2xl mx-auto bg-slate-100 rounded-xl shadow-xs border border-slate-200 overflow-hidden">
        <div class="bg-slate-200 p-6 border-b border-slate-200">
            <h3 class="text-slate-900">Input Pinjaman Baru</h3>
            <p class="text-slate-500 mt-1">Pastikan nominal dan peminjam sudah sesuai kwitansi fisik.</p>
        </div>

        <form action="{{ route('loans.update', $loan->id) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="user_id">Nama Anggota</label>
                <input name="user_id" type="text" value="{{ $loan->user->name }}" required disabled>
            </div>

            <div>
                <label for="amount_loaned">Nominal Pinjaman (Rp)</label>
                <div class="relative rounded-lg shadow-xs">
                    <span class="absolute top-2.5 left-3 text-slate-400 text-sm font-medium">Rp</span>
                    <input class="pl-9!" name="amount_loaned" type="text"
                        value="{{ number_format($loan->amount_loaned, 0, ',', '') }}" required autocomplete="off">
                </div>
            </div>

            <div>
                <label for="loan_date" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Pinjam</label>
                <input type="date" name="loan_date" required value="{{ old('loan_date', date('Y-m-d')) }}">
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('loans.index') }}"
                    class="bg-slate-50 border border-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg text-sm hover:bg-slate-50">Batal</a>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-slate-50 font-semibold py-2 px-5 rounded-lg text-sm shadow-xs cursor-pointer">Simpan
                    Pinjaman</button>
            </div>
        </form>
    </div>
@endsection
