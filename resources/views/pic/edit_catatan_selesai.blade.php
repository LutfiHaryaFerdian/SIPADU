@extends('layouts.pic')

@section('title', 'Edit Catatan Penyelesaian')

@section('content')
<div class="container my-5">
    <div class="text-center mb-4">
        <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png"
             alt="Edit Catatan" class="img-fluid mb-3" style="max-height: 110px;">
        <h2 class="fw-bold text-success mb-1">
            <i class="bi bi-pencil-square me-2"></i>Edit Catatan Penyelesaian
        </h2>
        <p class="text-muted">Catat ringkasan hasil penyelesaian aduan Anda.</p>
    </div>

    <div class="card shadow-lg border-0 mx-auto" style="max-width: 700px;">
        <div class="card-header bg-success text-white text-center fw-semibold">
            <i class="bi bi-check-circle-fill me-2"></i>Catatan Penyelesaian
        </div>
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

<style>
.card:hover {
    transform: translateY(-4px);
    transition: 0.3s ease;
    box-shadow: 0 8px 20px rgba(0, 128, 0, 0.3);
}
.form-control:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.3);
}
.alert-danger {
    border-left: 4px solid #dc3545;
}
</style>
@endsection
