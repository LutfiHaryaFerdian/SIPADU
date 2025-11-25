<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PicController extends Controller
{
    public function index()
    {
        $pic = session('pic');

        $totalTugas = DB::table('penugasan')->where('id_pic', $pic->id)->count();

        $aduanIds = DB::table('penugasan')
            ->where('id_pic', $pic->id)
            ->pluck('id_aduan')
            ->toArray();

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

        $aduanTerbaru = DB::table('aduan')
            ->join('penugasan', 'aduan.id', '=', 'penugasan.id_aduan')
            ->where('penugasan.id_pic', $pic->id)
            ->select('aduan.*')
            ->orderByDesc('aduan.created_at')
            ->limit(5)
            ->get();

        return view('dashboard.pic', compact('totalTugas', 'aduanSelesai', 'aduanProses', 'aduanTerbaru'));
    }

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

    public function tindakLanjutForm($id)
    {
        $aduan = DB::table('aduan')->where('id', $id)->first();
        if (!$aduan) {
            return back()->with('error', 'Aduan tidak ditemukan.');
        }

        $pic = session('pic');

        $tindakLanjutTerbaru = DB::table('tindak_lanjut')
            ->where('id_aduan', $id)
            ->where('id_pic', $pic->id)
            ->orderByDesc('created_at')
            ->first();

        return view('pic.tindak_lanjut', compact('aduan', 'tindakLanjutTerbaru'));
    }

    public function tindakLanjutStore(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
            'status' => 'required|in:Selesai,Sedang Dikerjakan',
            'catatan_selesai' => 'nullable|string',
        ]);

        $pic = session('pic');

        DB::table('tindak_lanjut')->insert([
            'id' => Str::uuid(),
            'id_aduan' => $id,
            'id_pic' => $pic->id,
            'catatan' => $request->catatan,
            'catatan_selesai' => $request->catatan_selesai,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->status === 'Selesai') {
            DB::table('aduan')->where('id', $id)->update(['status' => 'Selesai']);
        } elseif ($request->status === 'Sedang Dikerjakan') {
            DB::table('aduan')->where('id', $id)->update(['status' => 'Diproses']);
        }

        return redirect()->route('pic.aduan.index')->with('success', 'Tindak lanjut berhasil ditambahkan.');
    }

    public function viewTindakLanjut($id)
    {
        $aduan = DB::table('aduan')->where('id', $id)->first();
        if (!$aduan) {
            return back()->with('error', 'Aduan tidak ditemukan.');
        }

        $pic = session('pic');

        $tindakLanjutTerbaru = DB::table('tindak_lanjut')
            ->where('id_aduan', $id)
            ->where('id_pic', $pic->id)
            ->orderByDesc('created_at')
            ->first();

        if (!$tindakLanjutTerbaru) {
            return back()->with('error', 'Tindak lanjut tidak ditemukan.');
        }

        // Ambil semua history tindak lanjut (urut dari terbaru)
        $riwayatTindakLanjut = DB::table('tindak_lanjut')
            ->where('id_aduan', $id)
            ->where('id_pic', $pic->id)
            ->orderByDesc('created_at')
            ->get();

        return view('pic.view_tindak_lanjut', compact('aduan', 'tindakLanjutTerbaru', 'riwayatTindakLanjut'));

    }

    public function editCatatanDikerjakan($id)
    {
        $pic = session('pic');

        $tindakLanjutTerbaru = DB::table('tindak_lanjut')
            ->where('id_aduan', $id)
            ->where('id_pic', $pic->id)
            ->where('status', 'Sedang Dikerjakan')
            ->orderByDesc('created_at')
            ->first();

        if (!$tindakLanjutTerbaru) {
            return back()->with('error', 'Tindak lanjut dengan status Sedang Dikerjakan tidak ditemukan.');
        }

        $aduan = DB::table('aduan')->where('id', $id)->first();

        return view('pic.edit_catatan_dikerjakan', compact('aduan', 'tindakLanjutTerbaru'));
    }

    public function updateCatatanDikerjakan(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);

        $pic = session('pic');

        $tindakLanjutTerbaru = DB::table('tindak_lanjut')
            ->where('id_aduan', $id)
            ->where('id_pic', $pic->id)
            ->where('status', 'Sedang Dikerjakan')
            ->orderByDesc('created_at')
            ->first();

        if (!$tindakLanjutTerbaru) {
            return back()->with('error', 'Tindak lanjut tidak ditemukan.');
        }

        DB::table('tindak_lanjut')
            ->where('id', $tindakLanjutTerbaru->id)
            ->update([
                'catatan' => $request->catatan,
                'updated_at' => now(),
            ]);

        return redirect()->route('pic.aduan.index')->with('success', 'Catatan tindak lanjut berhasil diperbarui.');
    }

    public function editCatatanSelesai($id)
    {
        $pic = session('pic');

        $tindakLanjutTerbaru = DB::table('tindak_lanjut')
            ->where('id_aduan', $id)
            ->where('id_pic', $pic->id)
            ->where('status', 'Selesai')
            ->orderByDesc('created_at')
            ->first();

        if (!$tindakLanjutTerbaru) {
            return back()->with('error', 'Tindak lanjut dengan status Selesai tidak ditemukan.');
        }

        // Jika catatan_selesai sudah ada, artinya sudah final dan tidak bisa diedit lagi
        if ($tindakLanjutTerbaru->catatan_selesai) {
            return back()->with('error', 'Catatan penyelesaian sudah final dan tidak bisa diubah lagi.');
        }

        $aduan = DB::table('aduan')->where('id', $id)->first();

        return view('pic.edit_catatan_selesai', compact('aduan', 'tindakLanjutTerbaru'));
    }

    public function updateCatatanSelesai(Request $request, $id)
    {
        $request->validate([
            'catatan_selesai' => 'required|string',
        ]);

        $pic = session('pic');

        $tindakLanjutTerbaru = DB::table('tindak_lanjut')
            ->where('id_aduan', $id)
            ->where('id_pic', $pic->id)
            ->where('status', 'Selesai')
            ->orderByDesc('created_at')
            ->first();

        if (!$tindakLanjutTerbaru) {
            return back()->with('error', 'Tindak lanjut tidak ditemukan.');
        }

        // Cek apakah catatan_selesai sudah ada (final)
        if ($tindakLanjutTerbaru->catatan_selesai) {
            return back()->with('error', 'Catatan penyelesaian sudah final dan tidak bisa diubah lagi.');
        }

        DB::table('tindak_lanjut')
            ->where('id', $tindakLanjutTerbaru->id)
            ->update([
                'catatan_selesai' => $request->catatan_selesai,
                'updated_at' => now(),
            ]);

        return redirect()->route('pic.aduan.index')->with('success', 'Catatan penyelesaian berhasil disimpan.');
    }
}