@extends('layouts.admin')

@section('title', 'Manajemen Aduan')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-gray-800">Daftar Aduan Mahasiswa</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

@if($aduan->isEmpty())
    <p class="text-gray-500 italic">Belum ada aduan mahasiswa.</p>
@else
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm border-collapse">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="p-3 border text-left">Judul</th>
                    <th class="p-3 border text-left">Mahasiswa</th>
                    <th class="p-3 border text-left">Kategori</th>
                    <th class="p-3 border text-left">Status</th>
                    <th class="p-3 border text-left">Nomor Tiket</th>
                    <th class="p-3 border text-center w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aduan as $a)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $a->judul }}</td>
                        <td class="p-3">
                            {{ $a->nama_mahasiswa }}<br>
                            <span class="text-xs text-gray-500">({{ $a->npm }})</span>
                        </td>
                        <td class="p-3">{{ $a->kategori }}</td>
                        <td class="p-3">
                            @if($a->status === 'Menunggu')
                                <span class="text-yellow-600 font-semibold">Menunggu</span>
                            @elseif($a->status === 'Diproses')
                                <span class="text-blue-600 font-semibold">Diproses</span>
                            @else
                                <span class="text-green-600 font-semibold">Selesai</span>
                            @endif
                        </td>
                        <td class="p-3 font-mono">{{ $a->nomor_tiket }}</td>
                        <td class="p-3 text-center">
                            @if($a->status === 'Menunggu')
                                <form action="{{ route('admin.aduan.assign', $a->id) }}" method="POST" class="mb-2">
                                    @csrf
                                    <select name="id_pic" class="border rounded p-1 w-full mb-1" required>
                                        <option value="">Pilih PIC</option>
                                        @foreach($picUnits as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_unit }} - {{ $p->nama_pic }}</option>
                                        @endforeach
                                    </select>
                                    <textarea name="catatan" placeholder="Catatan (opsional)" class="border rounded p-1 w-full text-sm mb-1"></textarea>
                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 w-full">
                                        Tugaskan ke PIC
                                    </button>
                                </form>
                            @elseif($a->status === 'Diproses')
                                <form action="{{ route('admin.aduan.done', $a->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 w-full">
                                        Tandai Selesai
                                    </button>
                                </form>
                            @else
                                <span class="text-green-600 font-semibold">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
