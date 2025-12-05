<!-- Updated with modern styling matching admin layout but with blue theme -->
@extends('layouts.admin')

@section('title', 'SIPADU - Daftar Mahasiswa')

@section('content')

<!-- Hero Header -->
<section class="mahasiswa-hero position-relative text-white mb-5">
    <div class="hero-overlay"></div>
    <div class="container position-relative py-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-3">
                    <div class="hero-icon me-3">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-1">Daftar Mahasiswa</h1>
                        <p class="mb-0 opacity-90">Kelola dan pantau data mahasiswa dengan mudah.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid py-4">

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
                <div class="col-md-12">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" 
                               class="form-control border-start-0" 
                               id="searchInput"
                               placeholder="Cari berdasarkan nama, email, NPM, atau program studi...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Content -->
    @if(count($mahasiswa) == 0)
        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <h5 class="text-secondary fw-semibold">Belum Ada Mahasiswa</h5>
            <p class="text-muted">Tidak ada data mahasiswa untuk ditampilkan.</p>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="mahasiswaTable">
                        <thead>
                            <tr>
                                <th class="ps-4">Mahasiswa</th>
                                <th>Email</th>
                                <th>NPM</th>
                                <th>Program Studi</th>
                                <th>No. HP</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswa as $mhs)
                                <tr class="mahasiswa-row" 
                                    data-search="{{ strtolower($mhs->nama . ' ' . $mhs->email . ' ' . $mhs->npm . ' ' . $mhs->prodi) }}">
                                    
                                    <!-- Mahasiswa Info -->
                                    <td class="ps-4">
                                        <div class="mahasiswa-info d-flex align-items-center gap-3">
                                            <img src="{{ $mhs->foto_profile ?? '/placeholder.svg?height=50&width=50' }}" 
                                                 class="rounded-circle" 
                                                 width="50" 
                                                 height="50"
                                                 alt="Foto {{ $mhs->nama }}"
                                                 style="object-fit: cover;">
                                            <div>
                                                <h6 class="mb-1 fw-bold text-dark">{{ $mhs->nama }}</h6>
                                                <small class="text-muted">{{ $mhs->prodi }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Email -->
                                    <td>
                                        <small class="text-muted">{{ $mhs->email }}</small>
                                    </td>

                                    <!-- NPM -->
                                    <td class="font-monospace">{{ $mhs->npm }}</td>

                                    <!-- Program Studi -->
                                    <td>
                                        <small>{{ $mhs->prodi }}</small>
                                    </td>

                                    <!-- No. HP -->
                                    <td>
                                        <small class="text-muted">{{ $mhs->no_hp ?? '-' }}</small>
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <a href="{{ route('admin.mahasiswa.detail', $mhs->id) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye me-1"></i> Lihat
                                        </a>
                                        <form action="{{ route('admin.mahasiswa.delete', $mhs->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="noResults" class="text-center py-5 d-none">
                    <i class="bi bi-search fs-1 text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada hasil yang ditemukan</h5>
                    <p class="text-muted">Coba ubah kata kunci pencarian Anda</p>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    /* Hero Section */
    /* Blue theme for mahasiswa layout */
    .mahasiswa-hero {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        position: relative;
        overflow: hidden;
    }

    .mahasiswa-hero::before {
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

    .mahasiswa-hero .container {
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

    /* Form Controls */
    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    /* Blue focus color for forms */
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }

    .input-group-text {
        border: 2px solid #e9ecef;
        border-radius: 12px 0 0 12px;
    }

    /* Table */
    /* Blue gradient for table header */
    thead {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
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

    /* Mahasiswa Info */
    .mahasiswa-info h6 {
        font-size: 1rem;
        margin-bottom: 6px;
        color: #212529;
    }

    .mahasiswa-info small {
        font-size: 0.85rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #f8f9fa;
        border-radius: 16px;
    }

    .empty-icon {
        font-size: 4rem;
        color: #0d6efd;
        margin-bottom: 20px;
    }

    .empty-state h5 {
        margin-bottom: 8px;
    }

    .empty-state p {
        margin: 0;
    }
</style>

<!-- Filter & Search JS -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('mahasiswaTable');
        const rows = table ? table.querySelectorAll('tbody .mahasiswa-row') : [];
        const noResults = document.getElementById('noResults');

        if (searchInput && table) {
            searchInput.addEventListener('keyup', function() {
                const query = this.value.toLowerCase();
                let visibleRows = 0;

                rows.forEach(row => {
                    const searchData = row.dataset.search;
                    if (searchData.includes(query)) {
                        row.style.display = '';
                        visibleRows++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                noResults.classList.toggle('d-none', visibleRows > 0);
            });
        }
    });
</script>

@endsection
