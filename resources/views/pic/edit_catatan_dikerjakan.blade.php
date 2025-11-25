@extends('layouts.pic')

@section('title', 'Edit Catatan Sedang Dikerjakan')

@section('content')
<div class="container my-5">
    <div class="text-center mb-4">
        <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png"
             alt="Edit Catatan" class="img-fluid mb-3" style="max-height: 110px;">
        <h2 class="fw-bold text-warning mb-1">
            <i class="bi bi-pencil-square me-2"></i>Edit Catatan Sedang Dikerjakan
        </h2>
        <p class="text-muted">Perbarui catatan progres tindak lanjut aduan Anda.</p>
    </div>

    <div class="card shadow-lg border-0 mx-auto" style="max-width: 700px;">
        <div class="card-header bg-warning text-dark text-center fw-semibold">
            <i class="bi bi-clipboard-check me-2"></i>Edit Catatan
        </div>
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
                    <button type="submit" class="btn btn-warning text-white shadow-sm fw-semibold">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.card:hover {
    transform: translateY(-4px);
    transition: 0.3s ease;
    box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
}
.form-control:focus {
    border-color: #ffcd39;
    box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.3);
}
</style>
@endsection
