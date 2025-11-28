<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // 📊 Dashboard Admin
    public function index()
    {
        // Hitung statistik aduan
        $totalAduan = DB::table('aduan')->count();
        $aduanProses = DB::table('aduan')->where('status', 'Diproses')->count();
        $aduanSelesai = DB::table('aduan')->where('status', 'Selesai')->count();

        // Ambil 5 aduan terbaru
        $aduanTerbaru = DB::table('aduan')
            ->join('mahasiswa', 'aduan.id_mahasiswa', '=', 'mahasiswa.id')
            ->select('aduan.*', 'mahasiswa.nama as nama_mahasiswa')
            ->orderByDesc('aduan.created_at')
            ->limit(5)
            ->get();

        return view('dashboard.admin', compact('totalAduan', 'aduanProses', 'aduanSelesai', 'aduanTerbaru'));
    }

    // 🧠 Menampilkan semua aduan
    public function indexAduan()
    {
        $aduan = DB::table('aduan')
            ->leftJoin('mahasiswa', 'aduan.id_mahasiswa', '=', 'mahasiswa.id')
            ->select('aduan.*', 'mahasiswa.nama as nama_mahasiswa', 'mahasiswa.npm')
            ->orderByDesc('aduan.created_at')
            ->get();

        $picUnits = DB::table('pic_units')->get();

        return view('admin.aduan_index', compact('aduan', 'picUnits'));
    }

    // 🔍 Detail aduan untuk admin (validasi)
    public function detailAduan($id)
    {
        $aduan = DB::table('aduan')
            ->leftJoin('mahasiswa', 'aduan.id_mahasiswa', '=', 'mahasiswa.id')
            ->where('aduan.id', $id)
            ->select('aduan.*', 'mahasiswa.nama as nama_mahasiswa', 'mahasiswa.npm', 'mahasiswa.email')
            ->first();

        if (!$aduan) {
            return back()->with('error', 'Aduan tidak ditemukan.');
        }

        $picUnits = DB::table('pic_units')->get();

        return view('admin.aduan_detail', compact('aduan', 'picUnits'));
    }

    // 🧩 Menugaskan aduan ke PIC
    public function assignToPic(Request $request, $id)
    {
        $request->validate([
            'id_pic' => 'required|uuid',
        ]);

        // Cek apakah aduan ada dan sudah valid
        $aduan = DB::table('aduan')->where('id', $id)->first();
        if (!$aduan) {
            return back()->with('error', 'Aduan tidak ditemukan.');
        }

        if ($aduan->status_validasi !== 'Valid') {
            return back()->with('error', 'Aduan harus divalidasi terlebih dahulu sebelum ditugaskan.');
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

    // ✅ Validasi aduan (Valid)
    public function validateAduan(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:1000',
        ]);

        $aduan = DB::table('aduan')->where('id', $id)->first();
        if (!$aduan) {
            return back()->with('error', 'Aduan tidak ditemukan.');
        }

        DB::table('aduan')->where('id', $id)->update([
            'status_validasi' => 'Valid',
            'catatan_admin' => $request->catatan_admin,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Aduan berhasil divalidasi sebagai Valid.');
    }

    // ❌ Tolak aduan (Tidak Valid)
    public function rejectAduan(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:1000',
        ]);

        $aduan = DB::table('aduan')->where('id', $id)->first();
        if (!$aduan) {
            return back()->with('error', 'Aduan tidak ditemukan.');
        }

        DB::table('aduan')->where('id', $id)->update([
            'status_validasi' => 'Tidak Valid',
            'catatan_admin' => $request->catatan_admin,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Aduan berhasil ditolak.');
    }

    // 🧾 Ubah status aduan jadi selesai
    public function markAsDone($id)
    {
        DB::table('aduan')->where('id', $id)->update(['status' => 'Selesai']);
        return back()->with('success', 'Aduan berhasil ditandai sebagai selesai.');
    }
}
