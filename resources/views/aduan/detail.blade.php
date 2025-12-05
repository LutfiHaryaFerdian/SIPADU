@extends('layouts.mahasiswa')

@section('title', 'SIPADU - Detail Aduan Publik')

@section('content')

<!-- Hero Header -->
<section class="detail-hero position-relative text-white mb-5">
    <div class="hero-overlay"></div>
    <div class="container position-relative py-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-start mb-3">
                    <div class="hero-icon me-3">
                        <i class="bi bi-file-text-fill"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-2">{{ $aduan->judul }}</h1>
                        <div class="d-flex align-items-center gap-3 opacity-90">
                            <span><i class="bi bi-ticket-perforated me-2"></i>{{ $aduan->nomor_tiket }}</span>
                            <span>•</span>
                            <span><i class="bi bi-calendar3 me-2"></i>{{ \Carbon\Carbon::parse($aduan->created_at)->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                @if($aduan->status === 'Menunggu')
                    <span class="status-badge-hero status-menunggu">
                        <i class="bi bi-clock-history me-2"></i>Menunggu
                    </span>
                @elseif($aduan->status === 'Diproses' || $aduan->status === 'Sedang Dikerjakan')
                    <span class="status-badge-hero status-diproses">
                        <i class="bi bi-gear-fill me-2"></i>Sedang Dikerjakan
                    </span>
                @elseif($aduan->status === 'Ditolak')
                    <span class="status-badge-hero status-ditolak">
                        <i class="bi bi-x-circle-fill me-2"></i>Ditolak
                    </span>
                @else
                    <span class="status-badge-hero status-selesai">
                        <i class="bi bi-check-circle-fill me-2"></i>Selesai
                    </span>
                @endif
            </div>
        </div>
    </div>
</section>

<div class="container mb-5">
    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Kategori Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="category-icon me-3">
                            <i class="bi bi-tag-fill"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block mb-1">Kategori</small>
                            <h6 class="mb-0 fw-bold">{{ $aduan->kategori }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-file-text text-primary me-2"></i>Deskripsi Aduan
                    </h5>
                    <div class="description-box">
                        {{ $aduan->deskripsi }}
                    </div>
                </div>
            </div>

            <!-- Validasi Admin Card -->
            @if($aduan->status_validasi !== null)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-shield-check text-primary me-2"></i>Status Validasi
                        </h5>
                        @if($aduan->status_validasi === 'Valid')
                            <span class="validation-badge validation-valid">
                                <i class="bi bi-shield-check me-1"></i>Valid
                            </span>
                        @else
                            <span class="validation-badge validation-reject">
                                <i class="bi bi-shield-x me-1"></i>Tidak Valid
                            </span>
                        @endif
                    </div>
                    <div class="note-box">
                        <strong class="d-block mb-2 text-muted">Catatan Admin:</strong>
                        <p class="mb-0">{{ $aduan->catatan_admin }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Catatan PIC Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-person-badge text-primary me-2"></i>Catatan PIC Unit
                    </h5>
                    
                    @if($catatanPic->isEmpty())
                        <div class="empty-notes">
                            <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
                            <p class="text-muted mb-0">
                                @if($aduan->status_validasi === null)
                                    Menunggu validasi admin...
                                @else
                                    Belum ada catatan dari PIC.
                                @endif
                            </p>
                        </div>
                    @else
                        <div class="timeline">
                            @foreach($catatanPic as $c)
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <strong class="d-block">{{ $c->pic_nama }}</strong>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($c->created_at)->format('d M Y H:i') }}</small>
                                            </div>
                                            <span class="status-badge status-{{ strtolower($c->status) }}">
                                                @if($c->status === 'Selesai')
                                                    <i class="bi bi-check-circle-fill me-1"></i>
                                                @else
                                                    <i class="bi bi-gear-fill me-1"></i>
                                                @endif
                                                {{ $c->status }}
                                            </span>
                                        </div>
                                        <div class="note-box mb-2">
                                            {{ $c->catatan }}
                                        </div>
                                        @if($c->catatan_selesai)
                                            <div class="completion-note">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="bi bi-check-circle me-1"></i>Catatan Penyelesaian:
                                                </small>
                                                {{ $c->catatan_selesai }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Lampiran Foto -->
            @if($userType !== 'public')
                @php
                    $fotoBuktiArray = is_string($aduan->foto_bukti) ? json_decode($aduan->foto_bukti, true) : ($aduan->foto_bukti ?? []);
                    if (empty($fotoBuktiArray) && isset($aduan->foto_url)) {
                        $fotoBuktiArray = [$aduan->foto_url];
                    }
                @endphp
                
                @if($userType === 'mahasiswa_owner' || $userType === 'admin')
                    @if($aduan->foto_ktm || !empty($fotoBuktiArray))
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-3">
                                    <i class="bi bi-images text-primary me-2"></i>Lampiran Foto
                                </h5>
                                <div class="row g-3">
                                    @if($aduan->foto_ktm)
                                        <div class="col-md-6">
                                            <div class="photo-card">
                                                <img src="{{ $aduan->foto_ktm }}" alt="Foto KTM" class="photo-img">
                                                <div class="photo-overlay">
                                                    <x-photo-viewer :fotoUrl="$aduan->foto_ktm" label="Foto KTM" />
                                                </div>
                                                <div class="photo-footer">
                                                    <i class="bi bi-credit-card-2-front me-2"></i>Foto KTM
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($fotoBuktiArray) && count($fotoBuktiArray) > 0)
                                        <div class="col-md-6">
                                            <div class="photo-card">
                                                <img src="{{ $fotoBuktiArray[0] }}" alt="Foto Bukti" class="photo-img">
                                                @if(count($fotoBuktiArray) > 1)
                                                    <span class="photo-count">+{{ count($fotoBuktiArray) - 1 }}</span>
                                                @endif
                                                <div class="photo-overlay">
                                                    <x-photo-gallery :fotoBuktiArray="$fotoBuktiArray" label="Foto Bukti Aduan" />
                                                </div>
                                                <div class="photo-footer">
                                                    <i class="bi bi-image me-2"></i>Foto Bukti ({{ count($fotoBuktiArray) }} foto)
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                
                @elseif($userType === 'pic')
                    @if(!empty($fotoBuktiArray) && count($fotoBuktiArray) > 0)
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-3">
                                    <i class="bi bi-images text-primary me-2"></i>Lampiran Foto
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="photo-card">
                                            <img src="{{ $fotoBuktiArray[0] }}" alt="Foto Bukti" class="photo-img">
                                            @if(count($fotoBuktiArray) > 1)
                                                <span class="photo-count">+{{ count($fotoBuktiArray) - 1 }}</span>
                                            @endif
                                            <div class="photo-overlay">
                                                <x-photo-gallery :fotoBuktiArray="$fotoBuktiArray" label="Foto Bukti Aduan" />
                                            </div>
                                            <div class="photo-footer">
                                                <i class="bi bi-image me-2"></i>Foto Bukti ({{ count($fotoBuktiArray) }} foto)
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @else
                <div class="alert alert-info border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-info-circle fs-4 me-3"></i>
                        <div>
                            <strong>Catatan Privasi:</strong> Foto dan identitas pelapor bersifat privasi. Hanya informasi dan status aduan yang ditampilkan di sini untuk verifikasi keabsahan aduan.
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Info Card -->
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-info-circle text-primary me-2"></i>Informasi Aduan
                    </h5>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-ticket-perforated"></i>
                        </div>
                        <div class="info-content">
                            <small class="text-muted d-block mb-1">Nomor Tiket</small>
                            <code class="ticket-code">{{ $aduan->nomor_tiket }}</code>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="info-content">
                            <small class="text-muted d-block mb-1">Tanggal Laporan</small>
                            <strong>{{ \Carbon\Carbon::parse($aduan->created_at)->format('d M Y H:i') }}</strong>
                        </div>
                    </div>

                    <div class="info-item mb-0">
                        <div class="info-icon">
                            <i class="bi bi-flag"></i>
                        </div>
                        <div class="info-content">
                            <small class="text-muted d-block mb-2">Status</small>
                            @if($aduan->status === 'Menunggu')
                                <span class="status-badge status-menunggu">
                                    <i class="bi bi-clock-history me-1"></i>Menunggu
                                </span>
                            @elseif($aduan->status === 'Diproses' || $aduan->status === 'Sedang Dikerjakan')
                                <span class="status-badge status-diproses">
                                    <i class="bi bi-gear-fill me-1"></i>Sedang Dikerjakan
                                </span>
                            @else
                                <span class="status-badge status-selesai">
                                    <i class="bi bi-check-circle-fill me-1"></i>Selesai
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-white border-top p-4">
                    <a href="{{ route('aduan.index') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ... existing code ... -->
<style>
    /* <CHANGE> Replaced all purple gradient #667eea 0%, #764ba2 with blue gradient #0284c7 0%, #0369a1 */
    .detail-hero {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
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
        flex-shrink: 0;
    }

    .status-badge-hero {
        display: inline-flex;
        align-items: center;
        padding: 12px 24px;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .status-badge-hero.status-menunggu {
        color: #495057;
    }

    .status-badge-hero.status-diproses {
        color: #856404;
    }

    .status-badge-hero.status-selesai {
        color: #155724;
    }

    .status-badge-hero.status-ditolak {
        color: #721c24;
    }

    /* Card */
    .card {
        border-radius: 16px;
        overflow: hidden;
    }

    /* Category Icon */
    .category-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    /* Description Box */
    .description-box {
        background: #f8f9fa;
        border-left: 4px solid #0284c7;
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
        border-left: 4px solid #0284c7;
    }

    /* Completion Note */
    .completion-note {
        background: #d4edda;
        border-radius: 12px;
        padding: 12px;
        border-left: 4px solid #28a745;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #e9ecef;
        color: #495057;
    }

    .status-diproses, .status-sedang {
        background: #fff3cd;
        color: #856404;
    }

    .status-selesai {
        background: #d4edda;
        color: #155724;
    }

    .status-ditolak {
        background: #f8d7da;
        color: #721c24;
    }

    /* Validation Badge */
    .validation-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .validation-valid {
        background: #d4edda;
        color: #155724;
    }

    .validation-reject {
        background: #f8d7da;
        color: #721c24;
    }

    /* Timeline */
    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 30px;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-marker {
        position: absolute;
        left: -30px;
        top: 0;
        width: 20px;
        height: 20px;
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 0 0 2px #0284c7;
    }

    .timeline-content {
        background: #f8f9fa;
        padding: 16px;
        border-radius: 12px;
        border-left: 4px solid #0284c7;
    }

    /* Info Item */
    .info-item {
        display: flex;
        align-items: flex-start;
        padding: 16px 0;
        border-bottom: 1px solid #f1f3f5;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .info-content {
        flex: 1;
    }

    /* Photo Card */
    .photo-card {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background: #f8f9fa;
    }

    .photo-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .photo-count {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: bold;
    }

    .photo-footer {
        padding: 12px 16px;
        background: white;
        border-top: 1px solid #e9ecef;
        font-size: 0.9rem;
        font-weight: 600;
        color: #495057;
    }

    /* Ticket Code */
    .ticket-code {
        display: inline-block;
        padding: 8px 12px;
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #495057;
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

    .btn-outline-primary {
        border: 2px solid #0284c7;
        color: #0284c7;
    }

    .btn-outline-primary:hover {
        background: #0284c7;
        border-color: #0284c7;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-icon {
            width: 60px;
            height: 60px;
            font-size: 1.75rem;
        }

        .photo-img {
            height: 200px;
        }

        .card {
            margin-bottom: 16px;
        }
    }
</style>

@endsection