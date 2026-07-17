<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::with('user')->latest()->paginate(10);

        return view('admin.loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = User::where('role', 'member')->get();

        return view('admin.loans.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount_loaned' => 'required|numeric|min:1000',
            'loan_date' => 'required|date_format:Y-m-d',
        ]);

        $validated['remaining_loan'] = $validated['amount_loaned'];
        $validated['status'] = 'belum_lunas';

        Loan::create($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Data pinjaman berhasil dicatat!');
    }

    public function pay(Loan $loan)
    {
        return view('admin.loans.pay', compact('loan'));
    }

    public function storePayment(Request $request, Loan $loan)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:1000|max:' . $loan->remaining_loan,
            'payment_date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ], [
            'amount_paid.numeric' => 'Masukan pembayaran dengan valid',
            'amount_paid.max' => 'Jumlah Pembayaran melebihi sisa pinjaman',
        ]);

        DB::transaction(function () use ($request, $loan) {
            LoanPayment::create([
                'loan_id' => $loan->id,
                'amount_paid' => $request->amount_paid,
                'payment_date' => $request->payment_date,
                'note' => $request->note,
            ]);

            $loan->remaining_loan -= $request->amount_paid;

            if ($loan->remaining_loan <= 0) {
                $loan->status = 'lunas';
            }

            $loan->save();
        });

        return redirect()->route('loans.index')->with('success', 'Pembayaran Pinjaman Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loan = Loan::findOrFail($id);
        return view('admin.loans.edit', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);

        $validated = $request->validate([
            'amount_loaned' => 'required|numeric|min:1000',
            'loan_date' => 'required|date_format:Y-m-d',
        ]);

        $total_paid = LoanPayment::where('loan_id', $loan->id)->sum('amount_paid');
        $remaining = $validated['amount_loaned'] - $total_paid;

        $loan->update([
            'amount_loaned' => $validated['amount_loaned'],
            'remaining_loan' => max(0, $remaining),
            'loan_date' => $validated['loan_date'],
            'status' => $remaining <= 0 ? 'lunas' : 'belum_lunas',
        ]);

        return redirect()->route('loans.index')
            ->with('success', 'Berhasil Edit Pinjaman');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Loan::destroy($id);
        return redirect()->route('loans.index')
            ->with('success', 'Berhasil Hapus Pinjaman');
    }
}
