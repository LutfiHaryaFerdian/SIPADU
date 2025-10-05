@extends('layout.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Dashboard Admin</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<table class="w-full border border-gray-300 bg-white rounded shadow">
    <thead class="bg-blue-700 text-white">
        <tr>
            <th class="p-2">Nomor Tiket</th>
            <th class="p-2">Judul</th>
            <th class="p-2">Status</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($aduan as $a)
        <tr class="border-b hover:bg-gray-50">
            <td class="p-2">{{ $a->nomor_tiket }}</td>
            <td class="p-2">{{ $a->judul }}</td>
            <td class="p-2">{{ $a->status }}</td>
            <td class="p-2">
                <form method="POST" action="/admin/aduan/{{ $a->id }}/verifikasi">
                    @csrf
                    <button class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700">Verifikasi</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
