@extends('layouts.pic')

@section('title', 'SIPADU - Detail Tindak Lanjut')

@section('content')
<div class="container my-5">

    <!-- Tombol Kembali -->
    <a href="{{ route('pic.aduan.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>

    <!-- Judul Halaman -->
    <h2 class="fw-bold text-warning mb-4">
        <i class="bi bi-eye me-2"></i>Detail Tindak Lanjut Aduan
    </h2>

    <div class="row">
        <!-- =================== KIRI : INFORMASI ADUAN =================== -->
        <div class="col-md-8">

            <!-- Informasi Aduan -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">{{ $aduan->judul }}</h5>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Kategori:</strong></p>
                            <p>{{ $aduan->kategori }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Status Sekarang:</strong></p>
                            <span class="badge bg-success fs-6">
                                <i class="bi bi-check-circle-fill me-1"></i>{{ $tindakLanjutTerbaru->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <p class="mb-1"><strong>Deskripsi Aduan:</strong></p>
                    <div class="p-3 bg-light border rounded">
                        {{ $aduan->deskripsi }}
                    </div>
                </div>
            </div>

            <!-- Foto Bukti -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-images me-2"></i>Foto Bukti Aduan</h5>
                </div>

                <div class="card-body">
                    @php
                        $fotoBuktiArray = is_string($aduan->foto_bukti) ? json_decode($aduan->foto_bukti, true) : ($aduan->foto_bukti ?? []);
                    @endphp
                    @if(!empty($fotoBuktiArray) && count($fotoBuktiArray) > 0)
                        <div class="row g-3">
                            @foreach($fotoBuktiArray as $index => $foto)
                                <div class="col-md-6">
                                    <div class="card border">
                                        <img src="{{ $foto }}" alt="Foto Bukti {{ $index + 1 }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                                        <div class="card-footer bg-light">
                                            <small class="text-muted">Foto Bukti {{ $index + 1 }} dari {{ count($fotoBuktiArray) }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">
                            <i class="bi bi-exclamation-triangle me-2"></i>Foto bukti tidak tersedia
                        </div>
                    @endif
                </div>
            </div>

            <!-- Catatan Penyelesaian -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-check2-circle me-2"></i>Catatan Penyelesaian</h5>
                </div>

                <div class="card-body">
                    @if($tindakLanjutTerbaru->catatan_selesai)
                        <div class="p-3 bg-light border-start border-4 border-success rounded">
                            <strong class="text-success d-block mb-2">
                                Catatan Final:
                            </strong>
                            {{ $tindakLanjutTerbaru->catatan_selesai }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>Belum ada catatan penyelesaian final.
                        </div>

                        <a href="{{ route('pic.catatan.edit-selesai', $aduan->id) }}" 
                           class="btn btn-success btn-sm">
                            <i class="bi bi-plus-circle me-1"></i>Tambah Catatan Penyelesaian
                        </a>
                    @endif
                </div>
            </div>

        </div>

        <!-- =================== KANAN : RIWAYAT =================== -->
        <div class="col-md-4">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Tindak Lanjut</h5>
                </div>

                <div class="card-body">
                    @foreach($riwayatTindakLanjut as $tl)
                        <div class="mb-4 pb-3 border-bottom">

                            <!-- Status -->
                            <strong>
                                @if($tl->status === 'Sedang Dikerjakan')
                                    <i class="bi bi-gear-wide-connected text-warning me-1"></i> Sedang Dikerjakan
                                @else
                                    <i class="bi bi-check-circle-fill text-success me-1"></i> Selesai
                                @endif
                            </strong>

                            <div class="text-muted small mb-2">
                                {{ \Carbon\Carbon::parse($tl->created_at)->format('d M Y H:i') }}
                                @if($tl->updated_at != $tl->created_at)
                                    <br><em>Diperbarui: {{ \Carbon\Carbon::parse($tl->updated_at)->format('d M Y H:i') }}</em>
                                @endif
                            </div>

                            <!-- Catatan -->
                            <div class="p-2 bg-light border-start border-4 rounded"
                                 style="border-color: {{ $tl->status === 'Sedang Dikerjakan' ? '#ffc107' : '#28a745' }};">
                                {{ $tl->catatan }}

                                @if($tl->catatan_selesai)
                                    <hr class="my-2">
                                    <strong class="small text-muted">Catatan Penyelesaian:</strong>
                                    <p class="mb-0">{{ $tl->catatan_selesai }}</p>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
