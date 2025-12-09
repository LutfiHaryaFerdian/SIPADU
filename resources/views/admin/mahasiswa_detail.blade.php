<!-- Updated with modern styling matching admin layout but with blue theme -->
@extends('layouts.admin')

@section('title', 'SIPADU - Detail Mahasiswa')

@section('content')

<!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

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



@endsection
