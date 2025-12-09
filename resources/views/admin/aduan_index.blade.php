@extends('layouts.admin')

@section('title', 'SIPADU - Manajemen Aduan')

@section('content')

<!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

<!-- Hero Header -->
<section class="aduan-list-hero position-relative text-white mb-5">
    <div class="hero-overlay"></div>
    <div class="container position-relative py-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-3">
                    <div class="hero-icon me-3">
                        <i class="bi bi-chat-left-text"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-1">Manajemen Aduan Mahasiswa</h1>
                        <p class="mb-0 opacity-90">Kelola dan distribusikan aduan mahasiswa kepada PIC Unit dengan mudah.</p>
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

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center mb-4">
            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
            <div>
                <strong>Gagal!</strong> {{ session('error') }}
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
            <h5 class="text-secondary fw-semibold">Belum Ada Aduan</h5>
            <p class="text-muted">Tidak ada data aduan mahasiswa untuk ditampilkan.</p>
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
                                <th>Validasi</th>
                                <th>Foto</th>
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

                                    <!-- Mahasiswa Info -->
                                    <td>
                                        <div>
                                            <strong class="text-dark">{{ $a->nama_mahasiswa }}</strong><br>
                                            <small class="text-muted">NPM: {{ $a->npm }}</small>
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

                                    <!-- Photo Preview -->
                                    <td>
                                        <div class="d-flex gap-2 align-items-center flex-wrap">
                                            @if($a->foto_ktm)
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ $a->foto_ktm }}" 
                                                         class="photo-preview" 
                                                         alt="KTM"
                                                         loading="lazy">
                                                </div>
                                            @else
                                                <span class="text-muted fs-6">-</span>
                                            @endif

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

                                    <!-- Nomor Tiket -->
                                    <td class="font-monospace">{{ $a->nomor_tiket }}</td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <a href="{{ route('admin.aduan.detail', $a->id) }}" class="btn btn-sm btn-danger">
                                            <i class="bi bi-eye me-1"></i> Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="noResults" class="text-center py-5 d-none">
                    <i class="bi bi-search fs-1 text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada hasil yang ditemukan</h5>
                    <p class="text-muted">Coba ubah kata kunci atau filter pencarian Anda</p>
                </div>
            </div>
        </div>
    @endif
</div>



<!-- Filter & Search JS -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const filterStatus = document.getElementById('filterStatus');
        const filterValidasi = document.getElementById('filterValidasi');
        const rows = document.querySelectorAll('.aduan-row');
        const noResults = document.getElementById('noResults');

        function filterTable() {
            const searchValue = searchInput.value.toLowerCase();
            const statusValue = filterStatus.value;
            const validasiValue = filterValidasi.value;
            let visibleCount = 0;

            rows.forEach(row => {
                const searchText = row.dataset.search;
                const status = row.dataset.status;
                const validasi = row.dataset.validasi;

                const matchSearch = !searchValue || searchText.includes(searchValue);
                const matchStatus = !statusValue || status === statusValue;
                const matchValidasi = !validasiValue || validasi === validasiValue;

                const isVisible = (matchSearch && matchStatus && matchValidasi);
                row.style.display = isVisible ? '' : 'none';
                if (isVisible) visibleCount++;
            });

            noResults.classList.toggle('d-none', visibleCount > 0);
        }

        searchInput.addEventListener('keyup', filterTable);
        filterStatus.addEventListener('change', filterTable);
        filterValidasi.addEventListener('change', filterTable);
    });
</script>

@endsection
