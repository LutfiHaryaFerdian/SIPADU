@extends('layouts.mahasiswa')

@section('title', 'SIPADU - Daftar Aduan Saya')

@section('content')
<div class="container my-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">
                <i class="bi bi-list-check me-2 text-primary"></i>Daftar Aduan Saya
            </h2>
            <p class="text-muted mb-0">Lihat semua laporan yang telah Anda buat dan pantau statusnya.</p>
        </div>

        <a href="{{ route('aduan.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Aduan
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Table -->
    @if($aduan->isEmpty())
        <div class="alert alert-secondary text-center py-4 shadow-sm">
            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486748.png" 
                 alt="Empty" style="height: 60px;">
            <p class="mb-0 text-muted mt-2">
                <i class="bi bi-info-circle me-1"></i> Belum ada aduan yang dikirim.
            </p>
        </div>
    @else

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Foto</th>
                                <th>Nomor Tiket</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($aduan as $a)
                                <tr>
                                    <td>
                                        {{ $a->judul }}
                                        <a href="{{ route('aduan.publik.detail', $a->id) }}" class="ms-2 text-primary" style="text-decoration: underline;">Detail Aduan</a>
                                    </td>
                                    <td>{{ $a->kategori }}</td>
                                    
                                    <td>
                                        <span class="badge 
                                            @if($a->status == 'Menunggu') bg-secondary
                                            @elseif($a->status == 'Diproses') bg-warning text-dark
                                            @elseif($a->status == 'Selesai') bg-success
                                            @endif">
                                            {{ $a->status }}
                                        </span>
                                    </td>

                                    <!-- FOTO BUKTI (benar) -->
                                    <td>
                                        @if($a->foto_url)
                                            <img src="{{ $a->foto_url }}" 
                                                 class="img-thumbnail" 
                                                 style="width: 90px; height: 90px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td><code>{{ $a->nomor_tiket }}</code></td>

                                    <td class="text-center">
                                        <form action="{{ route('aduan.destroy', $a->id) }}" 
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus aduan ini?')"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash3"></i> Hapus
                                            </button>

                                        </form>
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

@endsection
