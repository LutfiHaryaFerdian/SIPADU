<!-- Updated with modern styling matching admin layout but with blue theme -->
@extends('layouts.admin')

@section('title', 'SIPADU - Detail Mahasiswa')

@section('content')

<!-- Hero Header -->
<section class="detail-hero position-relative text-white mb-5">
    <div class="hero-overlay"></div>
    <div class="container position-relative py-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-start mb-3">
                    <div class="hero-icon me-3">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-2">{{ $mhs->nama }}</h1>
                        <div class="d-flex align-items-center gap-3 opacity-90">
                            <span><i class="bi bi-card-text me-2"></i>{{ $mhs->npm }}</span>
                            <span>•</span>
                            <span><i class="bi bi-book me-2"></i>{{ $mhs->prodi }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-light btn-lg px-4 shadow">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</section>

<div class="container mb-5">
    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Informasi Pribadi -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-person text-primary me-2"></i>Informasi Pribadi
                    </h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Nama:</strong></p>
                            <p>{{ $mhs->nama }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Email:</strong></p>
                            <p>{{ $mhs->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>NPM:</strong></p>
                            <p class="text-monospace fw-semibold">{{ $mhs->npm }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Program Studi:</strong></p>
                            <p>{{ $mhs->prodi }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>No. HP:</strong></p>
                            <p>{{ $mhs->no_hp ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Alamat:</strong></p>
                            <p>{{ $mhs->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Profile Summary Card -->
            <div class="card border-0 shadow-sm sticky-top mb-4" style="top: 20px;">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="{{ $mhs->foto_profile ?? '/placeholder.svg?height=120&width=120' }}"
                             class="rounded-circle mb-3 border border-primary" 
                             width="120" 
                             height="120"
                             alt="Foto {{ $mhs->nama }}"
                             style="object-fit: cover;">
                        <h5 class="fw-bold mb-1">{{ $mhs->nama }}</h5>
                        <p class="text-muted mb-0">{{ $mhs->email }}</p>
                    </div>

                    <hr>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-card-text"></i>
                        </div>
                        <div class="info-content">
                            <small class="text-muted d-block mb-1">NPM</small>
                            <strong class="text-primary">{{ $mhs->npm }}</strong>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-book"></i>
                        </div>
                        <div class="info-content">
                            <small class="text-muted d-block mb-1">Program Studi</small>
                            <strong>{{ $mhs->prodi }}</strong>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="info-content">
                            <small class="text-muted d-block mb-1">No. HP</small>
                            <strong>{{ $mhs->no_hp ?? 'Tidak tersedia' }}</strong>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="info-content">
                            <small class="text-muted d-block mb-1">Alamat</small>
                            <strong>{{ $mhs->alamat ?? 'Tidak tersedia' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Hero Section */
    /* Blue theme for mahasiswa detail layout */
    .detail-hero {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        position: relative;
        overflow: hidden;
    }

    .detail-hero::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.1);
        z-index: 1;
    }

    .detail-hero .container {
        z-index: 2;
    }

    .hero-icon {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }

    /* Card */
    .card {
        border-radius: 16px;
        overflow: hidden;
    }

    /* Photo Card */
    .photo-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .photo-img {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: cover;
        display: block;
    }

    /* Info Item */
    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 16px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .info-content {
        flex: 1;
    }

    .info-content strong {
        color: #212529;
    }
</style>

@endsection
