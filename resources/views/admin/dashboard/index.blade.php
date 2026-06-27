@extends('layouts.app')

@section('title', 'Dashboard Rekap Koperasi')

@section('content')
    <div class="space-y-8">
        <div class="flex justify-between items-center mb-6`">
            <div>
                <h1 class="text-slate-950">Dashboard Admin</h1>
                <p class="text-slate-500">Ringkasan total dana kumulatif dan posisi piutang seluruh anggota.</p>
            </div>
            <a href="{{ route('admin.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg text-sm shadow-xs transition">
                + Tambah Anggota
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="bg-blue-50 p-3 rounded-lg text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Simpanan Pokok</p>
                    <h3 class="text-xl font-bold text-slate-900 mt-1">Rp
                        {{ number_format($grand_total_pokok, 0, ',', '.') }}</h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="bg-purple-50 p-3 rounded-lg text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Simpanan Wajib</p>
                    <h3 class="text-xl font-bold text-slate-900 mt-1">Rp
                        {{ number_format($grand_total_wajib, 0, ',', '.') }}</h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="bg-rose-50 p-3 rounded-lg text-rose-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 00-2 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Piutang Anggota</p>
                    <h3 class="text-xl font-bold text-slate-900 mt-1">Rp
                        {{ number_format($grand_total_piutang, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-xs border border-slate-200 overflow-hidden">
            <div class="p-5 border-b border-slate-200 bg-slate-50/50">
                <h3 class="text-slate-900">Buku Besar Informasi Anggota</h3>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-slate-50 border-b border-slate-200 text-xs font-bold uppercase text-slate-500 tracking-wider">
                        <th class="p-4">Nama Anggota</th>
                        <th class="p-4">No. Telepon</th>
                        <th class="p-4 text-right">Simp. Pokok</th>
                        <th class="p-4 text-right">Simp. Wajib</th>
                        <th class="p-4 text-right">Sisa Pinjaman (Piutang)</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-slate-700 divide-y divide-slate-100">
                    @forelse($members as $member)
                        <tr class="hover:bg-slate-50/30">
                            <td class="p-4 font-semibold text-slate-900">{{ $member->name }}</td>
                            <td class="p-4 text-slate-500">{{ $member->phone_number }}</td>
                            <td class="p-4 text-right font-medium text-slate-900">
                                Rp {{ number_format($member->total_pokok ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="p-4 text-right font-medium text-slate-900">
                                Rp {{ number_format($member->total_wajib ?? 0, 0, ',', '.') }}
                            </td>
                            <td
                                class="p-4 text-right font-bold {{ ($member->total_piutang ?? 0) > 0 ? 'text-rose-600' : 'text-slate-400' }}">
                                Rp {{ number_format($member->total_piutang ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-400 bg-slate-50/30">Belum ada data anggota
                                koperasi terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $members->links() }}
        </div>
    </div>
@endsection
