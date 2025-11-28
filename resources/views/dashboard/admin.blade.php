@extends('layouts.admin')

@section('title', 'SIPADU - Dashboard Admin')

@section('content')
@php
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;

    $totalAduan = DB::table('aduan')->count();
    $aduanProses = DB::table('aduan')->where('status', 'Diproses')->count();
    $aduanSelesai = DB::table('aduan')->where('status', 'Selesai')->count();

    $aduanTerbaru = DB::table('aduan')
        ->join('mahasiswa', 'aduan.id_mahasiswa', '=', 'mahasiswa.id')
        ->select('aduan.*', 'mahasiswa.nama as nama_mhs')
        ->orderBy('aduan.created_at', 'desc')
        ->limit(5)
        ->get();
@endphp

<div class="container my-5">
    <!-- Header -->
    <div class="text-center mb-5">
        <img src="https://cdn-icons-png.flaticon.com/512/4228/4228757.png" alt="Admin Dashboard" 
             class="img-fluid mb-3" style="max-height: 120px;">
        <h2 class="fw-bold text-danger">
            <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
        </h2>
        <p class="text-muted">Kelola dan pantau seluruh aduan mahasiswa secara efisien.</p>
    </div>

    <!-- Statistik -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card text-white bg-danger shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-list-check display-5 me-3"></i>
                    <div>
                        <h6 class="fw-semibold mb-0">Total Aduan</h6>
                        <h3 class="fw-bold mb-0">{{ $totalAduan }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-dark bg-warning shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-hourglass-split display-5 me-3"></i>
                    <div>
                        <h6 class="fw-semibold mb-0">Sedang Diproses</h6>
                        <h3 class="fw-bold mb-0">{{ $aduanProses }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-check-circle-fill display-5 me-3"></i>
                    <div>
                        <h6 class="fw-semibold mb-0">Selesai</h6>
                        <h3 class="fw-bold mb-0">{{ $aduanSelesai }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aduan Terbaru -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-danger text-white fw-semibold">
            <i class="bi bi-clock-history me-2"></i> Aduan Terbaru
        </div>
        <div class="card-body p-0">
            @if($aduanTerbaru->isEmpty())
                <p class="p-4 text-center text-muted fst-italic">Belum ada aduan terbaru.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-danger">
                            <tr>
                                <th>Judul</th>
                                <th>Mahasiswa</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aduanTerbaru as $a)
                                <tr>
                                    <td>
                                        {{ $a->judul }}
                                    </td>
                                    <td>{{ $a->nama_mhs }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($a->status == 'Menunggu') bg-secondary
                                            @elseif($a->status == 'Diproses') bg-warning text-dark
                                            @elseif($a->status == 'Selesai') bg-success
                                            @elseif($a->status == 'Ditolak') bg-danger text-white
                                            @endif">
                                            {{ $a->status }}
                                        </span>
                                    </td>
                                    <td>{{ Carbon::parse($a->created_at)->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.card:hover {
    transform: translateY(-4px);
    transition: all 0.3s ease-in-out;
    box-shadow: 0 6px 18px rgba(220, 53, 69, 0.2);
}
</style>
@endsection
