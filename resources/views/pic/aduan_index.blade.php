@extends('layouts.pic')

@section('title', 'SIPADU - Aduan Ditugaskan')

@section('content')

<!-- PIC CSS -->
    <link rel="stylesheet" href="{{ asset('css/pic.css') }}">

<!-- Hero Header -->
<section class="aduan-list-hero position-relative text-dark mb-5">
    <div class="hero-overlay"></div>
    <div class="container position-relative py-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-3">
                    <div class="hero-icon me-3">
                        <i class="bi bi-list-task"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-1">Aduan Ditugaskan Kepada Anda</h1>
                        <p class="mb-0 opacity-90">Kelola dan tangani aduan mahasiswa yang telah ditugaskan ke unit Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid py-4">

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card stat-total">
                <div class="stat-icon">
                    <i class="bi bi-inbox-fill"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $aduan->count() }}</div>
                    <div class="stat-label">Total Aduan</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card stat-pending">
                <div class="stat-icon">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $aduan->where('status_terbaru', 'Menunggu')->count() }}</div>
                    <div class="stat-label">Menunggu</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card stat-process">
                <div class="stat-icon">
                    <i class="bi bi-gear-fill"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $aduan->where('status_terbaru', 'Sedang Dikerjakan')->count() }}</div>
                    <div class="stat-label">Dikerjakan</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card stat-done">
                <div class="stat-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $aduan->where('status_terbaru', 'Selesai')->count() }}</div>
                    <div class="stat-label">Selesai</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center mb-4">
            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
            <div>
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center mb-4">
            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
            <div>
                <strong>Gagal!</strong> {{ session('error') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Table Content -->
    @if($aduan->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <h5 class="text-secondary fw-semibold">Belum Ada Aduan</h5>
            <p class="text-muted">Tidak ada aduan yang ditugaskan untuk ditampilkan.</p>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="aduanTable">
                        <thead>
                            <tr>
                                <th class="ps-4">Aduan</th>
                                <th>Mahasiswa</th>
                                <th>Status</th>
                                <th>Foto</th>
                                <th>Catatan Admin</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aduan as $a)
                                <tr class="aduan-row">
                                    
                                    <!-- Aduan Info -->
                                    <td class="ps-4">
                                        <div class="aduan-info">
                                            <h6 class="mb-1 fw-bold text-dark">{{ $a->judul }}</h6>
                                            <div class="d-flex align-items-center gap-2 text-muted small">
                                                <span>
                                                    <i class="bi bi-tag me-1"></i>{{ $a->kategori }}
                                                </span>
                                                <span>•</span>
                                                <span>
                                                    <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($a->created_at)->format('d M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Mahasiswa Info -->
                                    <td>
                                        <div>
                                            <strong class="text-dark">{{ $a->nama_mahasiswa }}</strong><br>
                                            <small class="text-muted">NPM: {{ $a->npm }}</small>
                                        </div>
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $a->status_terbaru)) }}">
                                            @if($a->status_terbaru === 'Menunggu')
                                                <i class="bi bi-clock-history me-1"></i>
                                            @elseif($a->status_terbaru === 'Sedang Dikerjakan')
                                                <i class="bi bi-gear-fill me-1"></i>
                                            @elseif($a->status_terbaru === 'Selesai')
                                                <i class="bi bi-check-circle-fill me-1"></i>
                                            @else
                                                <i class="bi bi-x-circle-fill me-1"></i>
                                            @endif
                                            {{ $a->status_terbaru }}
                                        </span>
                                    </td>

                                    <!-- Photo Preview -->
                                    <td>
                                        <div class="d-flex gap-2 align-items-center flex-wrap">
                                            @php
                                                $fotoBuktiArray = is_string($a->foto_bukti) ? json_decode($a->foto_bukti, true) : ($a->foto_bukti ?? []);
                                            @endphp
                                            @if(!empty($fotoBuktiArray) && count($fotoBuktiArray) > 0)
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ $fotoBuktiArray[0] }}" 
                                                         class="photo-preview" 
                                                         alt="Foto Bukti"
                                                         loading="lazy">
                                                    @if(count($fotoBuktiArray) > 1)
                                                        <span class="position-absolute bottom-0 end-0 badge bg-dark rounded-circle" style="font-size: 0.7rem; padding: 2px 4px;">+{{ count($fotoBuktiArray) - 1 }}</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted fs-6">-</span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Catatan Admin -->
                                    <td>{{ $a->catatan_admin ?? '-' }}</td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        @if($a->status_terbaru !== 'Selesai')
                                            <a href="{{ route('pic.tindaklanjut.form', $a->id) }}" class="btn btn-sm btn-warning text-dark">
                                                <i class="bi bi-pencil-square me-1"></i> Tindak Lanjut
                                            </a>
                                        @else
                                            <a href="{{ route('pic.tindaklanjut.view', $a->id) }}" class="btn btn-sm btn-warning text-dark"
                                       data-bs-toggle="tooltip"
                                       title="Lihat Detail">
                                                <i class="bi bi-eye me-1"></i> Lihat
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection
