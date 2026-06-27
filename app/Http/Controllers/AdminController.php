<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $members = User::where('role', 'member')
            ->withSum(['savings as total_pokok' => function ($query) {
                $query->where('type', 'pokok');
            }], 'amount')
            ->withSum(['savings as total_wajib' => function ($query) {
                $query->where('type', 'wajib');
            }], 'amount')
            ->withSum(['loans as total_piutang' => function ($query) {
                $query->where('status', 'belum_lunas');
            }], 'remaining_loan')
            ->latest()
            ->paginate(10);

        $grand_total_pokok = $members->sum('total_pokok');
        $grand_total_wajib = $members->sum('total_wajib');
        $grand_total_piutang = $members->sum('total_piutang');

        return view('admin.dashboard.index', compact('members', 'grand_total_pokok', 'grand_total_wajib', 'grand_total_piutang'));
    }

    public function create()
    {
        return view('admin.dashboard.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'phone_number' => 'required|string|min:10',
            'password' => 'required|string|min:8',
            'role' => 'member',
        ]);

        User::create([
            'name' => $validated['name'],
            'phone_number' => $validated['phone_number'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.index')->with('success', 'Berhasil Menambahkan Anggota');
    }
}
