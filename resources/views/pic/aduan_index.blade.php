@extends('layouts.pic')

@section('title', 'Aduan Ditugaskan')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-gray-800">Aduan yang Ditugaskan Kepada Anda</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if($aduan->isEmpty())
    <p class="text-gray-500 italic">Belum ada aduan yang ditugaskan.</p>
@else
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm border-collapse">
            <thead class="bg-yellow-100 text-yellow-800">
                <tr>
                    <th class="p-3 border text-left">Judul</th>
                    <th class="p-3 border text-left">Mahasiswa</th>
                    <th class="p-3 border text-left">Kategori</th>
                    <th class="p-3 border text-left">Status</th>
                    <th class="p-3 border text-left">Catatan Admin</th>
                    <th class="p-3 border text-center w-32">Aksi</th>
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
                        <td class="p-3">{{ $a->catatan_admin ?? '-' }}</td>
                        <td class="p-3 text-center">
                            <a href="{{ route('pic.tindaklanjut.form', $a->id) }}"
                               class="bg-yellow-600 text-white px-3 py-1 rounded text-sm hover:bg-yellow-700">
                                Tindak Lanjut
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
