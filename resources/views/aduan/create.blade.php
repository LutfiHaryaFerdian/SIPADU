@extends('layout.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Buat Aduan Baru</h2>

<form method="POST" action="/mahasiswa/aduan/store" class="bg-white p-6 rounded shadow w-full md:w-2/3">
    @csrf

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Judul Aduan</label>
        <input type="text" name="judul" class="border w-full p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Kategori</label>
        <input type="text" name="kategori" class="border w-full p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Deskripsi Aduan</label>
        <textarea name="deskripsi" rows="4" class="border w-full p-2 rounded" required></textarea>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Kirim Aduan
    </button>
</form>
@endsection
