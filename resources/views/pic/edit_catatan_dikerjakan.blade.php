@extends('layouts.pic')

@section('title', 'SIPADU - Edit Catatan Sedang Dikerjakan')

@section('content')

<!-- Hero Header -->
<section class="detail-hero position-relative text-dark mb-5">
    <div class="hero-overlay"></div>
    <div class="container position-relative py-5">
        <div class="text-center">
            <div class="hero-icon mx-auto mb-3" style="width: auto; padding: 20px;">
                <i class="bi bi-pencil-square"></i>
            </div>
            <h1 class="fw-bold mb-2">Edit Catatan Sedang Dikerjakan</h1>
            <p class="opacity-90">Perbarui catatan progres tindak lanjut aduan Anda.</p>
        </div>
    </div>
</section>

<div class="container mb-5">
    <div class="card shadow-lg border-0 mx-auto" style="max-width: 700px;">
        <div class="card-body p-4">
            {{-- Info Aduan --}}
            <div class="mb-4 border-start border-4 border-warning ps-3">
                <p class="mb-1"><strong>Judul:</strong> {{ $aduan->judul }}</p>
                <p class="mb-1"><strong>Kategori:</strong> {{ $aduan->kategori }}</p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('pic.catatan.update-dikerjakan', $aduan->id) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Catatan Sedang Dikerjakan</label>
                    <textarea name="catatan" class="form-control shadow-sm" rows="6" required>{{ $tindakLanjutTerbaru->catatan }}</textarea>
                    <small class="text-muted">Perbarui catatan progres tindak lanjut Anda.</small>
                </div>

                {{-- Info Waktu --}}
                <div class="mb-4 p-2 bg-light border rounded text-center text-muted small">
                    <p class="mb-1">
                        <strong>Dibuat pada:</strong> {{ \Carbon\Carbon::parse($tindakLanjutTerbaru->created_at)->format('d M Y H:i') }}
                    </p>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('pic.aduan.index') }}" class="btn btn-outline-secondary shadow-sm">
                        <i class="bi bi-arrow-left-circle me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-warning text-dark shadow-sm fw-semibold">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Hero Section - Changed from red to yellow */
    .detail-hero {
        background: linear-gradient(135deg, #ffca2c 0%, #ffc107 100%);
        position: relative;
        overflow: hidden;
    }

    .detail-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(20px); }
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.05);
        z-index: 1;
    }

    .detail-hero .container {
        z-index: 2;
    }

    .hero-icon {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
    }

    .card:hover {
        transform: translateY(-4px);
        transition: 0.3s ease;
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
    }

    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.3);
    }
</style>

@endsection
