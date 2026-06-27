@extends('layouts.app')

@section('title', 'Bayar Angsuran Pinjaman')

@section('content')
    <div class="max-w-2xl mx-auto bg-slate-100 rounded-xl shadow-xs border border-slate-200 overflow-hidden">
        <div class="bg-slate-200 p-6 border-b border-slate-200">
            <h3 class="text-slate-900">Pembayaran Angsuran Pinjaman</h3>
            <p class="text-slate-500 mt-1">Pembayaran Piutang Dengan Dengan Nama Yang Bersangkutan.</p>
        </div>

        <div class="p-6 bg-green-50/50 border-b border-green-100 flex justify-between text-sm">
            <div>
                <p class="text-slate-500 uppercase">Nama Peminjam</p>
                <p class="font-bold! text-slate-900 mt-0.5">{{ $loan->user->name }}</p>
            </div>
            <div class="text-right">
                <p class="text-slate-500 uppercase">Sisa Hutang Saat Ini</p>
                <p class="font-bold! text-rose-600 mt-0.5">Rp {{ number_format($loan->remaining_loan, 0, ',', '.') }}</p>
            </div>
        </div>

        <form action="{{ route('loans.store-payment', $loan->id) }}" method="POST" class="p-6 space-y-5">
            @csrf

            <div>
                <label for="amount">Nominal Simpanan (Rp)</label>
                <div class="relative rounded-lg shadow-xs">
                    <span class="absolute top-2.5 left-3 text-slate-400 text-sm font-medium">Rp</span>
                    <input class="pl-9!" name="amount_paid" type="text" placeholder="0" required autocomplete="off">
                </div>
                <p class="text-slate-400 mt-1">Maksimal input pembayaran: Rp
                    {{ number_format($loan->remaining_loan, 0, ',', '.') }}</p>
            </div>

            @error('error')
                <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-lg text-sm mb-4">
                    {{ $message }}
                </div>
            @enderror

            <div>
                <label for="payment_date">Tanggal Bayar</label>
                <input type="date" name="payment_date" required value="{{ date('Y-m-d') }}" </div>

                <div>
                    <label for="notes">Keterangan (Opsional)</label>
                    <textarea name="note" rows="2" placeholder="Catatan Opsional"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('loans.index') }}"
                        class="bg-slaet-50 border border-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg text-sm hover:bg-slate-50">Batal</a>
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-5 rounded-lg text-sm shadow-xs cursor-pointer">Simpan
                        Pembayaran</button>
                </div>
        </form>
    </div>
@endsection
