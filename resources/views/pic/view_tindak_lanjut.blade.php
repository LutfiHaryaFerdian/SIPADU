@extends('layouts.pic')

@section('title', 'SIPADU - Detail Tindak Lanjut')

@section('content')

<!-- Hero Header -->
<section class="detail-hero position-relative text-dark mb-5">
    <div class="hero-overlay"></div>
    <div class="container position-relative py-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-start mb-3">
                    <div class="hero-icon me-3">
                        <i class="bi bi-eye"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-2">Detail Tindak Lanjut Aduan</h1>
                        <div class="d-flex align-items-center gap-3 opacity-90">
                            <span><i class="bi bi-calendar3 me-2"></i>{{ \Carbon\Carbon::parse($aduan->created_at)->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('pic.aduan.index') }}" class="btn btn-light btn-lg px-4 shadow">
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
            <!-- Informasi Aduan -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-chat-dots" style="color: #ffc107;"></i> {{ $aduan->judul }}
                    </h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Kategori:</strong></p>
                            <div class="category-icon-inline">
                                <i class="bi bi-tag-fill"></i>
                                <span class="ms-2">{{ $aduan->kategori }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Status Sekarang:</strong></p>
                            <span class="badge bg-success fs-6">
                                <i class="bi bi-check-circle-fill me-1"></i>{{ $tindakLanjutTerbaru->status }}
                            </span>
                        </div>
                    </div>

                    <hr>
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-file-text" style="color: #ffc107;"></i> Deskripsi Aduan
                    </h5>
                    <div class="description-box">
                        {{ $aduan->deskripsi }}
                    </div>
                </div>
            </div>

            <!-- Foto Bukti -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-images" style="color: #ffc107;"></i> Foto Bukti Aduan
                    </h5>
                    @php
                        $fotoBuktiArray = is_string($aduan->foto_bukti) ? json_decode($aduan->foto_bukti, true) : ($aduan->foto_bukti ?? []);
                    @endphp
                    @if(!empty($fotoBuktiArray) && count($fotoBuktiArray) > 0)
                        <div class="row g-3">
                            @foreach($fotoBuktiArray as $index => $foto)
                                <div class="col-md-6">
                                    <div class="photo-card">
                                        <img src="{{ $foto }}" alt="Foto Bukti {{ $index + 1 }}" class="photo-img">
                                        <div class="photo-footer">
                                            <small class="text-muted">Foto {{ $index + 1 }} dari {{ count($fotoBuktiArray) }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning border-0 mb-0">
                            <i class="bi bi-exclamation-triangle me-2"></i>Foto bukti tidak tersedia
                        </div>
                    @endif
                </div>
            </div>

            <!-- Catatan Penyelesaian -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-check2-circle" style="color: #ffc107;"></i> Catatan Penyelesaian
                    </h5>

                    @if($tindakLanjutTerbaru->catatan_selesai)
                        <div class="note-box" style="border-left-color: #28a745;">
                            <strong class="text-success d-block mb-2">
                                Catatan Final:
                            </strong>
                            {{ $tindakLanjutTerbaru->catatan_selesai }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>Belum ada catatan penyelesaian final.
                        </div>

                        <a href="{{ route('pic.catatan.edit-selesai', $aduan->id) }}" 
                           class="btn btn-success btn-sm">
                            <i class="bi bi-plus-circle me-1"></i>Tambah Catatan Penyelesaian
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar: Riwayat -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top mb-4" style="top: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-clock-history" style="color: #ffc107;"></i> Riwayat Tindak Lanjut
                    </h5>

                    @foreach($riwayatTindakLanjut as $tl)
                        <div class="mb-4 pb-3 border-bottom">

                            <!-- Status -->
                            <strong>
                                @if($tl->status === 'Sedang Dikerjakan')
                                    <i class="bi bi-gear-wide-connected text-warning me-1"></i> Sedang Dikerjakan
                                @else
                                    <i class="bi bi-check-circle-fill text-success me-1"></i> Selesai
                                @endif
                            </strong>

                            <div class="text-muted small mb-2">
                                {{ \Carbon\Carbon::parse($tl->created_at)->format('d M Y H:i') }}
                                @if($tl->updated_at != $tl->created_at)
                                    <br><em>Diperbarui: {{ \Carbon\Carbon::parse($tl->updated_at)->format('d M Y H:i') }}</em>
                                @endif
                            </div>

                            <!-- Catatan -->
                            <div class="p-2 bg-light border-start border-4 rounded"
                                 style="border-color: {{ $tl->status === 'Sedang Dikerjakan' ? '#ffc107' : '#28a745' }};">
                                {{ $tl->catatan }}

                                @if($tl->catatan_selesai)
                                    <hr class="my-2">
                                    <strong class="small text-muted">Catatan Penyelesaian:</strong>
                                    <p class="mb-0">{{ $tl->catatan_selesai }}</p>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Hero Section - Changed from red to yellow */
    .detail-hero {
        background: linear-gradient(135deg, #ffca2c 0%, #ffc107 100%);
        position: relative;
        overflow: hidden;
    }

    .detail-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(20px); }
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.05);
        z-index: 1;
    }

    .detail-hero .container {
        z-index: 2;
    }

    .hero-icon {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
    }

    /* Card */
    .card {
        border-radius: 16px;
        overflow: hidden;
    }

    /* Category Icon */
    .category-icon-inline {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, #ffca2c 0%, #ffc107 100%);
        color: #212529;
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 600;
    }

    /* Description Box */
    .description-box {
        background: #f8f9fa;
        border-left: 4px solid #ffc107;
        padding: 20px;
        border-radius: 12px;
        line-height: 1.8;
        color: #495057;
    }

    /* Note Box */
    .note-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 16px;
        border-left: 4px solid #ffc107;
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

    .photo-footer {
        background: #f8f9fa;
        padding: 12px 16px;
        text-align: center;
        border-top: 1px solid #e9ecef;
    }
</style>

@endsection
