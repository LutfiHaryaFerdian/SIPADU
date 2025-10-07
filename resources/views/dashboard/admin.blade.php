@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
@php
    use Illuminate\Support\Facades\DB;
    $totalAduan = DB::table('aduan')->count();
    $aduanProses = DB::table('aduan')->where('status', 'Diproses')->count();
    $aduanSelesai = DB::table('aduan')->where('status', 'Selesai')->count();
@endphp

<h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Admin</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-blue-600 text-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold">Total Aduan</h3>
        <p class="text-3xl font-bold mt-2">{{ $totalAduan }}</p>
    </div>
    <div class="bg-yellow-500 text-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold">Sedang Diproses</h3>
        <p class="text-3xl font-bold mt-2">{{ $aduanProses }}</p>
    </div>
    <div class="bg-green-600 text-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold">Selesai</h3>
        <p class="text-3xl font-bold mt-2">{{ $aduanSelesai }}</p>
    </div>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <h3 class="text-lg font-bold mb-4 border-b pb-2">Aduan Terbaru</h3>

    @php
        $aduanTerbaru = DB::table('aduan')
            ->join('mahasiswa', 'aduan.id_mahasiswa', '=', 'mahasiswa.id')
            ->select('aduan.*', 'mahasiswa.nama as nama_mhs')
            ->orderBy('aduan.created_at', 'desc')
            ->limit(5)
            ->get();
    @endphp

    @if($aduanTerbaru->isEmpty())
        <p class="text-gray-500 italic">Belum ada aduan terbaru.</p>
    @else
        <table class="min-w-full text-sm border border-gray-300">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="border p-3 text-left">Judul</th>
                    <th class="border p-3 text-left">Mahasiswa</th>
                    <th class="border p-3 text-left">Status</th>
                    <th class="border p-3 text-left">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aduanTerbaru as $a)
                <tr class="hover:bg-gray-50">
                    <td class="border p-3">{{ $a->judul }}</td>
                    <td class="border p-3">{{ $a->nama_mhs }}</td>
                    <td class="border p-3">
                        <span class="px-2 py-1 rounded text-white 
                            @if($a->status == 'Menunggu') bg-gray-500
                            @elseif($a->status == 'Diproses') bg-yellow-500
                            @else bg-green-600 @endif">
                            {{ $a->status }}
                        </span>
                    </td>
                    <td class="border p-3">{{ \Carbon\Carbon::parse($a->created_at)->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
