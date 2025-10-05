@extends('layout.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">
    Halo, {{ session('data')->nama ?? 'Mahasiswa' }}
</h2>
<p class="mb-6 text-gray-700">Selamat datang di Sistem Pengaduan Mahasiswa (SIPADU).</p>

<div class="flex justify-between mb-4">
    <h3 class="text-xl font-semibold">Daftar Aduan</h3>
    <a href="/mahasiswa/aduan/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Buat Aduan</a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-3">{{ session('success') }}</div>
@endif

<table class="w-full border border-gray-300 bg-white rounded shadow">
    <thead class="bg-blue-700 text-white">
        <tr>
            <th class="p-2">Nomor Tiket</th>
            <th class="p-2">Judul</th>
            <th class="p-2">Kategori</th>
            <th class="p-2">Status</th>
        </tr>
    </thead>
    <tbody>
    @forelse($aduan as $a)
        <tr class="border-b hover:bg-gray-50">
            <td class="p-2">{{ $a->nomor_tiket }}</td>
            <td class="p-2">{{ $a->judul }}</td>
            <td class="p-2">{{ $a->kategori }}</td>
            <td class="p-2">{{ $a->status }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center text-gray-500 p-3">Belum ada aduan.</td>
        </tr>
    @endforelse
</tbody>
</table>
@endsection
