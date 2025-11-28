@extends('layouts.pic')
@section('title', 'SIPADU - Dashboard PIC Unit')
@section('content')

<!-- HERO SECTION -->
<!-- Updated hero section with consistent styling and local image -->
<section class="hero-pic position-relative text-white">
    <div class="hero-overlay"></div>
    <div class="container position-relative">
        <div class="row align-items-center justify-content-center min-vh-50">
            <div class="col-lg-7 text-start">
                <h1 class="fw-bold mb-3 display-5">
                    Selamat datang, PIC Unit! 👋
                </h1>
                <p class="mb-4 fs-5">
                    Pantau dan kelola <strong>aduan yang ditugaskan ke unit Anda</strong> dengan mudah dan teratur.
                </p>
            </div>
        </div>
    </div>
</section>

<div class="container my-5">
    <!-- Statistik -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card text-dark bg-warning bg-opacity-75 shadow border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-briefcase-fill display-5 text-dark me-3"></i>
                    <div>
                        <h6 class="fw-semibold mb-0">Total Tugas</h6>
                        <h3 class="fw-bold mb-0">{{ $totalTugas }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-dark bg-light shadow border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-tools display-5 text-warning me-3"></i>
                    <div>
                        <h6 class="fw-semibold mb-0">Sedang Dikerjakan</h6>
                        <h3 class="fw-bold mb-0">{{ $aduanProses }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success shadow border-0 h-100">
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
    <div class="card shadow border-0">
        <div class="card-header bg-warning text-dark fw-semibold">
            <i class="bi bi-list-check me-2"></i>Aduan Terbaru yang Ditugaskan
        </div>
        <div class="card-body p-0">
            @php
                use Illuminate\Support\Facades\DB;
                $id_pic = session('pic')->id;
            @endphp
            @if($aduanTerbaru->isEmpty())
                <div class="p-4 text-center text-muted">
                    <i class="bi bi-info-circle me-2"></i>Belum ada aduan yang ditugaskan.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-warning">
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggal</th>
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
                                <td>{{ $a->judul }}</td>
                                <td>{{ $a->kategori }}</td>
                                <td>
                                    @if($statusDisplay == 'Menunggu')
                                        <span class="badge bg-secondary"><i class="bi bi-hourglass me-1"></i>Menunggu</span>
                                    @elseif($statusDisplay == 'Diproses' || $statusDisplay == 'Sedang Dikerjakan')
                                        <span class="badge bg-warning text-dark"><i class="bi bi-gear-fill me-1"></i>Sedang Dikerjakan</span>
                                    @elseif($statusDisplay == 'Ditolak')
                                        <span class="badge bg-danger text-white"><i class="bi bi-x-circle-fill me-1"></i>Ditolak</span>
                                    @else
                                        <span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i>Selesai</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($a->created_at)->format('d M Y') }}</td>
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
    /* .hero-pic {
        <!-- Changed to local image file and standardized styling with other dashboards -->
        background: url({{ asset("images/mahasiswadb.jpeg") }}) center center / cover no-repeat;

        min-height: 420px;
        display: flex;
        align-items: center;
        position: relative;
        width: 100vw;
        margin-left: calc(-50vw + 50%);
        margin-top: -56px;
        margin-bottom: 0;
    } */
        .hero-pic {
        background: url({{ asset("images/picdb.jpeg") }}) center center / cover no-repeat;
        min-height: 420px;
                display: flex;
                align-items: center;
                position: relative;
                width: 100vw;
                margin-left: calc(-50vw + 50%);
                margin-top: -56px;
                margin-bottom: 0;
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

    .hero-pic .container {
        z-index: 2;
    }

    .min-vh-50 {
        min-height: 420px;
    }

    .card:hover {
        transform: translateY(-4px);
        transition: 0.3s ease;
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
    }

    .table-warning th {
        background-color: #ffe082 !important;
    }
</style>
@endsection
