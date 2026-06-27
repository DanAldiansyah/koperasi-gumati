<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.index');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone_number' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {

            if (Auth::user()->role !== 'admin') {
                Auth::logout();

                return back()->withErrors([
                    'phone_number' => 'Akses ditolak. Halaman ini khusus untuk Admin Koperasi.',
                ])->onlyInput('phone_number');
            }

            $request->session()->regenerate();

            return redirect()->intended(route('admin.index'))
                ->with('success', 'Berhasil Login Sebagai Admin');
        }

        return back()->withErrors([
            'phone_number' => 'Nomor telepon atau password yang Anda masukkan salah.',
        ])->onlyInput('phone_number');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}
