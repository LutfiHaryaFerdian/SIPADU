<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // 🧠 Menampilkan semua aduan
    public function index()
    {
        $aduan = DB::table('aduan')
            ->leftJoin('mahasiswa', 'aduan.id_mahasiswa', '=', 'mahasiswa.id')
            ->select('aduan.*', 'mahasiswa.nama as nama_mahasiswa', 'mahasiswa.npm')
            ->orderByDesc('aduan.created_at')
            ->get();

        $picUnits = DB::table('pic_units')->get();

        return view('admin.aduan_index', compact('aduan', 'picUnits'));
    }

    // 🧩 Menugaskan aduan ke PIC
    public function assignToPic(Request $request, $id)
    {
        $request->validate([
            'id_pic' => 'required|uuid',
        ]);

        // Cek apakah aduan ada
        $aduan = DB::table('aduan')->where('id', $id)->first();
        if (!$aduan) {
            return back()->with('error', 'Aduan tidak ditemukan.');
        }

        // Buat penugasan
        DB::table('penugasan')->insert([
            'id' => Str::uuid(),
            'id_admin' => session('admin')->id,
            'id_pic' => $request->id_pic,
            'id_aduan' => $id,
            'catatan' => $request->catatan ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Update status aduan
        DB::table('aduan')->where('id', $id)->update(['status' => 'Diproses']);

        return back()->with('success', 'Aduan berhasil ditugaskan ke PIC.');
    }

    // 🧾 Ubah status aduan jadi selesai
    public function markAsDone($id)
    {
        DB::table('aduan')->where('id', $id)->update(['status' => 'Selesai']);
        return back()->with('success', 'Aduan berhasil ditandai sebagai selesai.');
    }
}
