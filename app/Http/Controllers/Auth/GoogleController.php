<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login/mahasiswa')->with('error', 'Gagal login dengan Google.');
        }

        // Cek apakah mahasiswa sudah terdaftar
        $mahasiswa = DB::table('mahasiswa')->where('email', $googleUser->email)->first();

        // Jika belum ada 
        if (!$mahasiswa) {
            return redirect('/login/mahasiswa')
                ->with('error', 'Akun Google Anda belum terdaftar. Silakan melakukan registrasi terlebih dahulu.');
        }
        
        // Simpan ke session login kamu
        session(['mahasiswa' => $mahasiswa]);

        return redirect()->route('mahasiswa.dashboard');
    }
}
