<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MultiAuthController extends Controller
{
    // 🧭 Menampilkan form login sesuai role
    public function showLogin($role)
    {
        // Validasi role
        if (!in_array($role, ['admin', 'mahasiswa', 'pic'])) {
            abort(404);
        }

        return view('auth.login', ['role' => $role]);
    }

    // 🔐 Proses login sesuai role
    public function login(Request $request, $role)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentukan tabel berdasarkan role
        $table = match ($role) {
            'admin' => 'admin',
            'mahasiswa' => 'mahasiswa',
            'pic' => 'pic_units',
        };

        // Cek user di tabel terkait
        $user = DB::table($table)->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Simpan session
            session([$role => $user]);

            // Redirect ke dashboard sesuai role
            return redirect("/$role/dashboard");
        }

        return back()->with('error', 'Email atau password salah.');
    }

    // 🚪 Logout
    public function logout(Request $request, $role)
    {
        $request->session()->forget($role);
        return redirect("/login/$role");
    }
}
