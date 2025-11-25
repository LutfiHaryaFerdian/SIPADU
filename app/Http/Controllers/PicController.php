<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PicController extends Controller
{
    // 📊 Dashboard PIC Unit
    public function index()
    {
        $pic = session('pic');

        // Statistik ringkasan - hitung berdasarkan status terbaru dari setiap aduan
        $totalTugas = DB::table('penugasan')->where('id_pic', $pic->id)->count();
        
        // Ambil semua aduan yang ditugaskan ke PIC ini
        $aduanIds = DB::table('penugasan')
            ->where('id_pic', $pic->id)
            ->pluck('id_aduan')
            ->toArray();

        // Hitung status terbaru untuk setiap aduan
        $aduanSelesai = 0;
        $aduanProses = 0;

        foreach ($aduanIds as $aduanId) {
            $tindakLanjutTerbaru = DB::table('tindak_lanjut')
                ->where('id_aduan', $aduanId)
                ->where('id_pic', $pic->id)
                ->orderByDesc('created_at')
                ->first();

            if ($tindakLanjutTerbaru) {
                if ($tindakLanjutTerbaru->status === 'Selesai') {
                    $aduanSelesai++;
                } elseif ($tindakLanjutTerbaru->status === 'Sedang Dikerjakan') {
                    $aduanProses++;
                }
            }
        }

        // Ambil 5 aduan terbaru
        $aduanTerbaru = DB::table('aduan')
            ->join('penugasan', 'aduan.id', '=', 'penugasan.id_aduan')
            ->where('penugasan.id_pic', $pic->id)
            ->select('aduan.*')
            ->orderByDesc('aduan.created_at')
            ->limit(5)
            ->get();

        return view('dashboard.pic', compact('totalTugas', 'aduanSelesai', 'aduanProses', 'aduanTerbaru'));
    }

    // 📋 Menampilkan semua aduan yang ditugaskan ke PIC ini
    public function indexAduan()
    {
        $pic = session('pic');

        $aduan = DB::table('penugasan')
            ->join('aduan', 'penugasan.id_aduan', '=', 'aduan.id')
            ->join('mahasiswa', 'aduan.id_mahasiswa', '=', 'mahasiswa.id')
            ->select(
                'aduan.*',
                'mahasiswa.nama as nama_mahasiswa',
                'mahasiswa.npm',
                'penugasan.catatan as catatan_admin'
            )
            ->where('penugasan.id_pic', $pic->id)
            ->orderByDesc('aduan.created_at')
            ->get();

        // Tambahkan status terbaru dari tindak_lanjut untuk setiap aduan
        $aduan = $aduan->map(function($item) use ($pic) {
            $tindakLanjutTerbaru = DB::table('tindak_lanjut')
                ->where('id_aduan', $item->id)
                ->where('id_pic', $pic->id)
                ->orderByDesc('created_at')
                ->first();

            $item->status_terbaru = $tindakLanjutTerbaru ? $tindakLanjutTerbaru->status : $item->status;
            return $item;
        });

        return view('pic.aduan_index', compact('aduan'));
    }

    // 🧾 Menampilkan form tindak lanjut
    public function tindakLanjutForm($id)
    {
        $aduan = DB::table('aduan')->where('id', $id)->first();
        if (!$aduan) {
            return back()->with('error', 'Aduan tidak ditemukan.');
        }

        return view('pic.tindak_lanjut', compact('aduan'));
    }

    // 💾 Simpan tindak lanjut
    public function tindakLanjutStore(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
            'status' => 'required|in:Selesai,Sedang Dikerjakan',
        ]);

        $pic = session('pic');

        DB::table('tindak_lanjut')->insert([
            'id' => Str::uuid(),
            'id_aduan' => $id,
            'id_pic' => $pic->id,
            'catatan' => $request->catatan,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Update status aduan berdasarkan tindak lanjut
        if ($request->status === 'Selesai') {
            DB::table('aduan')->where('id', $id)->update(['status' => 'Selesai']);
        } elseif ($request->status === 'Sedang Dikerjakan') {
            DB::table('aduan')->where('id', $id)->update(['status' => 'Diproses']);
        }

        return redirect()->route('pic.aduan.index')->with('success', 'Tindak lanjut berhasil ditambahkan.');
    }
}
