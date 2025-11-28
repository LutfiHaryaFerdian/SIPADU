@extends('layouts.mahasiswa')

@section('title', 'SIPADU - Buat Aduan Baru')

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
                <form method="POST" action="{{ route('aduan.store') }}" enctype="multipart/form-data" id="aduanForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Aduan</label><span class="text-danger"> *</span>
                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul aduan..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori</label><span class="text-danger"> *</span>
                    <input type="text" name="kategori" class="form-control" placeholder="Masukkan kategori aduan..." required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi</label><span class="text-danger"> *</span>
                <label for="deskripsi" class="form-label">
    <strong style="color:#d00;">Perhatian:</strong> 
    <strong>Deskripsi aduan akan tampil untuk publik.</strong> 
    Jangan tuliskan identitas pribadi atau informasi sensitif. 
    Jika ada data penting untuk verifikasi (seperti identitas, kontak, atau bukti detail), 
    silakan lampirkan melalui <strong>Foto Bukti</strong> yang hanya dapat dilihat petugas.
</label>

<textarea name="deskripsi" rows="5" class="form-control"
    placeholder="Tuliskan deskripsi aduan secara jelas..."
    required></textarea></div>

                <!-- Foto KTM -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-card-text text-info"></i> Foto KTM 
                        <span class="text-danger">*</span>
                    </label>
                    <input type="file" name="foto_ktm" class="form-control" accept="image/*" id="fotoKtm" required>
                    <small class="text-muted">Format: JPG, JPEG, PNG | Maksimal: 2MB | Hanya bisa upload 1 foto</small>
                    <!-- Preview KTM -->
                    <div id="previewKtm" class="mt-2"></div>
                </div>

                <!-- Foto Bukti Aduan (Multiple) -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-image text-success"></i> Foto Bukti Aduan 
                        <span class="text-danger">*</span>
                    </label>
                    <input type="file" name="foto_bukti[]" class="form-control" accept="image/*" id="fotoBukti" multiple required>
                    <small class="text-muted">Format: JPG, JPEG, PNG | Maksimal: 2MB per foto | Minimal 1 foto, Maksimal 5 foto</small>
                    <div id="fotoBuktiCount" class="mt-1 text-sm text-muted"></div>
                    <!-- Preview Bukti -->
                    <div id="previewBukti" class="mt-2"></div>
                </div>

                <!-- Disclaimer / Pernyataan -->
                <div class="alert alert-warning border-2 border-warning p-3 mb-4">
                    <h6 class="fw-semibold mb-3">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Pernyataan Tanggung Jawab
                    </h6>
                    <div class="bg-white p-3 rounded mb-3" style="max-height: 200px; overflow-y: auto; border: 1px solid #dee2e6;">
                        <p class="mb-0 text-dark" style="font-size: 0.95rem; line-height: 1.6;">
                            Saya dengan ini menyatakan bahwa dokumen foto/berkas yang telah saya kirimkan semuanya adalah <strong>benar dan dapat saya pertanggung-jawabkan</strong>. 
                            Saya bersedia menerima <strong>sanksi bilamana saya terbukti melakukan pemalsuan dokumen</strong> (seperti tanda tangan, bukti palsu, dll) dengan ditunda seminar saya <strong>minimal 1 semester</strong> atau bahkan <strong>sanksi yang lebih berat hingga dikeluarkan (Drop Out)</strong>.
                        </p>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="disclaimer" id="disclaimer" value="1" required>
                        <label class="form-check-label" for="disclaimer">
                            Saya setuju dengan pernyataan di atas dan siap bertanggung jawab
                        </label>
                    </div>
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

<script>
// Preview foto KTM
document.getElementById('fotoKtm').addEventListener('change', function(e) {
    const previewDiv = document.getElementById('previewKtm');
    const file = e.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            previewDiv.innerHTML = `
                <div class="position-relative d-inline-block">
                    <img src="${event.target.result}" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                    <small class="d-block text-muted mt-1">Foto KTM - ${file.name}</small>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    } else {
        previewDiv.innerHTML = '';
    }
});

// Preview foto Bukti (Multiple)
document.getElementById('fotoBukti').addEventListener('change', function(e) {
    const previewDiv = document.getElementById('previewBukti');
    const countDiv = document.getElementById('fotoBuktiCount');
    const files = e.target.files;
    
    // Validasi jumlah foto
    if (files.length > 5) {
        alert('Maksimal 5 foto bukti aduan!');
        this.value = '';
        previewDiv.innerHTML = '';
        countDiv.innerHTML = '';
        return;
    }

    countDiv.innerHTML = `<strong>${files.length}</strong> foto bukti dipilih`;
    
    let html = '<div class="row g-2 mt-1">';
    for (let i = 0; i < files.length; i++) {
        const reader = new FileReader();
        reader.onload = function(event) {
            html += `
                <div class="col-3">
                    <div class="position-relative">
                        <img src="${event.target.result}" class="img-thumbnail w-100" style="height: 100px; object-fit: cover;">
                        <small class="d-block text-muted text-center mt-1" style="font-size: 0.75rem;">Foto ${i + 1}</small>
                    </div>
                </div>
            `;
            if (i === files.length - 1) {
                html += '</div>';
                previewDiv.innerHTML = html;
            }
        };
        reader.readAsDataURL(files[i]);
    }
});
</script>

@endsection

