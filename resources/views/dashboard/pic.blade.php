@extends('layout.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Dashboard PIC Unit</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<form method="POST" action="/pic/tindaklanjut/store" class="bg-white p-6 rounded shadow w-full md:w-2/3">
    @csrf

    <div class="mb-4">
        <label class="block mb-1 font-semibold">ID Aduan</label>
        <input type="text" name="id_aduan" class="border w-full p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Catatan Tindak Lanjut</label>
        <textarea name="catatan" rows="4" class="border w-full p-2 rounded" required></textarea>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Status</label>
        <select name="status" class="border w-full p-2 rounded" required>
            <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
            <option value="Selesai">Selesai</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Simpan Tindak Lanjut
    </button>
</form>
@endsection
