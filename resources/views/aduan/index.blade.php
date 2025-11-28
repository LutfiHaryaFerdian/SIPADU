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
                                <th>Validasi</th>
                                <th>Foto</th>
                                <th>Nomor Tiket</th>
                                <th class="text-center">Detail</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($aduan as $a)
                                <tr>
                                    <td>
                                        {{ $a->judul }}
                                    </td>
                                    <td>{{ $a->kategori }}</td>
                                    
                                    <td>
                                        <span class="badge 
                                            @if($a->status == 'Menunggu') bg-secondary
                                            @elseif($a->status == 'Diproses') bg-warning text-dark
                                            @elseif($a->status == 'Selesai') bg-success
                                            @elseif($a->status == 'Ditolak') bg-danger text-white
                                            @endif">
                                            {{ $a->status }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($a->status_validasi === null)
                                            <span class="badge bg-dark">
                                                <i class="bi bi-question-circle me-1"></i>Belum
                                            </span>
                                        @elseif($a->status_validasi === 'Valid')
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle-fill me-1"></i>Valid
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle-fill me-1"></i>Tolak
                                            </span>
                                        @endif
                                    </td>

                                    <!-- FOTO KTM & BUKTI -->
                                    <td>
                                        <div class="d-flex gap-2 align-items-center flex-wrap">
                                            <!-- Foto KTM -->
                                            @if($a->foto_ktm)
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ $a->foto_ktm }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 70px; height: 70px; object-fit: cover;">
                                                    <div class="position-absolute top-0 end-0" style="background: white; border-radius: 50%; padding: 2px; margin: -8px -8px 0 0;">
                                                        <x-photo-viewer 
                                                            :fotoUrl="$a->foto_ktm" 
                                                            label="Foto KTM" />
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted fs-6">-</span>
                                            @endif

                                            <!-- Foto Bukti (Multiple) -->
                                            @php
                                                $fotoBuktiArray = is_string($a->foto_bukti) ? json_decode($a->foto_bukti, true) : ($a->foto_bukti ?? []);
                                            @endphp
                                            @if(!empty($fotoBuktiArray) && count($fotoBuktiArray) > 0)
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ $fotoBuktiArray[0] }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 70px; height: 70px; object-fit: cover;">
                                                    @if(count($fotoBuktiArray) > 1)
                                                        <span class="position-absolute bottom-0 end-0 badge bg-dark rounded-circle" style="font-size: 0.7rem; padding: 2px 4px;">+{{ count($fotoBuktiArray) - 1 }}</span>
                                                    @endif
                                                    <div class="position-absolute top-0 end-0" style="background: white; border-radius: 50%; padding: 2px; margin: -8px -8px 0 0;">
                                                        <x-photo-gallery 
                                                            :fotoBuktiArray="$fotoBuktiArray" 
                                                            label="Foto Bukti Aduan" />
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted fs-6">-</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td><code>{{ $a->nomor_tiket }}</code></td>

                                    <td class="text-center">
                                        <a href="{{ route('aduan.publik.detail', $a->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye me-1"></i> Lihat Detail
                                        </a>
                                    </td>

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
