@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa')

@section('content')
@php
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;

    $aduanTerbaru = DB::table('aduan')
        ->where('id_mahasiswa', session('mahasiswa')->id)
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
@endphp

<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang, {{ session('mahasiswa')->nama }}</h1>
    <p class="text-gray-600">Gunakan menu di sebelah kiri untuk membuat atau melihat status aduan Anda.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <a href="/mahasiswa/aduan/create" class="bg-blue-600 text-white p-6 rounded-xl shadow hover:bg-blue-700 transition transform hover:-translate-y-1">
        <h3 class="text-xl font-semibold mb-2">+ Buat Aduan Baru</h3>
        <p class="text-sm text-blue-100">Laporkan permasalahan Anda dengan cepat dan mudah.</p>
    </a>

    <a href="/mahasiswa/aduan" class="bg-gray-700 text-white p-6 rounded-xl shadow hover:bg-gray-800 transition transform hover:-translate-y-1">
        <h3 class="text-xl font-semibold mb-2">📋 Lihat Semua Aduan</h3>
        <p class="text-sm text-gray-200">Pantau status dan tindak lanjut aduan Anda.</p>
    </a>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <h3 class="text-lg font-bold mb-4 border-b pb-2">Aduan Terbaru</h3>

    @if($aduanTerbaru->isEmpty())
        <p class="text-gray-500 italic">Belum ada aduan yang dikirim.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border border-gray-300">
                <thead class="bg-green-100">
                    <tr>
                        <th class="border p-3 text-left">Judul</th>
                        <th class="border p-3 text-left">Kategori</th>
                        <th class="border p-3 text-left">Status</th>
                        <th class="border p-3 text-left">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aduanTerbaru as $a)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border p-3">{{ $a->judul }}</td>
                            <td class="border p-3">{{ $a->kategori }}</td>
                            <td class="border p-3">
                                <span class="px-2 py-1 rounded text-white 
                                    @if($a->status == 'Diproses') bg-yellow-500 
                                    @elseif($a->status == 'Selesai') bg-green-600 
                                    @else bg-gray-500 @endif">
                                    {{ $a->status }}
                                </span>
                            </td>
                            <td class="border p-3">{{ Carbon::parse($a->created_at)->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
