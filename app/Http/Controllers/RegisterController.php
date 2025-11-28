<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\MahasiswaOtp;
use App\Mail\OtpMail;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'npm' => 'required|string|max:20|unique:mahasiswa,npm',
            'email' => 'required|email|unique:mahasiswa,email',
            'password' => 'required|min:6',
        ]);

        $otp = rand(100000, 999999);

        MahasiswaOtp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expired_at' => now()->addMinutes(5),
        ]);

        session([
            'reg_nama' => $request->nama,
            'reg_npm' => $request->npm,
            'reg_email' => $request->email,
            'reg_password' => Hash::make($request->password),
        ]);

        Mail::to($request->email)->send(new OtpMail($otp));

        return redirect()->route('register.verifyForm')
                         ->with('success', 'Kode OTP telah dikirim ke email Anda.');
    }

    public function verifyForm()
    {
        return view('auth.verify_otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        $otpData = MahasiswaOtp::where('email', session('reg_email'))
            ->where('otp', $request->otp)
            ->where('expired_at', '>', now())
            ->first();

        if (!$otpData) {
            return back()->with('error', 'OTP salah atau sudah kedaluwarsa.');
        }

        DB::table('mahasiswa')->insert([
            'id' => Str::uuid(),
            'nama' => session('reg_nama'),
            'npm' => session('reg_npm'),
            'email' => session('reg_email'),
            'password' => session('reg_password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MahasiswaOtp::where('email', session('reg_email'))->delete();

        session()->forget(['reg_nama', 'reg_npm', 'reg_email', 'reg_password']);

        return redirect('/login/mahasiswa')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}
