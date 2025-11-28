@extends('layouts.pic')

@section('title', 'SIPADU - Tindak Lanjut Aduan')

@section('content')
<div class="container my-5">

    <!-- Tombol Kembali + Header -->
    <div class="mb-4">
        <a href="{{ route('pic.aduan.index') }}" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold text-warning mb-1">
            <i class="bi bi-pencil-square me-2"></i> Tindak Lanjut Aduan
        </h2>
    </div>

    <div class="row">
        <!-- Kolom Kiri: Informasi Aduan + Foto -->
        <div class="col-md-8">

            <!-- Card Informasi Aduan -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-warning text-dark fw-semibold">
                    <h5 class="mb-0">{{ $aduan->judul }}</h5>
                </div>
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Kategori:</strong></p>
                            <p>{{ $aduan->kategori }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Status Saat Ini:</strong></p>
                            <span class="badge 
                                @if($aduan->status === 'Menunggu') bg-secondary
                                @elseif($aduan->status === 'Diproses') bg-warning text-dark
                                @else bg-success @endif fs-6">
                                {{ $aduan->status }}
                            </span>
                        </div>
                    </div>

                    <p class="mb-1"><strong>Deskripsi:</strong></p>
                    <div class="p-3 bg-light border rounded">
                        {{ $aduan->deskripsi }}
                    </div>
                </div>
            </div>

            <!-- Foto Bukti -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-info text-white fw-semibold">
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

            <!-- Catatan Tindak Lanjut Sebelumnya -->
            @if($tindakLanjutTerbaru)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-secondary text-white fw-semibold">
                        <h5 class="mb-0">Catatan Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-1"><strong>Status:</strong></p>
                        <span class="badge 
                            {{ $tindakLanjutTerbaru->status === 'Sedang Dikerjakan' ? 'bg-warning text-dark' : 'bg-success' }}">
                            {{ $tindakLanjutTerbaru->status }}
                        </span>

                        <hr>

                        <p class="mb-1"><strong>Catatan:</strong></p>
                        <div class="p-3 bg-light border rounded">
                            {{ $tindakLanjutTerbaru->catatan }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Kolom Kanan: Form Tindak Lanjut -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark fw-semibold">
                    <h5 class="mb-0">Form Tindak Lanjut</h5>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('pic.tindaklanjut.store', $aduan->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Catatan Progres</label>
                            <textarea name="catatan" class="form-control border-warning shadow-sm" rows="4"
                                      placeholder="Tuliskan progres pekerjaan..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" id="statusSelect" class="form-select border-warning shadow-sm" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="mb-3" id="catatanSelesaiDiv" style="display: none;">
                            <label class="form-label fw-semibold">Catatan Penyelesaian</label>
                            <textarea name="catatan_selesai" id="catatanSelesai" class="form-control border-success"
                                      rows="4" placeholder="Ringkasan penyelesaian..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-warning text-white w-100 fw-semibold shadow-sm">
                            <i class="bi bi-save me-1"></i> Simpan Tindak Lanjut
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('statusSelect').addEventListener('change', function() {
    const selesai = document.getElementById('catatanSelesaiDiv');
    const input = document.getElementById('catatanSelesai');

    if (this.value === 'Selesai') {
        selesai.style.display = 'block';
        input.required = true;
    } else {
        selesai.style.display = 'none';
        input.required = false;
    }
});
</script>

<style>
.card:hover {
    transition: 0.3s;
    box-shadow: 0 8px 20px rgba(255, 193, 7, 0.25);
}
</style>

@endsection
