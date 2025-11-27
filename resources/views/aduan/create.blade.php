@extends('layouts.mahasiswa')

@section('title', 'Buat Aduan Baru')

@section('content')
<div class="container my-5">
    <!-- Hero Section -->
    <div class="text-center mb-5">
        <img src="https://cdn-icons-png.flaticon.com/512/3588/3588700.png" 
             alt="Buat Aduan" class="img-fluid mb-3" style="max-height: 120px;">
        <h2 class="fw-bold text-primary">Buat Aduan Baru</h2>
        <p class="text-muted">Sampaikan permasalahan Anda secara jelas agar dapat segera ditindaklanjuti.</p>
    </div>

    <!-- Form Aduan -->
    <div class="card shadow-lg border-0 mx-auto" style="max-width: 720px;">
        <div class="card-header bg-primary text-white text-center fw-semibold">
            <i class="bi bi-pencil-square me-2"></i> Form Pengaduan Mahasiswa
        </div>
        <div class="card-body p-4">
                <form method="POST" action="{{ route('aduan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Aduan</label>
                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul aduan..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori</label>
                    <input type="text" name="kategori" class="form-control" placeholder="Masukkan kategori aduan..." required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" rows="5" class="form-control" placeholder="Tuliskan deskripsi lengkap aduan Anda..." required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Bukti Foto (opsional)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('aduan.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-send-fill me-1"></i> Kirim Aduan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
