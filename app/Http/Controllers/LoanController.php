<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
            'loan_date' => 'required|date',
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
        if ($request->amount_paid > $loan->remaining_loan) {
            throw ValidationException::withMessages(['error' => 'Jumlah pembayaran melebihi jumlah pinjaman']);
        }

        $request->validate([
            'amount_paid' => 'required|numeric|min:1000|max:'.$loan->remaining_loan,
            'payment_date' => 'required|date',
            'note' => 'nullable|string|max:255',
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
