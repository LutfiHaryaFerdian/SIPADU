<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'npm' => 'required|string|max:20|unique:mahasiswa,npm',
            'email' => 'required|email|unique:mahasiswa,email',
            'password' => 'required|min:6',
        ]);

        DB::table('mahasiswa')->insert([
            'id' => Str::uuid(),
            'nama' => $request->nama,
            'npm' => $request->npm,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/login/mahasiswa')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}
