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
            'foto_ktm' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_bukti' => 'required|array|min:1|max:5',
            'foto_bukti.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'disclaimer' => 'required|accepted',
        ]);

        $fotoKtmUrl = null;
        $fotoBuktiUrls = [];

        // Upload foto KTM
        if ($request->hasFile('foto_ktm')) {
            $uploadedFile = Cloudinary::upload($request->file('foto_ktm')->getRealPath(), [
                'folder' => 'sipadu/aduan/ktm'
            ]);
            $fotoKtmUrl = $uploadedFile->getSecurePath();
        }

        // Upload multiple foto bukti (max 5)
        if ($request->hasFile('foto_bukti')) {
            foreach ($request->file('foto_bukti') as $fotoBukti) {
                $uploadedFile = Cloudinary::upload($fotoBukti->getRealPath(), [
                    'folder' => 'sipadu/aduan/bukti'
                ]);
                $fotoBuktiUrls[] = $uploadedFile->getSecurePath();
            }
        }

        DB::table('aduan')->insert([
            'id' => Str::uuid(),
            'id_mahasiswa' => session('mahasiswa')->id,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'foto_ktm' => $fotoKtmUrl,
            'foto_bukti' => json_encode($fotoBuktiUrls),
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
            ->select('id','judul', 'kategori', 'status', 'nomor_tiket', 'created_at')
            ->orderByDesc('created_at')
            ->get();

        return view('aduan.publik', compact('aduan'));
    }

    // 🔍 Detail aduan publik beserta catatan PIC
    public function publicDetail($id)
    {
        $aduan = DB::table('aduan')
            ->select('id','judul','kategori','status','nomor_tiket','created_at','deskripsi','foto_ktm','foto_bukti','foto_url','id_mahasiswa','status_validasi','catatan_admin')
            ->where('id', $id)
            ->first();

        if (!$aduan) {
            return back()->with('error', 'Aduan tidak ditemukan.');
        }

        // Ambil semua catatan tindak lanjut untuk aduan ini (dari semua PIC)
        $catatanPic = DB::table('tindak_lanjut')
            ->join('pic_units', 'tindak_lanjut.id_pic', '=', 'pic_units.id')
            ->where('tindak_lanjut.id_aduan', $id)
            ->select('tindak_lanjut.*', 'pic_units.nama_pic as pic_nama')
            ->orderByDesc('tindak_lanjut.created_at')
            ->get();

        // Tentukan user type
        $userType = 'public'; // Default publik (tidak login)
        
        if (session('mahasiswa')) {
            // Cek apakah ini pemilik aduan
            if (session('mahasiswa')->id == $aduan->id_mahasiswa) {
                $userType = 'mahasiswa_owner';
            } else {
                $userType = 'mahasiswa';
            }
        } elseif (session('admin')) {
            $userType = 'admin';
        } elseif (session('pic')) {
            $userType = 'pic';
        }

        return view('aduan.detail', compact('aduan', 'catatanPic', 'userType'));
    }
}
