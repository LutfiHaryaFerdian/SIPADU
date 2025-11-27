<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
        'kategori' => 'required|string',
        'deskripsi' => 'required|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi foto
    ]);

    $fotoUrl = null;

    if ($request->hasFile('foto')) {
        // Upload ke Cloudinary
        $uploadedFile = Cloudinary::upload($request->file('foto')->getRealPath(), [
            'folder' => 'sipadu/aduan'
        ]);

        $fotoUrl = $uploadedFile->getSecurePath();
    }

    DB::table('aduan')->insert([
        'id' => Str::uuid(),
        'id_mahasiswa' => session('mahasiswa')->id,
        'judul' => $request->judul,
        'kategori' => $request->kategori,
        'deskripsi' => $request->deskripsi,
        'foto_url' => $fotoUrl,  // simpan url dari cloudinary
        'status' => 'Menunggu',
        'nomor_tiket' => strtoupper(Str::random(8)),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('aduan.index')
        ->with('success', 'Aduan berhasil dikirim!');
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

    // Menampilkan aduan publik (tanpa identitas pelapor)
    public function publik()
    {
        // Ambil aduan publik (misal: semua aduan, atau filter tertentu jika ada kolom khusus)
        $aduan = DB::table('aduan')
            ->select('judul', 'kategori', 'status', 'nomor_tiket', 'created_at')
            ->orderByDesc('created_at')
            ->get();

        return view('aduan.publik', compact('aduan'));
    }
}
