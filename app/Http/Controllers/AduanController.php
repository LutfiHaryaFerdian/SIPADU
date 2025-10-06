<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AduanController extends Controller
{
    // 🧩 Menampilkan daftar aduan mahasiswa
    public function index()
    {
        $mahasiswa = session('mahasiswa');
        $aduan = DB::table('aduan')->where('id_mahasiswa', $mahasiswa->id)->get();

        return view('aduan.index', compact('aduan'));
    }

    // 📝 Form tambah aduan
    public function create()
    {
        return view('aduan.create');
    }

    // 💾 Simpan aduan baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
        ]);

        DB::table('aduan')->insert([
            'id' => Str::uuid(),
            'id_mahasiswa' => session('mahasiswa')->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'status' => 'Menunggu',
            'nomor_tiket' => strtoupper(Str::random(8)),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/mahasiswa/aduan')->with('success', 'Aduan berhasil dikirim.');
    }

    // ❌ Hapus aduan (oleh mahasiswa)
    public function destroy($id)
    {
        $aduan = DB::table('aduan')->where('id', $id)->first();

        if ($aduan && $aduan->id_mahasiswa == session('mahasiswa')->id) {
            DB::table('aduan')->where('id', $id)->delete();
            return back()->with('success', 'Aduan berhasil dihapus.');
        }

        return back()->with('error', 'Aduan tidak ditemukan atau tidak bisa dihapus.');
    }
}
