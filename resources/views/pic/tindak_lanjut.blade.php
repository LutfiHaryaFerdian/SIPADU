@extends('layouts.pic')

@section('title', 'Tindak Lanjut Aduan')

@section('content')
<div class="container my-5">
    <div class="text-center mb-4">
        <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png"
             alt="Tindak Lanjut" class="img-fluid mb-3" style="max-height: 110px;">
        <h2 class="fw-bold text-warning mb-1">
            <i class="bi bi-pencil-square me-2"></i>Tindak Lanjut Aduan
        </h2>
        <p class="text-muted">Catat progres dan ubah status penyelesaian aduan mahasiswa.</p>
    </div>

    <div class="card shadow-lg border-0 mx-auto" style="max-width: 650px;">
        <div class="card-header bg-warning text-dark text-center fw-semibold">
            <i class="bi bi-clipboard-check me-2"></i>Formulir Tindak Lanjut
        </div>
        <div class="card-body p-4">
            {{-- Info Aduan --}}
            <div class="mb-4 border-start border-4 border-warning ps-3">
                <p class="mb-1"><strong>Judul:</strong> {{ $aduan->judul }}</p>
                <p class="mb-1"><strong>Kategori:</strong> {{ $aduan->kategori }}</p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('pic.tindaklanjut.store', $aduan->id) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Catatan Tindak Lanjut</label>
                    <textarea name="catatan" class="form-control shadow-sm" rows="5" 
                              placeholder="Tuliskan hasil atau progres tindak lanjut..." required></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select shadow-sm" required>
                        <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('pic.aduan.index') }}" class="btn btn-outline-secondary shadow-sm">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-warning text-white shadow-sm fw-semibold">
                        <i class="bi bi-save me-1"></i> Simpan
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
.form-control:focus, .form-select:focus {
    border-color: #ffcd39;
    box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.3);
}
</style>
@endsection
