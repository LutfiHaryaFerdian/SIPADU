@extends('layouts.pic')

@section('title', 'Tindak Lanjut Aduan')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-yellow-700 text-center">Tindak Lanjut Aduan</h2>

    <div class="mb-4 text-sm text-gray-700">
        <p><strong>Judul:</strong> {{ $aduan->judul }}</p>
        <p><strong>Kategori:</strong> {{ $aduan->kategori }}</p>
    </div>

    <form method="POST" action="{{ route('pic.tindaklanjut.store', $aduan->id) }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Catatan Tindak Lanjut</label>
            <textarea name="catatan" class="border w-full p-3 rounded focus:ring-2 focus:ring-yellow-500" rows="5" required></textarea>
        </div>

        <div class="mb-6">
            <label class="block mb-1 font-semibold">Status</label>
            <select name="status" class="border w-full p-3 rounded focus:ring-2 focus:ring-yellow-500" required>
                <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                <option value="Selesai">Selesai</option>
            </select>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('pic.aduan.index') }}" class="text-yellow-700 hover:underline">
                ← Kembali ke Daftar Aduan
            </a>

            <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded hover:bg-yellow-700 shadow">
                Simpan Tindak Lanjut
            </button>
        </div>
    </form>
</div>
@endsection
