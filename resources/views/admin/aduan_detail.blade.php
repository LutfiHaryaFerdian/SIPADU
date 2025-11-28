@extends('layouts.admin')

@section('title', 'SIPADU - Detail Aduan')

@section('content')
<div class="container my-5">
    <!-- Header -->
    <div class="mb-4">
        <a href="{{ route('admin.aduan.index') }}" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold text-danger mb-1">
            <i class="bi bi-chat-left-text me-2"></i>Detail Aduan
        </h2>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Kolom Kiri: Informasi Aduan & Foto -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">{{ $aduan->judul }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Nomor Tiket:</strong></p>
                            <p class="text-monospace text-success">{{ $aduan->nomor_tiket }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Kategori:</strong></p>
                            <p>{{ $aduan->kategori }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Pelapor:</strong></p>
                            <p>{{ $aduan->nama_mahasiswa }}<br><small class="text-muted">NPM: {{ $aduan->npm }}</small></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Email:</strong></p>
                            <p>{{ $aduan->email }}</p>
                        </div>
                    </div>
                    <hr>
                    <p class="mb-1"><strong>Deskripsi:</strong></p>
                    <div class="p-3 bg-light border rounded">
                        {{ $aduan->deskripsi }}
                    </div>
                </div>
            </div>

            <!-- Foto KTM -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-image me-2"></i>Foto KTM</h5>
                </div>
                <div class="card-body">
                    @if($aduan->foto_ktm)
                        <img src="{{ $aduan->foto_ktm }}" alt="Foto KTM" class="img-fluid rounded" style="max-height: 400px; object-fit: contain;">
                    @else
                        <div class="alert alert-warning mb-0">
                            <i class="bi bi-exclamation-triangle me-2"></i>Foto KTM tidak tersedia
                        </div>
                    @endif
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
        </div>

        <!-- Kolom Kanan: Validasi & Penugasan -->
        <div class="col-md-4">
            <!-- Status Aduan -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Status Aduan</h5>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Status Proses:</strong></p>
                    <div class="mb-3">
                        @if($aduan->status === 'Menunggu')
                            <span class="badge bg-secondary fs-6">
                                <i class="bi bi-hourglass me-1"></i>Menunggu
                            </span>
                        @elseif($aduan->status === 'Diproses')
                            <span class="badge bg-warning text-dark fs-6">
                                <i class="bi bi-gear-fill me-1"></i>Diproses
                            </span>
                        @else
                            <span class="badge bg-success fs-6">
                                <i class="bi bi-check-circle-fill me-1"></i>Selesai
                            </span>
                        @endif
                    </div>

                    <p class="mb-2"><strong>Validasi Admin:</strong></p>
                    <div>
                        @if($aduan->status_validasi === null)
                            <span class="badge bg-dark fs-6">
                                <i class="bi bi-question-circle me-1"></i>Belum Divalidasi
                            </span>
                        @elseif($aduan->status_validasi === 'Valid')
                            <span class="badge bg-success fs-6">
                                <i class="bi bi-check-circle-fill me-1"></i>Valid
                            </span>
                        @else
                            <span class="badge bg-danger fs-6">
                                <i class="bi bi-x-circle-fill me-1"></i>Tidak Valid
                            </span>
                        @endif
                    </div>

                    @if($aduan->catatan_admin)
                        <hr>
                        <p class="mb-2"><strong>Catatan Admin:</strong></p>
                        <div class="p-3 bg-light border rounded small">
                            {{ $aduan->catatan_admin }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Validasi Form (hanya jika belum divalidasi) -->
            @if($aduan->status_validasi === null)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Validasi Aduan</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="valid-tab" data-bs-toggle="tab" data-bs-target="#valid" type="button" role="tab">
                                    <i class="bi bi-check-circle me-1"></i>Valid
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reject-tab" data-bs-toggle="tab" data-bs-target="#reject" type="button" role="tab">
                                    <i class="bi bi-x-circle me-1"></i>Tidak Valid
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- Tab Valid -->
                            <div class="tab-pane fade show active" id="valid" role="tabpanel">
                                <form action="{{ route('admin.aduan.validate', $aduan->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="catatanValid" class="form-label">Catatan Validasi <span class="text-danger">*</span></label>
                                        <textarea name="catatan_admin" id="catatanValid" class="form-control border-success" rows="6" placeholder="Jelaskan alasan mengapa aduan ini VALID..." required></textarea>
                                        <small class="text-muted">Catatan akan ditampilkan kepada pelapor</small>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="bi bi-check-circle me-1"></i> Validasi Sebagai Valid
                                    </button>
                                </form>
                            </div>

                            <!-- Tab Tidak Valid -->
                            <div class="tab-pane fade" id="reject" role="tabpanel">
                                <form action="{{ route('admin.aduan.reject', $aduan->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="catatanReject" class="form-label">Catatan Penolakan <span class="text-danger">*</span></label>
                                        <textarea name="catatan_admin" id="catatanReject" class="form-control border-danger" rows="6" placeholder="Jelaskan alasan mengapa aduan ini TIDAK VALID..." required></textarea>
                                        <small class="text-muted">Catatan akan ditampilkan kepada pelapor</small>
                                    </div>
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="bi bi-x-circle me-1"></i> Tolak Aduan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Assign to PIC (hanya jika sudah Valid) -->
            @if($aduan->status_validasi === 'Valid' && $aduan->status === 'Menunggu')
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Tugaskan ke PIC</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.aduan.assign', $aduan->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="idPic" class="form-label">Pilih PIC Unit <span class="text-danger">*</span></label>
                                <select name="id_pic" id="idPic" class="form-select border-primary" required>
                                    <option value="">-- Pilih PIC Unit --</option>
                                    @foreach($picUnits as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_unit }} - {{ $p->nama_pic }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan (Opsional)</label>
                                <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Catatan tambahan untuk PIC..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-send-fill me-1"></i> Tugaskan ke PIC
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            <!-- Mark as Done (hanya jika Diproses) -->
            @if($aduan->status === 'Diproses')
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <form action="{{ route('admin.aduan.done', $aduan->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-check2-circle me-1"></i> Tandai Selesai
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.card:hover {
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1) !important;
    transition: all 0.3s ease-in-out;
}
.text-monospace {
    font-family: 'Courier New', monospace;
}
</style>
@endsection
