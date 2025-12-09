@extends('layouts.mahasiswa')
@section('title', 'SIPADU - Dashboard Mahasiswa')
@section('content')
<!-- Mahasiswa CSS -->
    <link rel="stylesheet" href="{{ asset('css/mahasiswa.css') }}">
@php
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;
    $aduanTerbaru = DB::table('aduan')
        ->where('id_mahasiswa', session('mahasiswa')->id)
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
    
    $totalAduan = DB::table('aduan')->where('id_mahasiswa', session('mahasiswa')->id)->count();
    $aduanMenunggu = DB::table('aduan')->where('id_mahasiswa', session('mahasiswa')->id)->where('status', 'Menunggu')->count();
    $aduanDiproses = DB::table('aduan')->where('id_mahasiswa', session('mahasiswa')->id)->where('status', 'Diproses')->count();
    $aduanSelesai = DB::table('aduan')->where('id_mahasiswa', session('mahasiswa')->id)->where('status', 'Selesai')->count();
@endphp

<!-- Hero Section -->
<section class="dashboard-hero position-relative text-white"
        style="background: url('{{ asset('images/mahasiswadb.jpeg') }}') center center / cover no-repeat;">
    <div class="hero-overlay"></div>
    <div class="hero-pattern"></div>
    <div class="container position-relative">
        <div class="row align-items-center min-vh-hero">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1 class="fw-bold mb-3 display-4 hero-title">
                        Halo, {{ session('mahasiswa')->nama }}! 👋
                    </h1>
                    <p class="mb-4 fs-5 hero-subtitle">
                        Selamat datang di <strong>SIPADU Universitas Lampung</strong>.<br>
                        Laporkan, pantau, dan tindak lanjuti aduan Anda dengan mudah.
                    </p>
                    <div class="hero-actions">
                        <a href="/mahasiswa/aduan/create" class="btn btn-hero btn-hero-primary">
                            <i class="bi bi-plus-circle me-2"></i>Buat Aduan Baru
                        </a>
                        <a href="/mahasiswa/aduan" class="btn btn-hero btn-hero-outline">
                            <i class="bi bi-journal-text me-2"></i>Aduan Saya
                        </a>
                        <a href="/mahasiswa/aduan-publik" class="btn btn-hero btn-hero-outline">
                            <i class="bi bi-globe2 me-2"></i>Aduan Publik
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                
            </div>
        </div>
    </div>
</section>

<!-- Statistics Cards -->
<div class="container stats-container">
    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="stat-card stat-total">
                <div class="stat-icon-wrapper">
                    <div class="stat-icon">
                        <i class="bi bi-inbox-fill"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Total Aduan</div>
                    <div class="stat-value">{{ $totalAduan }}</div>
                    <div class="stat-trend">
                        <i class="bi bi-graph-up me-1"></i>
                        <span>Semua aduan Anda</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card stat-pending">
                <div class="stat-icon-wrapper">
                    <div class="stat-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Menunggu</div>
                    <div class="stat-value">{{ $aduanMenunggu }}</div>
                    <div class="stat-trend">
                        <i class="bi bi-hourglass-split me-1"></i>
                        <span>Belum divalidasi</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card stat-process">
                <div class="stat-icon-wrapper">
                    <div class="stat-icon">
                        <i class="bi bi-gear-fill"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Diproses</div>
                    <div class="stat-value">{{ $aduanDiproses }}</div>
                    <div class="stat-trend">
                        <i class="bi bi-arrow-repeat me-1"></i>
                        <span>Sedang ditangani</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card stat-done">
                <div class="stat-icon-wrapper">
                    <div class="stat-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Selesai</div>
                    <div class="stat-value">{{ $aduanSelesai }}</div>
                    <div class="stat-trend">
                        <i class="bi bi-check-all me-1"></i>
                        <span>Telah terselesaikan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Complaints -->
<div class="container mb-5">
    <div class="section-header mb-4">
        <h3 class="fw-bold mb-1">
            <i class="bi bi-clock-history text-primary me-2"></i>
            Aduan Terbaru Anda
        </h3>
        <p class="text-muted mb-0">5 aduan terakhir yang Anda laporkan</p>
    </div>

    @if($aduanTerbaru->isEmpty())
        <div class="empty-state-card">
            <div class="empty-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <h5 class="fw-bold mb-2">Belum Ada Aduan</h5>
            <p class="text-muted mb-4">Anda belum pernah membuat aduan. Mulai sampaikan keluhan Anda sekarang!</p>
            <a href="/mahasiswa/aduan/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Buat Aduan Pertama
            </a>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Aduan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aduanTerbaru as $a)
                            <tr>
                                <td class="ps-4">
                                    <div class="aduan-info">
                                        <h6 class="mb-1 fw-bold text-dark">{{ $a->judul }}</h6>
                                        <div class="text-muted small">
                                            <i class="bi bi-tag me-1"></i>{{ $a->kategori }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ strtolower($a->status) }}">
                                        @if($a->status == 'Menunggu')
                                            <i class="bi bi-clock-history me-1"></i>
                                        @elseif($a->status == 'Diproses')
                                            <i class="bi bi-gear-fill me-1"></i>
                                        @elseif($a->status == 'Selesai')
                                            <i class="bi bi-check-circle-fill me-1"></i>
                                        @elseif($a->status == 'Ditolak')
                                            <i class="bi bi-x-circle-fill me-1"></i>
                                        @endif
                                        {{ $a->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <div class="fw-semibold">{{ Carbon::parse($a->created_at)->format('d M Y') }}</div>
                                        <small class="text-muted">{{ Carbon::parse($a->created_at)->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('aduan.publik.detail', $a->id) }}" 
                                       class="btn btn-sm btn-primary"
                                       data-bs-toggle="tooltip"
                                       title="Lihat Detail">
                                        <i class="bi bi-eye me-1"></i>Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 p-3">
                <div class="text-center">
                    <a href="/mahasiswa/aduan" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-right-circle me-2"></i>Lihat Semua Aduan
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@endsection