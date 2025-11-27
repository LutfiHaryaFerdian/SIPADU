@extends('layouts.pic')

@section('title', 'SIPADU - Aduan Ditugaskan')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <img src="https://cdn-icons-png.flaticon.com/512/3220/3220653.png" 
             alt="Aduan PIC" class="img-fluid mb-3" style="max-height: 120px;">
        <h2 class="fw-bold text-warning mb-1">
            <i class="bi bi-list-task me-2"></i>Aduan Ditugaskan Kepada Anda
        </h2>
        <p class="text-muted mb-0">Kelola dan tangani aduan mahasiswa yang telah ditugaskan ke unit Anda.</p>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Jika tidak ada aduan --}}
    @if($aduan->isEmpty())
        <div class="alert alert-warning text-center shadow-sm">
            <i class="bi bi-info-circle-fill me-2"></i>Belum ada aduan yang ditugaskan.
        </div>
    @else
        <div class="card shadow border-0">
            <div class="card-header bg-warning text-dark fw-semibold">
                <i class="bi bi-clipboard-data me-2"></i>Daftar Aduan Mahasiswa
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-warning text-dark">
                            <tr>
                                <th>Judul</th>
                                <th>Foto</th>
                                <th>Mahasiswa</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Catatan Admin</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($aduan as $a)
                                <tr>
                                    <td class="fw-semibold">
                                        {{ $a->judul }}
                                        <a href="{{ route('aduan.publik.detail', $a->id) }}" class="ms-2 text-primary" style="text-decoration: underline;">Detail Aduan</a>
                                    </td>

                                    {{-- FOTO --}}
                                    <td>
                                        @if($a->foto_url)
                                            <img src="{{ $a->foto_url }}" 
                                                class="img-thumbnail"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        @else
                                            <small class="text-muted">Tidak ada foto</small>
                                        @endif
                                    </td>

                                    {{-- MAHASISWA --}}
                                    <td>
                                        <strong>{{ $a->nama_mahasiswa }}</strong><br>
                                        <small class="text-muted">{{ $a->npm }}</small>
                                    </td>

                                    <td>{{ $a->kategori }}</td>

                                    <td>
                                        @if($a->status_terbaru === 'Menunggu')
                                            <span class="badge bg-secondary">Menunggu</span>
                                        @elseif($a->status_terbaru === 'Diproses' || $a->status_terbaru === 'Sedang Dikerjakan')
                                            <span class="badge bg-warning text-dark">Sedang Dikerjakan</span>
                                        @else
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>

                                    <td>{{ $a->catatan_admin ?? '-' }}</td>

                                    {{-- Aksi --}}
                                    <td class="text-center">
                                        @if($a->status_terbaru !== 'Selesai')
                                            <a href="{{ route('pic.tindaklanjut.form', $a->id) }}" 
                                               class="btn btn-sm btn-warning text-white">
                                                <i class="bi bi-pencil-square me-1"></i> Tindak Lanjut
                                            </a>
                                        @else
                                            <a href="{{ route('pic.tindaklanjut.view', $a->id) }}" 
                                               class="btn btn-sm btn-success text-white">
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

<style>
.table thead.table-warning th {
    background-color: #ffe58f !important;
}
.table-hover tbody tr:hover {
    background-color: #fff3cd !important;
}
.card:hover {
    transform: translateY(-4px);
    transition: 0.3s ease;
}
</style>
@endsection
