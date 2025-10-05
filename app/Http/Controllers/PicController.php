<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TindakLanjut;
use Illuminate\Support\Str;

class PicController extends Controller
{
    public function index()
    {
        return view('pic.index');
    }

    public function tindakLanjut(Request $request)
    {
        $request->validate(['catatan' => 'required', 'status' => 'required']);

        TindakLanjut::create([
            'id' => Str::uuid(),
            'id_aduan' => $request->id_aduan,
            'id_pic' => session('data')->id,
            'catatan' => $request->catatan,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Tindak lanjut berhasil ditambahkan.');
    }
}
