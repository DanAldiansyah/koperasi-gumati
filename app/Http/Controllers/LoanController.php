<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\User;

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
