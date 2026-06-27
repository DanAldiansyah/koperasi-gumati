@extends('layouts.app')

@section('title', 'Daftar Piutang Pinjaman')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-slate-950">Piutang Pinjaman</h1>
            <p class="text-slate-500">Daftar anggota yang memiliki pinjaman berjalan.</p>
        </div>
        <a href="{{ route('loans.create') }}"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg text-sm shadow-xs transition">
            + Tambah Pinjaman
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-xs border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-xs font-bold uppercase text-slate-500 tracking-wider">
                    <th class="p-4">Tanggal Pinjam</th>
                    <th class="p-4">Nama Anggota</th>
                    <th class="p-4">Total Pinjaman</th>
                    <th class="p-4">Sisa Pinjaman</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-slate-700 divide-y divide-slate-100">
                @forelse($loans as $loan)
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-4">{{ $loan->loan_date->format('d M Y') }}</td>
                        <td class="p-4 font-semibold text-slate-900">{{ $loan->user->name }}</td>
                        <td class="p-4 text-slate-900">Rp {{ number_format($loan->amount_loaned, 0, ',', '.') }}</td>
                        <td class="p-4 font-medium text-rose-600">Rp {{ number_format($loan->remaining_loan, 0, ',', '.') }}
                        </td>
                        <td class="p-4">
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-md {{ $loan->status === 'lunas' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-amber-50 text-rose-700 border border-rose-200' }}">
                                {{ $loan->status === 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            @if ($loan->status !== 'lunas')
                                <a href="{{ route('loans.pay', $loan->id) }}"
                                    class="inline-block bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-1.5 px-3 rounded-md shadow-xs transition">
                                    Bayar Angsuran
                                </a>
                            @else
                                <span class="text-xs text-slate-400 font-medium italic">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-400 bg-slate-50/30">Belum ada data pinjaman
                            berjalan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $loans->links() }}
    </div>
@endsection
