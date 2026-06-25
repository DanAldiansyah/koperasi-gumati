@extends('layouts.app')

@section('title', 'Catat Simpanan Baru')

@section('content')
    <div class="max-w-2xl mx-auto bg-slate-100 rounded-xl shadow-xs border border-slate-200 overflow-hidden">
        <div class="bg-slate-200 p-6 border-b border-slate-200">
            <h3 class="text-slate-900">Catat Simpanan Baru</h3>
            <p class="text-slate-500 mt-1">Pastikan Anda memilih nama anggota dan nominal uang dengan benar sebelum menyimpan
                transaksi.</p>
        </div>

        @if ($errors->any())
            <div class="p-6 bg-rose-50 border-b border-rose-100 text-rose-700 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('savings.store') }}" method="POST" class="p-6">
            @csrf

            <div>
                <label for="user_id">Nama Anggota Koperasi</label>
                <select name="user_id" required>
                    <option value="" disabled selected>-- Pilih Anggota --</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}" {{ old('user_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->name }} ({{ $member->phone_number }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Jenis Simpanan</label>
                <div class="flex gap-6 my-2">
                    <label class="inline-flex! justify-center items-center cursor-pointer">
                        <input type="radio" name="type" value="pokok" class="m-0! w-4 h-4" required
                            {{ old('type') == 'pokok' ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-slate-700 font-medium">Pokok</span>
                    </label>
                    <label class="inline-flex! justify-center items-center cursor-pointer">
                        <input type="radio" name="type" value="wajib" class="m-0! w-4 h-4"
                            {{ old('type') == 'wajib' ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-slate-700 font-medium">Wajib</span>
                    </label>
                </div>
            </div>

            <div>
                <label for="amount">Nominal Simpanan (Rp)</label>
                <div class="relative rounded-lg shadow-xs">
                    <span class="absolute top-2.5 left-3 text-slate-400 text-sm font-medium">Rp</span>
                    <input class="pl-9!" name="amount" type="text" placeholder="0" required autocomplete="off">
                </div>
            </div>

            <div>
                <label for="transaction_date" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Setor</label>
                <input type="date" name="transaction_date" required
                    value="{{ old('transaction_date', date('Y-m-d')) }}">
            </div>

            <div>
                <label for="notes" class="block text-sm font-semibold text-slate-700 mb-2">Keterangan (Opsional)</label>
                <textarea name="note" rows="2" placeholder="Catatan (Opsional)"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('savings.index') }}"
                    class="bg-white border border-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg text-sm hover:bg-slate-50 transition cursor-pointer">
                    Batal
                </a>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-5 rounded-lg text-sm transition shadow-xs cursor-pointer">
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
@endsection
