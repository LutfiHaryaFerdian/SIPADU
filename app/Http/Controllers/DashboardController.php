<?php

namespace App\Http\Controllers;

use App\Models\Aduan;

class DashboardController extends Controller
{
    public function admin()
    {
        $aduan = \App\Models\Aduan::all();

        return view('dashboard.admin', compact('aduan'));
    }

    public function mahasiswa()
    {
        // Pastikan user login
        if (! session()->has('data')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil id mahasiswa dari session
        $id_mahasiswa = session('data')->id;

        // Ambil semua aduan mahasiswa ini
        $aduan = Aduan::where('id_mahasiswa', $id_mahasiswa)->get();

        // Kirim ke view
        return view('dashboard.mahasiswa', compact('aduan'));
    }

    public function pic()
    {
        return view('dashboard.pic');
    }
}
