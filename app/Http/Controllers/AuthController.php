<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// HAPUS DB DAN HASH, GUNAKAN Auth
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login sebagai Admin
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        // Coba login sebagai Mahasiswa
        if (Auth::guard('mahasiswa')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/mahasiswa/dashboard');
        }

        // Coba login sebagai PIC
        if (Auth::guard('pic')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/pic/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang diberikan tidak cocok.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Logout dari semua guard yang mungkin aktif
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('mahasiswa')->logout();
        Auth::guard('pic')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
