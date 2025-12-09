@extends('layouts.pic')

@section('title', 'SIPADU - Edit Catatan Penyelesaian')

@section('content')

<!-- PIC CSS -->
    <link rel="stylesheet" href="{{ asset('css/pic.css') }}">

<!-- Hero Header -->
<section class="detail-hero position-relative text-dark mb-5">
    <div class="hero-overlay"></div>
    <div class="container position-relative py-5">
        <div class="text-center">
            <div class="hero-icon mx-auto mb-3" style="width: auto; padding: 20px;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h1 class="fw-bold mb-2">Edit Catatan Penyelesaian</h1>
            <p class="opacity-90">Catat ringkasan hasil penyelesaian aduan Anda.</p>
        </div>
    </div>
</section>

<div class="container mb-5">
    <div class="card shadow-lg border-0 mx-auto" style="max-width: 700px;">
        <div class="card-body p-4">
            {{-- Info Aduan --}}
            <div class="mb-4 border-start border-4 border-success ps-3">
                <p class="mb-1"><strong>Judul:</strong> {{ $aduan->judul }}</p>
                <p class="mb-1"><strong>Kategori:</strong> {{ $aduan->kategori }}</p>
                <p class="mb-1"><strong>Status:</strong> 
                    <span class="badge bg-success">{{ $tindakLanjutTerbaru->status }}</span>
                </p>
            </div>

            {{-- Warning Alert --}}
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <div class="d-flex align-items-start">
                    <i class="bi bi-exclamation-circle-fill me-2 mt-1" style="font-size: 1.2rem;"></i>
                    <div>
                        <strong>⚠️ Perhatian!</strong>
                        <p class="mb-0">Setelah catatan penyelesaian ini disimpan, <strong>catatan tidak bisa diubah lagi</strong> dan akan menjadi final. Pastikan informasi sudah benar sebelum menyimpan.</p>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('pic.catatan.update-selesai', $aduan->id) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Catatan Penyelesaian</label>
                    <textarea name="catatan_selesai" class="form-control shadow-sm" rows="6" required>{{ $tindakLanjutTerbaru->catatan_selesai }}</textarea>
                    <small class="text-muted">Tuliskan ringkasan hasil dan penyelesaian akhir dari aduan ini.</small>
                </div>

                {{-- Info Awal --}}
                <div class="mb-4 p-3 bg-light border-start border-4 border-warning rounded">
                    <h6 class="fw-semibold mb-2"><i class="bi bi-info-circle me-2"></i>Catatan Awal Pengerjaan</h6>
                    <div class="p-2 bg-white border rounded text-muted small">
                        {{ $tindakLanjutTerbaru->catatan }}
                    </div>
                </div>

                {{-- Info Waktu --}}
                <div class="mb-4 p-2 bg-light border rounded text-center text-muted small">
                    <p class="mb-1">
                        <strong>Dikerjakan sejak:</strong> {{ \Carbon\Carbon::parse($tindakLanjutTerbaru->created_at)->format('d M Y H:i') }}
                    </p>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('pic.tindaklanjut.view', $aduan->id) }}" class="btn btn-outline-secondary shadow-sm">
                        <i class="bi bi-arrow-left-circle me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success text-white shadow-sm fw-semibold">
                        <i class="bi bi-save me-1"></i> Simpan Penyelesaian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
