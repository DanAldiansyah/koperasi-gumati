<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saving;
use App\Models\User;

class SavingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savings = Saving::with('user')->latest()->paginate(10);
        return view('admin.savings.index', compact('savings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = User::where('role', 'member')->get();
        return view('admin.savings.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:pokok,wajib',
            'amount' => 'required|numeric|min:1000',
            'transaction_date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ]);

        Saving::create($validated);

        return redirect()->route('savings.index')
            ->with('success', 'Data simpanan berhasil dicatat!');
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
