<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aduan;
use Illuminate\Support\Str;

class AduanController extends Controller
{
    public function index()
    {
        $aduan = Aduan::all();
        return view('aduan.index', compact('aduan'));
    }

    public function create()
    {
        return view('aduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required'
        ]);

        Aduan::create([
            'id' => Str::uuid(),
            'id_mahasiswa' => session('data')->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'status' => 'Menunggu',
            'nomor_tiket' => strtoupper(Str::random(8)),
        ]);

        return redirect()->route('aduan.index')->with('success', 'Aduan berhasil dikirim.');
    }
}
