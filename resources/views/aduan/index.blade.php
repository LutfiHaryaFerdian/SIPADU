@extends('layouts.mahasiswa')

@section('title', 'SIPADU - Daftar Aduan Saya')

@section('content')

<!-- Hero Header -->
<section class="aduan-list-hero position-relative text-white mb-5">
    <div class="hero-overlay"></div>
    <div class="container position-relative py-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-3">
                    <div class="hero-icon me-3">
                        <i class="bi bi-list-check"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-1">Daftar Aduan Saya</h1>
                        <p class="mb-0 opacity-90">Pantau status dan kelola semua laporan pengaduan Anda</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('aduan.create') }}" class="btn btn-light btn-lg px-4 shadow">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Aduan Baru
                </a>
            </div>
        </div>
    </div>
</section>

<div class="container mb-5">
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
                    <div class="stat-value">{{ $aduan->where('status', 'Menunggu')->count() }}</div>
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
                    <div class="stat-value">{{ $aduan->where('status', 'Diproses')->count() }}</div>
                    <div class="stat-label">Diproses</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card stat-done">
                <div class="stat-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $aduan->where('status', 'Selesai')->count() }}</div>
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

    <!-- Filter & Search -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" 
                               class="form-control border-start-0" 
                               id="searchInput"
                               placeholder="Cari berdasarkan judul, kategori, atau nomor tiket...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select form-select-lg" id="filterStatus">
                        <option value="">Semua Status</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select form-select-lg" id="filterValidasi">
                        <option value="">Semua Validasi</option>
                        <option value="belum">Belum Divalidasi</option>
                        <option value="Valid">Valid</option>
                        <option value="Tolak">Ditolak</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Content -->
    @if($aduan->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <h4 class="fw-bold mb-2">Belum Ada Aduan</h4>
            <p class="text-muted mb-4">Anda belum pernah membuat aduan. Mulai sampaikan keluhan Anda sekarang!</p>
            <a href="{{ route('aduan.create') }}" class="btn btn-primary btn-lg px-5">
                <i class="bi bi-plus-circle me-2"></i>Buat Aduan Pertama
            </a>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="aduanTable">
                        <thead>
                            <tr>
                                <th class="ps-4">Aduan</th>
                                <th>Status</th>
                                <th>Validasi</th>
                                <th>Dokumentasi</th>
                                <th>Nomor Tiket</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aduan as $a)
                                <tr class="aduan-row" 
                                    data-status="{{ $a->status }}" 
                                    data-validasi="{{ $a->status_validasi ?? 'belum' }}"
                                    data-search="{{ strtolower($a->judul . ' ' . $a->kategori . ' ' . $a->nomor_tiket) }}">
                                    
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

                                    <!-- Status -->
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

                                    <!-- Validasi -->
                                    <td>
                                        @if($a->status_validasi === null)
                                            <span class="validation-badge validation-pending">
                                                <i class="bi bi-hourglass-split me-1"></i>Belum
                                            </span>
                                        @elseif($a->status_validasi === 'Valid')
                                            <span class="validation-badge validation-valid">
                                                <i class="bi bi-shield-check me-1"></i>Valid
                                            </span>
                                        @else
                                            <span class="validation-badge validation-reject">
                                                <i class="bi bi-shield-x me-1"></i>Ditolak
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Dokumentasi -->
                                    <td>
                                        <div class="d-flex gap-2">
                                            <!-- Foto KTM -->
                                            @if($a->foto_ktm)
                                                <div class="photo-preview">
                                                    <img src="{{ $a->foto_ktm }}" alt="KTM">
                                                    <div class="photo-overlay">
                                                        <x-photo-viewer 
                                                            :fotoUrl="$a->foto_ktm" 
                                                            label="Foto KTM" />
                                                    </div>
                                                    <div class="photo-label">KTM</div>
                                                </div>
                                            @endif

                                            <!-- Foto Bukti -->
                                            @php
                                                $fotoBuktiArray = is_string($a->foto_bukti) ? json_decode($a->foto_bukti, true) : ($a->foto_bukti ?? []);
                                            @endphp
                                            @if(!empty($fotoBuktiArray) && count($fotoBuktiArray) > 0)
                                                <div class="photo-preview">
                                                    <img src="{{ $fotoBuktiArray[0] }}" alt="Bukti">
                                                    @if(count($fotoBuktiArray) > 1)
                                                        <div class="photo-count">+{{ count($fotoBuktiArray) - 1 }}</div>
                                                    @endif
                                                    <div class="photo-overlay">
                                                        <x-photo-gallery 
                                                            :fotoBuktiArray="$fotoBuktiArray" 
                                                            label="Foto Bukti Aduan" />
                                                    </div>
                                                    <div class="photo-label">Bukti</div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Nomor Tiket -->
                                    <td>
                                        <code class="ticket-code">{{ $a->nomor_tiket }}</code>
                                    </td>

                                    <!-- Aksi -->
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('aduan.publik.detail', $a->id) }}" 
                                               class="btn btn-sm btn-primary"
                                               data-bs-toggle="tooltip"
                                               title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-sm btn-danger"
                                                    data-bs-toggle="tooltip"
                                                    title="Hapus Aduan"
                                                    onclick="confirmDelete({{ $a->id }})">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </div>

                                        <!-- Hidden Form for Delete -->
                                        <form id="delete-form-{{ $a->id }}" 
                                              action="{{ route('aduan.destroy', $a->id) }}" 
                                              method="POST" 
                                              class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- No Results Message -->
                <div id="noResults" class="text-center py-5 d-none">
                    <i class="bi bi-search fs-1 text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada hasil yang ditemukan</h5>
                    <p class="text-muted">Coba ubah kata kunci atau filter pencarian Anda</p>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    /* Hero Section */
    .aduan-list-hero {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        position: relative;
        overflow: hidden;
    }

    .aduan-list-hero::before {
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

    .aduan-list-hero .container {
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

    /* Statistics Cards */
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        flex-shrink: 0;
    }

    .stat-total .stat-icon {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        color: white;
    }

    .stat-pending .stat-icon {
        background: linear-gradient(135deg, #868e96 0%, #6c757d 100%);
        color: white;
    }

    .stat-process .stat-icon {
        background: linear-gradient(135deg, #ffd93d 0%, #ffc107 100%);
        color: white;
    }

    .stat-done .stat-icon {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    .stat-content {
        flex: 1;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 8px;
        color: #212529;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 600;
    }

    /* Card */
    .card {
        border-radius: 16px;
        overflow: hidden;
    }

    /* Form Controls */
    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #0284c7;
        box-shadow: 0 0 0 0.2rem rgba(2, 132, 199, 0.15);
    }

    .input-group-text {
        border: 2px solid #e9ecef;
        border-radius: 12px 0 0 12px;
    }

    /* Table */
    thead {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
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
        vertical-align: middle;
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
        margin-bottom: 6px;
        color: #212529;
    }

    .aduan-info small {
        font-size: 0.85rem;
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

    .status-diproses {
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
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .validation-pending {
        background: #e9ecef;
        color: #495057;
    }

    .validation-valid {
        background: #d4edda;
        color: #155724;
    }

    .validation-reject {
        background: #f8d7da;
        color: #721c24;
    }

    /* Photo Preview */
    .photo-preview {
        position: relative;
        width: 70px;
        height: 70px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .photo-preview:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(2, 132, 199, 0.2);
    }

    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-count {
        position: absolute;
        bottom: 4px;
        right: 4px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: bold;
    }

    .photo-label {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        font-size: 0.7rem;
        padding: 2px;
        text-align: center;
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

    .btn-primary {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        border: none;
    }

    .btn-primary:hover {
        box-shadow: 0 6px 20px rgba(2, 132, 199, 0.4);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .empty-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stat-card {
            padding: 16px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }

        thead th {
            font-size: 0.75rem;
            padding: 12px 8px;
        }

        tbody td {
            padding: 12px 8px;
        }

        .hero-icon {
            width: 60px;
            height: 60px;
            font-size: 1.75rem;
        }
    }
</style>

<script>
    // ... existing search and filter functionality ...
</script>

@endsection