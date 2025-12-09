<!-- Updated with modern styling and red theme for admin -->
@extends('layouts.admin')

@section('title', 'SIPADU - Detail Aduan')

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
                        <i class="bi bi-chat-left-text"></i>
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
                <a href="{{ route('admin.aduan.index') }}" class="btn btn-light btn-lg px-4 shadow">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</section>

<div class="container mb-5">
    {{-- Notifikasi --}}
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

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Informasi Aduan -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-chat-dots text-danger me-2"></i>Informasi Aduan
                    </h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>NPM Pelapor:</strong></p>
                            <p class="text-monospace fw-semibold text-danger">{{ $aduan->npm }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Kategori:</strong></p>
                            <div class="category-icon-inline">
                                <i class="bi bi-tag-fill"></i>
                                <span class="ms-2">{{ $aduan->kategori }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Nama Pelapor:</strong></p>
                            <p><strong>{{ $aduan->nama_mahasiswa }}</strong></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Email:</strong></p>
                            <p>{{ $aduan->email }}</p>
                        </div>
                    </div>

                    <hr>
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-file-text text-danger me-2"></i>Deskripsi Aduan
                    </h5>
                    <div class="description-box">
                        {{ $aduan->deskripsi }}
                    </div>
                </div>
            </div>

            <!-- Foto KTM -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-image text-danger me-2"></i>Foto KTM
                    </h5>
                    @if($aduan->foto_ktm)
                        <div class="photo-card">
                            <img src="{{ $aduan->foto_ktm }}" alt="Foto KTM" class="photo-img">
                        </div>
                    @else
                        <div class="alert alert-warning border-0 mb-0">
                            <i class="bi bi-exclamation-triangle me-2"></i>Foto KTM tidak tersedia
                        </div>
                    @endif
                </div>
            </div>

            <!-- Foto Bukti -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-images text-danger me-2"></i>Foto Bukti Aduan
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
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Status Aduan -->
            <div class="card border-0 shadow-sm sticky-top mb-4" style="top: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-info-circle text-danger me-2"></i>Status Aduan
                    </h5>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-flag"></i>
                        </div>
                        <div class="info-content">
                            <small class="text-muted d-block mb-2">Status Proses</small>
                            @if($aduan->status === 'Menunggu')
                                <span class="status-badge status-menunggu">
                                    <i class="bi bi-hourglass me-1"></i>Menunggu
                                </span>
                            @elseif($aduan->status === 'Diproses')
                                <span class="status-badge status-diproses">
                                    <i class="bi bi-gear-fill me-1"></i>Diproses
                                </span>
                            @else
                                <span class="status-badge status-selesai">
                                    <i class="bi bi-check-circle-fill me-1"></i>Selesai
                                </span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="info-content">
                            <small class="text-muted d-block mb-2">Validasi Admin</small>
                            @if($aduan->status_validasi === null)
                                <span class="validation-badge validation-pending">
                                    <i class="bi bi-hourglass-split me-1"></i>Belum Divalidasi
                                </span>
                            @elseif($aduan->status_validasi === 'Valid')
                                <span class="validation-badge validation-valid">
                                    <i class="bi bi-shield-check me-1"></i>Valid
                                </span>
                            @else
                                <span class="validation-badge validation-reject">
                                    <i class="bi bi-shield-x me-1"></i>Tidak Valid
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($aduan->catatan_admin)
                        <hr>
                        <p class="mb-2"><strong>Catatan:</strong></p>
                        <div class="note-box">
                            {{ $aduan->catatan_admin }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Validasi Form (hanya jika belum divalidasi) -->
            @if($aduan->status_validasi === null)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            <i class="bi bi-check-lg text-success me-2"></i>Validasi Aduan
                        </h5>
                        <ul class="nav nav-tabs mb-3" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="valid-tab" data-bs-toggle="tab" data-bs-target="#valid" type="button" role="tab">
                                    <i class="bi bi-check-circle me-1"></i>Valid
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reject-tab" data-bs-toggle="tab" data-bs-target="#reject" type="button" role="tab">
                                    <i class="bi bi-x-circle me-1"></i>Tolak
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- Tab Valid -->
                            <div class="tab-pane fade show active" id="valid" role="tabpanel">
                                <form action="{{ route('admin.aduan.validate', $aduan->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="catatanValid" class="form-label">Catatan Validasi <span class="text-danger">*</span></label>
                                        <textarea name="catatan_admin" id="catatanValid" class="form-control" rows="5" placeholder="Jelaskan alasan mengapa aduan ini VALID..." required></textarea>
                                        <small class="text-muted">Catatan akan ditampilkan kepada pelapor</small>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="bi bi-check-circle me-1"></i> Validasi Sebagai Valid
                                    </button>
                                </form>
                            </div>

                            <!-- Tab Tolak -->
                            <div class="tab-pane fade" id="reject" role="tabpanel">
                                <form action="{{ route('admin.aduan.reject', $aduan->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="catatanReject" class="form-label">Catatan Penolakan <span class="text-danger">*</span></label>
                                        <textarea name="catatan_admin" id="catatanReject" class="form-control" rows="5" placeholder="Jelaskan alasan mengapa aduan ini TIDAK VALID..." required></textarea>
                                        <small class="text-muted">Catatan akan ditampilkan kepada pelapor</small>
                                    </div>
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="bi bi-x-circle me-1"></i> Tolak Aduan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Assign to PIC (hanya jika sudah Valid) -->
            @if($aduan->status_validasi === 'Valid' && $aduan->status === 'Menunggu')
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            <i class="bi bi-person-check text-primary me-2"></i>Tugaskan ke PIC
                        </h5>
                        <form action="{{ route('admin.aduan.assign', $aduan->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="idPic" class="form-label">Pilih PIC Unit <span class="text-danger">*</span></label>
                                <select name="id_pic" id="idPic" class="form-select" required>
                                    <option value="">-- Pilih PIC Unit --</option>
                                    @foreach($picUnits as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_unit }} - {{ $p->nama_pic }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan (Opsional)</label>
                                <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Catatan tambahan untuk PIC..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-send-fill me-1"></i> Tugaskan ke PIC
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            <!-- Mark as Done (hanya jika Diproses) -->
            @if($aduan->status === 'Diproses')
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.aduan.done', $aduan->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-check2-circle me-1"></i> Tandai Selesai
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>



@endsection
