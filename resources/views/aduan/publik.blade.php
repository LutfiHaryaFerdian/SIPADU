@extends('layouts.mahasiswa')

@section('title', 'SIPADU - Aduan Publik')

@section('content')

<!-- Hero Header -->
<section class="publik-hero position-relative text-white mb-5">
    <div class="hero-overlay"></div>
    <div class="container position-relative py-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-3">
                    <div class="hero-icon me-3">
                        <i class="bi bi-globe2"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-1">Aduan Publik</h1>
                        <p class="mb-0 opacity-90">Lihat semua aduan publik yang masuk ke sistem. Identitas pelapor disembunyikan demi privasi.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="hero-stats">
                    <div class="stat-item">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        <span class="fw-bold">{{ $aduan->count() }}</span> Aduan Publik
                    </div>
                </div>
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
                    <select class="form-select form-select-lg" id="filterKategori">
                        <option value="">Semua Kategori</option>
                        @php
                            $categories = $aduan->pluck('kategori')->unique()->sort();
                        @endphp
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
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
            <h4 class="fw-bold mb-2">Belum Ada Aduan Publik</h4>
            <p class="text-muted mb-0">Saat ini tidak ada aduan publik yang tersedia di sistem.</p>
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
                                <th>Nomor Tiket</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aduan as $a)
                                <tr class="aduan-row" 
                                    data-status="{{ $a->status }}" 
                                    data-kategori="{{ $a->kategori }}"
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
                                                <span>•</span>
                                                <span>
                                                    <i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($a->created_at)->format('H:i') }}
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

                                    <!-- Nomor Tiket -->
                                    <td>
                                        <code class="ticket-code">{{ $a->nomor_tiket }}</code>
                                    </td>

                                    <!-- Aksi -->
                                    <td class="text-center">
                                        <a href="{{ route('aduan.publik.detail', $a->id) }}" 
                                           class="btn btn-sm btn-primary"
                                           data-bs-toggle="tooltip"
                                           title="Lihat Detail">
                                            <i class="bi bi-eye me-1"></i>Lihat Detail
                                        </a>
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

<!-- ... existing code ... -->
<style>
    /* <CHANGE> Replaced all purple gradient #667eea 0%, #764ba2 with blue gradient #0284c7 0%, #0369a1 */
    .publik-hero {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        position: relative;
        overflow: hidden;
    }

    .publik-hero::before {
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

    .publik-hero .container {
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

    .hero-stats {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 16px 24px;
        border-radius: 50px;
        display: inline-block;
    }

    .stat-item {
        font-size: 1rem;
        font-weight: 500;
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

        .hero-stats {
            font-size: 0.9rem;
            padding: 12px 20px;
        }
    }
</style>

<script>
    // Search Functionality
    document.getElementById('searchInput')?.addEventListener('keyup', filterTable);
    document.getElementById('filterStatus')?.addEventListener('change', filterTable);
    document.getElementById('filterKategori')?.addEventListener('change', filterTable);

    function filterTable() {
        const searchValue = document.getElementById('searchInput')?.value.toLowerCase() || '';
        const statusFilter = document.getElementById('filterStatus')?.value || '';
        const kategoriFilter = document.getElementById('filterKategori')?.value || '';
        
        const rows = document.querySelectorAll('.aduan-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const searchText = row.getAttribute('data-search');
            const status = row.getAttribute('data-status');
            const kategori = row.getAttribute('data-kategori');

            const matchSearch = searchText.includes(searchValue);
            const matchStatus = !statusFilter || status === statusFilter;
            const matchKategori = !kategoriFilter || kategori === kategoriFilter;

            if (matchSearch && matchStatus && matchKategori) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Show/hide no results message
        const noResults = document.getElementById('noResults');
        const table = document.getElementById('aduanTable');
        
        if (visibleCount === 0) {
            table?.classList.add('d-none');
            noResults?.classList.remove('d-none');
        } else {
            table?.classList.remove('d-none');
            noResults?.classList.add('d-none');
        }
    }

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@endsection