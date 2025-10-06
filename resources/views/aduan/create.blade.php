@extends('layout.base')

@section('title', 'Buat Aduan Baru')

@section('content')
    <form method="POST" action="{{ route('aduan.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Judul Aduan</label>
            <input type="text" name="judul" class="border w-full p-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Kategori</label>
            <input type="text" name="kategori" class="border w-full p-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="border w-full p-2 rounded" rows="4" required></textarea>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Kirim Aduan
        </button>
    </form>

    <div class="mt-4 text-center">
        <a href="{{ route('aduan.index') }}" class="text-blue-600 hover:underline">← Kembali ke Daftar Aduan</a>
    </div>
@endsection
