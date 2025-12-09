@extends('layouts.mahasiswa')

@section('title', 'SIPADU - Daftar Aduan Saya')

@section('content')

<!-- Mahasiswa CSS -->
    <link rel="stylesheet" href="{{ asset('css/mahasiswa.css') }}">

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
                                        <div class="d-flex gap-2 justify-content-center">

                                            <!-- Tombol Lihat -->
                                            <a href="{{ route('aduan.publik.detail', $a->id) }}"
                                            class="btn btn-sm"
                                            style="background:#007bff; color:white; border-radius:12px; width:40px; height:40px; display:flex; align-items:center; justify-content:center;"
                                            data-bs-toggle="tooltip"
                                            title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('aduan.destroy', $a->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus aduan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm"
                                                        style="background:#dc3545; color:white; border-radius:12px; width:40px; height:40px; display:flex; align-items:center; justify-content:center;"
                                                        data-bs-toggle="tooltip"
                                                        title="Hapus Aduan">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>

                                        </div>
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

<script>
    // Search Functionality
    document.getElementById('searchInput')?.addEventListener('keyup', filterTable);
    document.getElementById('filterStatus')?.addEventListener('change', filterTable);
    document.getElementById('filterValidasi')?.addEventListener('change', filterTable);

    function filterTable() {
        const searchValue = document.getElementById('searchInput')?.value.toLowerCase() || '';
        const statusFilter = document.getElementById('filterStatus')?.value || '';
        const validasiFilter = document.getElementById('filterValidasi')?.value || '';
        
        const rows = document.querySelectorAll('.aduan-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const searchText = row.getAttribute('data-search');
            const status = row.getAttribute('data-status');
            const validasi = row.getAttribute('data-validasi');

            const matchSearch = searchText.includes(searchValue);
            const matchStatus = !statusFilter || status === statusFilter;
            const matchValidasi = !validasiFilter || validasi === validasiFilter;

            if (matchSearch && matchStatus && matchValidasi) {
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

    // Delete Confirmation
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus aduan ini? Tindakan ini tidak dapat dibatalkan.')) {
            document.getElementById('delete-form-' + id).submit();
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