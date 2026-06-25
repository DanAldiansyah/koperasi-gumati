@extends('layouts.app')

@section('title', 'Daftar Simpanan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-950">Riwayat Simpanan Anggota</h1>
            <p class="text-sm text-slate-500">Riwayat transaksi simpanan anggota koperasi GUMATI.</p>
        </div>
        <a href="{{ route('savings.create') }}"
            class="bg-green-600 hover:bg-green-700 text-slate-50 font-semibold py-2 px-4 rounded-lg text-sm shadow-xs transition">
            + Tambah Simpanan
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
                    <th class="p-4">Tanggal Simpan</th>
                    <th class="p-4">Nama Anggota</th>
                    <th class="p-4">Jenis</th>
                    <th class="p-4">Nominal</th>
                    <th class="p-4">Keterangan</th>
                </tr>
            </thead>
            <tbody class="text-sm text-slate-700 divide-y divide-slate-100">
                @forelse($savings as $saving)
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-4">{{ $saving->transaction_date->format('d M Y') }}</td>
                        <td class="p-4 font-semibold text-slate-900">{{ $saving->user->name }}</td>
                        <td class="p-4 uppercase">
                            @if ($saving->type === 'pokok')
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Pokok
                                </span>
                            @else
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-green-800">
                                    Wajib
                                </span>
                            @endif
                        </td>
                        <td class="p-4 text-slate-900">Rp {{ number_format($saving->amount, 0, ',', '.') }}</td>
                        <td class="p-4 text-slate-900">{{ $saving->note ?? '-' }}</td>
                        
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
        {{ $savings->links() }}
    </div>
@endsection
