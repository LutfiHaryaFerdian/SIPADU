@extends('layouts.pic')
@section('title', 'SIPADU - Dashboard PIC Unit')
@section('content')
@php
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;
    $id_pic = session('pic')->id;
    $totalTugas = DB::table('tindak_lanjut')->where('id_pic', $id_pic)->distinct('id_aduan')->count('id_aduan');
    $aduanProses = DB::table('tindak_lanjut')
        ->where('id_pic', $id_pic)
        ->where('status', 'Sedang Dikerjakan')
        ->distinct('id_aduan')
        ->count('id_aduan');
    $aduanSelesai = DB::table('tindak_lanjut')
        ->where('id_pic', $id_pic)
        ->where('status', 'Selesai')
        ->distinct('id_aduan')
        ->count('id_aduan');
    $aduanTerbaru = DB::table('aduan')
        ->join('tindak_lanjut', 'aduan.id', '=', 'tindak_lanjut.id_aduan')
        ->where('tindak_lanjut.id_pic', $id_pic)
        ->select('aduan.*')
        ->orderBy('aduan.created_at', 'desc')
        ->limit(5)
        ->get();
@endphp

<!-- Hero Section -->
<section class="pic-hero position-relative text-white">
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
                        <a href="/pic/laporan" class="btn btn-hero btn-hero-outline">
                            <i class="bi bi-file-earmark-text me-2"></i>Laporan
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                <div class="hero-illustration">
                    <div class="illustration-circle circle-1"></div>
                    <div class="illustration-circle circle-2"></div>
                    <div class="illustration-circle circle-3"></div>
                </div>
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
            Aduan Terbaru yang Ditugaskan
        </h3>
        <p class="text-muted mb-0">5 aduan terbaru yang ditugaskan ke unit Anda</p>
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
                            @php
                                $tindakLanjutTerbaru = DB::table('tindak_lanjut')
                                    ->where('id_aduan', $a->id)
                                    ->where('id_pic', $id_pic)
                                    ->orderBy('created_at', 'desc')
                                    ->first();
                                $statusDisplay = $a->status;
                                if ($tindakLanjutTerbaru) {
                                    $statusDisplay = $tindakLanjutTerbaru->status;
                                }
                            @endphp
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
                                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $statusDisplay)) }}">
                                        @if($statusDisplay == 'Menunggu')
                                            <i class="bi bi-clock-history me-1"></i>
                                        @elseif($statusDisplay == 'Sedang Dikerjakan')
                                            <i class="bi bi-gear-fill me-1"></i>
                                        @elseif($statusDisplay == 'Selesai')
                                            <i class="bi bi-check-circle-fill me-1"></i>
                                        @elseif($statusDisplay == 'Ditolak')
                                            <i class="bi bi-x-circle-fill me-1"></i>
                                        @endif
                                        {{ $statusDisplay }}
                                    </span>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <div class="fw-semibold">{{ Carbon::parse($a->created_at)->format('d M Y') }}</div>
                                        <small class="text-muted">{{ Carbon::parse($a->created_at)->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="/pic/aduan/{{ $a->id }}" 
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

<!-- Updated styling with modern design inspired by mahasiswa dashboard, with yellow/amber color scheme -->
<style>
    .pic-hero {
        background: url('{{ asset("images/picdb.jpeg") }}') center center / cover no-repeat;
        position: relative;
        overflow: hidden;
        width: 100vw;
        margin-left: calc(-50vw + 50%);
        margin-top: -56px;
        padding: 0;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.15);
        z-index: 1;
    }

    .hero-pattern {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(255,255,255,0.1) 0%, transparent 50%);
        z-index: 1;
    }

    .pic-hero .container {
        z-index: 2;
        padding-top: 80px;
        padding-bottom: 60px;
    }

    .min-vh-hero {
        min-height: 480px;
        display: flex;
        align-items: center;
    }

    .hero-title {
        font-size: 3rem;
        line-height: 1.2;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .hero-subtitle {
        opacity: 0.95;
        line-height: 1.8;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 32px;
    }

    .btn-hero {
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .btn-hero-primary {
        background: white;
        color: #ca8a04;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .btn-hero-primary:hover {
        background: #f8f9fa;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    .btn-hero-outline {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .btn-hero-outline:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-3px);
        color: white;
    }

    /* Hero Illustration */
    .hero-illustration {
        position: relative;
        height: 300px;
    }

    .illustration-circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .circle-1 {
        width: 200px;
        height: 200px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        animation: float 6s ease-in-out infinite;
    }

    .circle-2 {
        width: 150px;
        height: 150px;
        top: 20%;
        left: 20%;
        animation: float 8s ease-in-out infinite;
    }

    .circle-3 {
        width: 100px;
        height: 100px;
        bottom: 20%;
        right: 20%;
        animation: float 7s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    /* Statistics Cards */
    .stats-container {
        margin-top: -60px;
        margin-bottom: 60px;
        position: relative;
        z-index: 10;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #ca8a04 0%, #a16207 100%);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .stat-icon-wrapper {
        margin-bottom: 20px;
    }

    .stat-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: white;
        margin-bottom: 16px;
    }

    .stat-total .stat-icon {
        background: linear-gradient(135deg, #ca8a04 0%, #a16207 100%);
    }

    .stat-pending .stat-icon {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .stat-done .stat-icon {
        background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 600;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #212529;
        line-height: 1;
        margin-bottom: 12px;
    }

    .stat-trend {
        font-size: 0.85rem;
        color: #6c757d;
        display: flex;
        align-items: center;
    }

    /* Section Header */
    .section-header {
        padding: 0 4px;
    }

    .section-header h3 {
        font-size: 1.75rem;
    }

    /* Empty State */
    .empty-state-card {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .empty-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, #ca8a04 0%, #a16207 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        color: white;
    }

    /* Card */
    .card {
        border-radius: 20px;
        overflow: hidden;
    }

    /* Table */
    thead {
        background: linear-gradient(135deg, #ca8a04 0%, #a16207 100%);
        color: white;
    }

    thead th {
        border: none;
        padding: 18px 16px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    tbody td {
        padding: 20px 16px;
        border-bottom: 1px solid #f1f3f5;
    }

    tbody tr {
        transition: all 0.3s ease;
    }

    tbody tr:hover {
        background: #f8f9fa;
        transform: scale(1.01);
    }

    /* Aduan Info */
    .aduan-info h6 {
        font-size: 1rem;
        color: #212529;
    }

    /* Date Info */
    .date-info {
        line-height: 1.4;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #e9ecef;
        color: #495057;
    }

    .status-sedang-dikerjakan {
        background: #fef3c7;
        color: #92400e;
    }

    .status-selesai {
        background: #dcfce7;
        color: #166534;
    }

    .status-ditolak {
        background: #fee2e2;
        color: #991b1b;
    }

    /* Buttons */
    .btn {
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .btn-warning {
        background: #ca8a04;
        border: none;
    }

    .btn-warning:hover {
        box-shadow: 0 6px 20px rgba(202, 138, 4, 0.4);
        background: #a16207;
    }

    .btn-outline-warning {
        border: 2px solid #ca8a04;
    }

    .btn-outline-warning:hover {
        background: #ca8a04;
        border-color: #ca8a04;
        color: white !important;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .stats-container {
            margin-top: 40px;
        }

        .stat-card {
            margin-bottom: 16px;
        }
    }

    @media (max-width: 768px) {
        .pic-hero .container {
            padding-top: 60px;
            padding-bottom: 40px;
        }

        .hero-title {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .btn-hero {
            padding: 12px 20px;
            font-size: 0.9rem;
            width: 100%;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            font-size: 1.5rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .section-header h3 {
            font-size: 1.5rem;
        }

        thead th {
            font-size: 0.75rem;
            padding: 12px 8px;
        }

        tbody td {
            padding: 12px 8px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@endsection
