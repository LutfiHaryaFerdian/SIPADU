<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Cek sebagai Admin
        $admin = DB::table('admin')->where('email', $credentials['email'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            session(['admin' => $admin]);
            return redirect('/admin/dashboard');
        }

        // Cek sebagai Mahasiswa
        $mahasiswa = DB::table('mahasiswa')->where('email', $credentials['email'])->first();
        if ($mahasiswa && Hash::check($credentials['password'], $mahasiswa->password)) {
            session(['mahasiswa' => $mahasiswa]);
            return redirect('/mahasiswa/dashboard');
        }

        // Cek sebagai PIC
        $pic = DB::table('pic_units')->where('email', $credentials['email'])->first();
        if ($pic && Hash::check($credentials['password'], $pic->password)) {
            session(['pic' => $pic]);
            return redirect('/pic/dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
}
