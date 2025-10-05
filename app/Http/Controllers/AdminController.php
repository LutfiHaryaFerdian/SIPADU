<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aduan;
use App\Models\Penugasan;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $aduan = Aduan::where('status', 'Menunggu')->get();
        return view('admin.index', compact('aduan'));
    }

    public function verifikasi($id)
    {
        $aduan = Aduan::findOrFail($id);
        $aduan->update(['status' => 'Diproses']);
        return back()->with('success', 'Aduan berhasil diverifikasi.');
    }

    public function assign(Request $request, $id)
    {
        Penugasan::create([
            'id' => Str::uuid(),
            'id_admin' => session('data')->id,
            'id_pic' => $request->id_pic,
            'id_aduan' => $id,
            'catatan' => $request->catatan,
        ]);

        return back()->with('success', 'Aduan berhasil ditugaskan.');
    }
}
