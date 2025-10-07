@extends('layout.base')

@section('title', 'Daftar Aduan Saya')

@section('content')
    <a href="{{ route('aduan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700">
        + Tambah Aduan
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    @if($aduan->isEmpty())
        <p class="text-gray-500">Belum ada aduan.</p>
    @else
        <table class="w-full border text-sm">
            <thead class="bg-blue-100">
                <tr>
                    <th class="p-2 border">Judul</th>
                    <th class="p-2 border">Kategori</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Nomor Tiket</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aduan as $a)
                    <tr class="border-t">
                        <td class="p-2 border">{{ $a->judul }}</td>
                        <td class="p-2 border">{{ $a->kategori }}</td>
                        <td class="p-2 border">{{ $a->status }}</td>
                        <td class="p-2 border">{{ $a->nomor_tiket }}</td>
                        <td class="p-2 border">
                            <form action="{{ route('aduan.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Hapus aduan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
