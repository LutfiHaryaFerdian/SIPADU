<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\MahasiswaOtp;
use App\Mail\ResetPasswordOtpMail;

class ForgotPasswordController extends Controller
{
    public function showEmailForm()
    {
        return view('auth.forgot_email');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:mahasiswa,email',
        ]);

        $otp = rand(100000, 999999);

        MahasiswaOtp::where('email', $request->email)->delete();

        MahasiswaOtp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expired_at' => now()->addMinutes(5),
        ]);

        session(['forgot_email' => $request->email]);

        Mail::to($request->email)->send(new ResetPasswordOtpMail($otp));

        return redirect()->route('forgot.verifyForm')->with('success', 'OTP sudah dikirim ke email Anda.');
    }

    public function showVerifyForm()
    {
        return view('auth.forgot_verify_otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required']);

        $otpData = MahasiswaOtp::where('email', session('forgot_email'))
            ->where('otp', $request->otp)
            ->where('expired_at', '>', now())
            ->first();

        if (!$otpData) {
            return back()->with('error', 'OTP salah atau sudah kedaluwarsa.');
        }

        MahasiswaOtp::where('email', session('forgot_email'))->delete();

        session(['otp_verified' => true]);

        return redirect()->route('forgot.resetForm');
    }

    public function showResetForm()
    {
        if (!session('otp_verified')) {
            return redirect()->route('forgot.email');
        }

        return view('auth.reset_password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        DB::table('mahasiswa')
            ->where('email', session('forgot_email'))
            ->update([
                'password' => Hash::make($request->password),
                'updated_at' => now(),
            ]);

        session()->forget(['forgot_email', 'otp_verified']);

        return redirect('/login/mahasiswa')->with('success', 'Password berhasil direset! Silakan login.');
    }
}
