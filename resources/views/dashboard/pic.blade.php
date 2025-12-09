@extends('layouts.pic')
@section('title', 'SIPADU - Dashboard PIC Unit')
@section('content')

<!-- PIC CSS -->
    <link rel="stylesheet" href="{{ asset('css/pic.css') }}">
@php
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;
    $id_pic = session('pic')->id;
    
    // Get all unique aduan IDs assigned to this PIC with their latest status
    $aduanWithStatus = DB::table('tindak_lanjut as tl1')
        ->select('tl1.id_aduan', 'tl1.status')
        ->where('tl1.id_pic', $id_pic)
        ->whereRaw('tl1.id = (
            SELECT tl2.id 
            FROM tindak_lanjut tl2 
            WHERE tl2.id_aduan = tl1.id_aduan 
            AND tl2.id_pic = ?
            ORDER BY tl2.created_at DESC 
            LIMIT 1
        )', [$id_pic])
        ->get();
    
    // Calculate statistics
    $totalTugas = $aduanWithStatus->count();
    $aduanProses = $aduanWithStatus->where('status', 'Sedang Dikerjakan')->count();
    $aduanSelesai = $aduanWithStatus->where('status', 'Selesai')->count();
    
    // Get 5 most recent complaints with their latest status
    $aduanTerbaru = DB::table('aduan')
        ->join('tindak_lanjut', 'aduan.id', '=', 'tindak_lanjut.id_aduan')
        ->where('tindak_lanjut.id_pic', $id_pic)
        ->select(
            'aduan.*',
            DB::raw('(
                SELECT status 
                FROM tindak_lanjut 
                WHERE id_aduan = aduan.id 
                AND id_pic = ?
                ORDER BY created_at DESC 
                LIMIT 1
            ) as status_terbaru')
        )
        ->addBinding($id_pic, 'select')
        ->groupBy('aduan.id')
        ->orderBy('aduan.created_at', 'desc')
        ->limit(5)
        ->get();
@endphp

<!-- Hero Section -->
<section class="pic-hero position-relative text-white"
        style="background: url('{{ asset('images/picdb.jpeg') }}') center center / cover no-repeat;">
    <div class="hero-overlay"></div>
    <div class="hero-pattern"></div>
    <div class="container position-relative">
        <div class="row align-items-center min-vh-hero">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1 class="fw-bold mb-3 display-4 hero-title">
                        Selamat datang, PIC Unit! 👋
                    </h1>
                    <p class="mb-4 fs-5 hero-subtitle">
                        Pantau dan kelola <strong>aduan yang ditugaskan ke unit Anda</strong> dengan mudah dan teratur.
                    </p>
                    <div class="hero-actions">
                        <a href="/pic/aduan" class="btn btn-hero btn-hero-primary">
                            <i class="bi bi-briefcase-fill me-2"></i>Kelola Tugas
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
                        <i class="bi bi-briefcase-fill"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Total Tugas</div>
                    <div class="stat-value">{{ $totalTugas }}</div>
                    <div class="stat-trend">
                        <i class="bi bi-graph-up me-1"></i>
                        <span>Semua tugas</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card stat-pending">
                <div class="stat-icon-wrapper">
                    <div class="stat-icon">
                        <i class="bi bi-tools"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Sedang Dikerjakan</div>
                    <div class="stat-value">{{ $aduanProses }}</div>
                    <div class="stat-trend">
                        <i class="bi bi-arrow-repeat me-1"></i>
                        <span>Dalam pengerjaan</span>
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
            <i class="bi bi-clock-history text-warning me-2"></i>
            Aduan yang Sedang Dikerjakan
        </h3>
        <p class="text-muted mb-0">5 aduan yang sedang dikerjakan</p>
    </div>

    @if($aduanTerbaru->isEmpty())
        <div class="empty-state-card">
            <div class="empty-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <h5 class="fw-bold mb-2">Belum Ada Tugas</h5>
            <p class="text-muted mb-4">Belum ada aduan yang ditugaskan ke unit Anda.</p>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Aduan</th>
                                <th>Kategori</th>
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
                                            <i class="bi bi-tag me-1"></i>{{ $a->kategori ?? 'N/A' }}
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $a->kategori ?? 'N/A' }}</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $a->status_terbaru ?? $a->status)) }}">
                                        @php
                                            $displayStatus = $a->status_terbaru ?? $a->status;
                                        @endphp
                                        @if($displayStatus == 'Menunggu')
                                            <i class="bi bi-clock-history me-1"></i>
                                        @elseif($displayStatus == 'Sedang Dikerjakan')
                                            <i class="bi bi-gear-fill me-1"></i>
                                        @elseif($displayStatus == 'Selesai')
                                            <i class="bi bi-check-circle-fill me-1"></i>
                                        @elseif($displayStatus == 'Ditolak')
                                            <i class="bi bi-x-circle-fill me-1"></i>
                                        @endif
                                        {{ $displayStatus }}
                                    </span>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <div class="fw-semibold">{{ Carbon::parse($a->created_at)->format('d M Y') }}</div>
                                        <small class="text-muted">{{ Carbon::parse($a->created_at)->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pic.tindaklanjut.view', $a->id) }}" 
                                       class="btn btn-sm btn-warning text-dark"
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
                    <a href="/pic/aduan" class="btn btn-outline-warning text-warning">
                        <i class="bi bi-arrow-right-circle me-2"></i>Lihat Semua Tugas
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@endsection