@extends('layouts.pic')

@section('title', 'SIPADU - Tindak Lanjut Aduan')

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

    <div class="card shadow-lg border-0 mx-auto" style="max-width: 700px;">
        <div class="card-header bg-warning text-dark text-center fw-semibold">
            <i class="bi bi-clipboard-check me-2"></i>Formulir Tindak Lanjut
        </div>
        <div class="card-body p-4">
            {{-- Info Aduan --}}
            <div class="mb-4 border-start border-4 border-warning ps-3">
                <p class="mb-1"><strong>Judul:</strong> {{ $aduan->judul }}</p>
                <p class="mb-1"><strong>Kategori:</strong> {{ $aduan->kategori }}</p>
            </div>

            {{-- Tampilkan catatan sebelumnya jika ada --}}
            @if($tindakLanjutTerbaru)
                <div class="mb-4 p-3 bg-light border-start border-4 border-info rounded">
                    <h6 class="fw-semibold mb-2"><i class="bi bi-info-circle me-2"></i>Catatan Terbaru</h6>
                    <p class="mb-1"><strong>Status:</strong> 
                        <span class="badge {{ $tindakLanjutTerbaru->status === 'Sedang Dikerjakan' ? 'bg-warning text-dark' : 'bg-success' }}">
                            {{ $tindakLanjutTerbaru->status }}
                        </span>
                    </p>
                    <p class="mb-2"><strong>Catatan:</strong></p>
                    <div class="p-2 bg-white border rounded">{{ $tindakLanjutTerbaru->catatan }}</div>
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('pic.tindaklanjut.store', $aduan->id) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Catatan Tindak Lanjut Sedang Dikerjakan</label>
                    <textarea name="catatan" class="form-control shadow-sm" rows="4" 
                              placeholder="Tuliskan progres atau hasil tindak lanjut saat ini..." required></textarea>
                    <small class="text-muted">Catatan ini masih dapat diubah sebelum menandai selesai.</small>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select shadow-sm" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                {{-- Catatan Selesai hanya jika memilih Selesai --}}
                <div class="mb-4" id="catatanSelesaiDiv" style="display: none;">
                    <label class="form-label fw-semibold">Catatan Penyelesaian</label>
                    <textarea id="catatanSelesai" name="catatan_selesai" class="form-control shadow-sm" rows="4" 
                              placeholder="Tuliskan ringkasan hasil penyelesaian..."></textarea>
                    <small class="text-muted">Catatan ini akan disimpan setelah status diubah menjadi selesai.</small>
                </div>

                @if($aduan->foto_url)
                <div class="mb-3 text-center">
                    <img src="{{ $aduan->foto_url }}" 
                        class="img-fluid rounded shadow"
                        style="max-height: 250px;">
                </div>
                @endif

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

<script>
document.querySelector('select[name="status"]').addEventListener('change', function() {
    const catatanSelesaiDiv = document.getElementById('catatanSelesaiDiv');
    if (this.value === 'Selesai') {
        catatanSelesaiDiv.style.display = 'block';
        document.getElementById('catatanSelesai').required = true;
    } else {
        catatanSelesaiDiv.style.display = 'none';
        document.getElementById('catatanSelesai').required = false;
    }
});
</script>

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
