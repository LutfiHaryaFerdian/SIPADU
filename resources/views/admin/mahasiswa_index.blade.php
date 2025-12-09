<!-- Updated with modern styling matching admin layout but with blue theme -->
@extends('layouts.admin')

@section('title', 'SIPADU - Daftar Mahasiswa')

@section('content')

<!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

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
