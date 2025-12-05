<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class MahasiswaProfileController extends Controller
{
    public function show()
    {
        $mahasiswa = Mahasiswa::find(session('mahasiswa')->id);

        return view('aduan.profile', compact('mahasiswa'));
    }

    public function update(Request $request)
    {
        $mahasiswa = Mahasiswa::find(session('mahasiswa')->id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:20',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'angkatan' => 'nullable|string|max:4',
            'prodi' => 'nullable|string|max:100',
            'foto_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // ===== Upload ke Cloudinary =====
        if ($request->hasFile('foto_profile')) {

            // Upload
            $upload = Cloudinary::upload(
                $request->file('foto_profile')->getRealPath(),
                [
                    'folder' => 'sipadu/profile',
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ]
            );

            // Simpan URL
            $mahasiswa->foto_profile = $upload->getSecurePath();
        }

        // ===== Update field lainnya =====
        $mahasiswa->nama = $request->nama;
        $mahasiswa->npm = $request->npm;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->prodi = $request->prodi;

        $mahasiswa->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
