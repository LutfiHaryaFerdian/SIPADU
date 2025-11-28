@extends('layouts.mahasiswa')

@section('title', 'SIPADU - Dashboard Mahasiswa')

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

<!-- 🔹 Hero Section -->
<section class="hero-section position-relative text-white">
    <div class="hero-overlay"></div>

    <div class="container position-relative">
        <div class="row align-items-center justify-content-center min-vh-50">
            <div class="col-lg-7 text-start">
                <h1 class="fw-bold mb-3 display-5">
                    Halo, {{ session('mahasiswa')->nama }}! 👋
                </h1>
                <p class="mb-4 fs-5">
                    Selamat datang di <strong>SIPADU Universitas Lampung</strong>.<br>
                    Laporkan, pantau, dan tindak lanjuti aduan Anda dengan mudah.
                </p>
                <a href="/mahasiswa/aduan/create" class="btn btn-primary me-2">
                    <i class="bi bi-plus-circle me-1"></i> Buat Aduan Baru
                </a>
                <a href="/mahasiswa/aduan" class="btn btn-outline-light me-2">
                    <i class="bi bi-journal-text me-1"></i> Aduan Saya
                </a>
                <a href="/mahasiswa/aduan-publik" class="btn btn-outline-light">
                    <i class="bi bi-globe2 me-2"></i> Aduan Publik
                </a>
            </div>
        </div>
    </div>
</section>


<!-- 🔹 Statistik Ringkas -->
<div class="container my-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center border-0 shadow-sm h-100 role-card bg-primary text-white">
                <div class="card-body p-4">
                    <i class="bi bi-envelope-paper display-5 mb-2"></i>
                    <h5 class="fw-semibold mb-1">Total Aduan</h5>
                    <p class="fs-3 fw-bold mb-0">{{ DB::table('aduan')->where('id_mahasiswa', session('mahasiswa')->id)->count() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center border-0 shadow-sm h-100 role-card bg-warning text-white">
                <div class="card-body p-4">
                    <i class="bi bi-hourglass-split display-5 mb-2"></i>
                    <h5 class="fw-semibold mb-1">Sedang Diproses</h5>
                    <p class="fs-3 fw-bold mb-0">{{ DB::table('aduan')->where('id_mahasiswa', session('mahasiswa')->id)->where('status', 'Diproses')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center border-0 shadow-sm h-100 role-card bg-success text-white">
                <div class="card-body p-4">
                    <i class="bi bi-check-circle display-5 mb-2"></i>
                    <h5 class="fw-semibold mb-1">Selesai</h5>
                    <p class="fs-3 fw-bold mb-0">{{ DB::table('aduan')->where('id_mahasiswa', session('mahasiswa')->id)->where('status', 'Selesai')->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 🔹 Aduan Terbaru -->
<div class="container mb-5">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-success text-white fw-semibold">
            <i class="bi bi-clock-history me-2"></i> Aduan Terbaru Anda
        </div>
        <div class="card-body p-0">
            @if($aduanTerbaru->isEmpty())
                <p class="p-4 text-center text-muted fst-italic">Belum ada aduan yang dikirim.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped align-middle mb-0">
                        <thead class="table-success">
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th class="text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aduanTerbaru as $a)
                                <tr>
                                    <td>
                                        {{ $a->judul }}
                                    </td>
                                    <td>{{ $a->kategori }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($a->status == 'Diproses') bg-warning text-dark
                                            @elseif($a->status == 'Selesai') bg-success
                                            @elseif($a->status == 'Ditolak') bg-danger text-white
                                            @else bg-secondary @endif">
                                            {{ $a->status }}
                                        </span>
                                    </td>
                                    <td>{{ Carbon::parse($a->created_at)->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('aduan.publik.detail', $a->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye me-1"></i> Lihat Detail
                                        </a>
                                    </td>
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
    .hero-section {
    background: url('https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=1500&q=80') center center / cover no-repeat;
    min-height: 420px;
    display: flex;
    align-items: center;
    position: relative;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        rgba(0,0,0,0.6),
        rgba(0,0,0,0.6)
    );
    z-index: 1;
}

.hero-section .container {
    z-index: 2;
}

.min-vh-50 {
    min-height: 420px;
}
.role-card {
    transition: all 0.3s ease;
}
.role-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
}
</style>
@endsection
