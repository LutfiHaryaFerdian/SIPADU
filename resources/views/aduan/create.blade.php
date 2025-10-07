@extends('layouts.mahasiswa')

@section('title', 'Buat Aduan Baru')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-blue-700 text-center">Buat Aduan Baru</h2>

    <form method="POST" action="{{ route('aduan.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Judul Aduan</label>
            <input type="text" name="judul" class="border w-full p-3 rounded focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Kategori</label>
            <input type="text" name="kategori" class="border w-full p-3 rounded focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-6">
            <label class="block mb-1 font-semibold">Deskripsi</label>
            <textarea name="deskripsi" rows="5" class="border w-full p-3 rounded focus:ring-2 focus:ring-blue-500" required></textarea>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('aduan.index') }}" class="text-blue-600 hover:underline">← Kembali ke Daftar Aduan</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 shadow">
                Kirim Aduan
            </button>
        </div>
    </form>
</div>
@endsection
