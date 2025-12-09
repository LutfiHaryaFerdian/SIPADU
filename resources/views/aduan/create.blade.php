@extends('layouts.mahasiswa')

@section('title', 'SIPADU - Buat Aduan Baru')

@section('content')

<!-- Mahasiswa CSS -->
    <link rel="stylesheet" href="{{ asset('css/mahasiswa.css') }}">

<!-- Hero Header -->
<section class="aduan-hero position-relative text-white mb-5">
    <div class="hero-overlay"></div>
    <div class="container position-relative py-5">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-icon mb-3">
                    <i class="bi bi-megaphone-fill"></i>
                </div>
                <h1 class="fw-bold mb-3">Buat Aduan Baru</h1>
                <p class="fs-5 mb-0 opacity-90">
                    Sampaikan permasalahan Anda secara jelas dan lengkap agar dapat segera ditindaklanjuti oleh pihak terkait.
                </p>
            </div>
        </div>
    </div>
</section>

<div class="container mb-5">
    <div class="row justify-content-center">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg form-card">
                <div class="card-header bg-gradient-primary text-white border-0 py-4">
                    <div class="d-flex align-items-center">
                        <div class="header-icon me-3">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">Form Pengaduan Mahasiswa</h5>
                            <small class="opacity-75">Lengkapi semua informasi dengan benar</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('aduan.store') }}" enctype="multipart/form-data" id="aduanForm">
                        @csrf

                        <!-- Progress Indicator -->
                        <div class="progress-steps mb-5">
                            <div class="step active">
                                <div class="step-number">1</div>
                                <div class="step-label">Informasi</div>
                            </div>
                            <div class="step">
                                <div class="step-number">2</div>
                                <div class="step-label">Bukti</div>
                            </div>
                            <div class="step">
                                <div class="step-number">3</div>
                                <div class="step-label">Konfirmasi</div>
                            </div>
                        </div>

                        <!-- Judul Aduan -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-card-heading text-primary me-2"></i>Judul Aduan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="judul" 
                                   class="form-control form-control-lg" 
                                   placeholder="Contoh: Fasilitas AC Rusak di Ruang Kuliah E.1.01"
                                   required>
                            <small class="text-muted">Buat judul yang singkat dan jelas menggambarkan masalah</small>
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-tags text-primary me-2"></i>Kategori
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="kategori" 
                                   class="form-control form-control-lg" 
                                   placeholder="Contoh: Fasilitas, Akademik, Administrasi"
                                   required>
                            <small class="text-muted">Pilih kategori yang sesuai dengan jenis pengaduan</small>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-file-text text-primary me-2"></i>Deskripsi
                                <span class="text-danger">*</span>
                            </label>
                            
                            <!-- Alert Info Publik -->
                            <div class="alert alert-info border-0 bg-info bg-opacity-10 d-flex align-items-start mb-3">
                                <i class="bi bi-info-circle-fill text-info fs-5 me-3 mt-1"></i>
                                <div>
                                    <strong class="d-block mb-1">Informasi Penting:</strong>
                                    <small class="d-block text-dark">
                                        <strong>Deskripsi ini akan tampil untuk publik.</strong> 
                                        Jangan mencantumkan identitas pribadi atau informasi sensitif. 
                                        Gunakan <strong>Foto Bukti</strong> untuk melampirkan dokumen penting yang hanya dapat dilihat petugas.
                                    </small>
                                </div>
                            </div>

                            <textarea name="deskripsi" 
                                      rows="6" 
                                      class="form-control form-control-lg"
                                      placeholder="Jelaskan permasalahan secara detail: apa yang terjadi, kapan terjadi, di mana lokasinya, dan dampaknya..."
                                      required></textarea>
                            <small class="text-muted">Minimal 50 karakter untuk deskripsi yang jelas</small>
                        </div>

                        <!-- Divider -->
                        <hr class="my-5">

                        <h5 class="fw-bold mb-4 text-primary">
                            <i class="bi bi-images me-2"></i>Dokumen Pendukung
                        </h5>

                        <!-- Foto KTM -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-card-text text-info me-2"></i>Foto KTM (Kartu Tanda Mahasiswa)
                                <span class="text-danger">*</span>
                            </label>
                            <div class="upload-box">
                                <input type="file" 
                                       name="foto_ktm" 
                                       class="form-control d-none" 
                                       accept="image/*" 
                                       id="fotoKtm" 
                                       required>
                                <label for="fotoKtm" class="upload-label">
                                    <i class="bi bi-cloud-upload fs-1 text-primary mb-3"></i>
                                    <p class="mb-2 fw-semibold">Klik untuk upload foto KTM</p>
                                    <small class="text-muted">JPG, JPEG, PNG • Max 2MB</small>
                                </label>
                            </div>
                            <!-- Preview KTM -->
                            <div id="previewKtm" class="preview-container mt-3"></div>
                        </div>

                        <!-- Foto Bukti Aduan (Multiple) -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-camera text-success me-2"></i>Foto Bukti Aduan
                                <span class="text-danger">*</span>
                            </label>
                            <div class="upload-box">
                                <input type="file" 
                                       name="foto_bukti[]" 
                                       class="form-control d-none" 
                                       accept="image/*" 
                                       id="fotoBukti" 
                                       multiple 
                                       required>
                                <label for="fotoBukti" class="upload-label">
                                    <i class="bi bi-images fs-1 text-success mb-3"></i>
                                    <p class="mb-2 fw-semibold">Klik untuk upload foto bukti</p>
                                    <small class="text-muted">JPG, JPEG, PNG • Max 2MB per foto • Min 1, Max 5 foto</small>
                                </label>
                            </div>
                            <div id="fotoBuktiCount" class="mt-2"></div>
                            <!-- Preview Bukti -->
                            <div id="previewBukti" class="preview-container mt-3"></div>
                        </div>

                        <!-- Divider -->
                        <hr class="my-5">

                        <!-- Disclaimer / Pernyataan -->
                        <div class="disclaimer-card mb-4">
                            <div class="disclaimer-header">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>Pernyataan Tanggung Jawab</strong>
                            </div>
                            <div class="disclaimer-body">
                                <div class="disclaimer-scroll">
                                    <p class="mb-0">
                                        Saya dengan ini menyatakan bahwa dokumen foto/berkas yang telah saya kirimkan semuanya adalah <strong>benar dan dapat saya pertanggung-jawabkan</strong>. 
                                        Saya bersedia menerima <strong>sanksi bilamana saya terbukti melakukan pemalsuan dokumen</strong> (seperti tanda tangan, bukti palsu, dll) dengan ditunda seminar saya <strong>minimal 1 semester</strong> atau bahkan <strong>sanksi yang lebih berat hingga dikeluarkan (Drop Out)</strong>.
                                    </p>
                                </div>
                                <div class="form-check disclaimer-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="disclaimer" 
                                           id="disclaimer" 
                                           value="1" 
                                           required>
                                    <label class="form-check-label fw-semibold" for="disclaimer">
                                        Saya setuju dengan pernyataan di atas dan siap bertanggung jawab
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 justify-content-between align-items-center mt-5">
                            <a href="{{ route('aduan.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-send-fill me-2"></i>Kirim Aduan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <!-- Panduan -->
            <div class="card border-0 shadow-sm mb-4 info-card">
                <div class="card-header bg-primary text-white border-0 py-3">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-info-circle me-2"></i>Panduan Pengaduan
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="info-step">
                        <div class="info-step-number">1</div>
                        <div class="info-step-content">
                            <strong>Isi Data dengan Lengkap</strong>
                            <small>Pastikan judul, kategori, dan deskripsi jelas</small>
                        </div>
                    </div>
                    <div class="info-step">
                        <div class="info-step-number">2</div>
                        <div class="info-step-content">
                            <strong>Upload Bukti Pendukung</strong>
                            <small>Foto KTM dan bukti aduan yang valid</small>
                        </div>
                    </div>
                    <div class="info-step">
                        <div class="info-step-number">3</div>
                        <div class="info-step-content">
                            <strong>Baca & Setujui Pernyataan</strong>
                            <small>Pastikan semua data benar dan akurat</small>
                        </div>
                    </div>
                    <div class="info-step">
                        <div class="info-step-number">4</div>
                        <div class="info-step-content">
                            <strong>Kirim & Pantau Status</strong>
                            <small>Aduan akan diproses maksimal 3x24 jam</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="card border-0 shadow-sm bg-gradient-success text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-lightbulb-fill fs-1 me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-3">Tips Pengaduan Efektif</h6>
                            <ul class="small mb-0 ps-3">
                                <li class="mb-2">Gunakan bahasa yang sopan dan profesional</li>
                                <li class="mb-2">Sertakan lokasi dan waktu kejadian</li>
                                <li class="mb-2">Upload foto yang jelas dan relevan</li>
                                <li>Jangan sertakan data pribadi di deskripsi publik</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    /* ============================================================
    PREVIEW + DELETE FOTO KTM (single)
    ============================================================ */
    document.getElementById('fotoKtm').addEventListener('change', function () {
        const previewContainer = document.getElementById('previewKtm');
        previewContainer.innerHTML = '';

        const file = this.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            const imgDiv = document.createElement('div');
            imgDiv.classList.add('preview-item');

            imgDiv.innerHTML = `
                <img src="${e.target.result}">
                <div class="preview-label">${file.name}</div>
                <button type="button" class="delete-btn">&times;</button>
            `;

            // tombol hapus KTM
            imgDiv.querySelector('.delete-btn').onclick = function () {
                document.getElementById('fotoKtm').value = "";
                previewContainer.innerHTML = "";
            };

            previewContainer.appendChild(imgDiv);
        };

        reader.readAsDataURL(file);
    });


    /* ============================================================
    PREVIEW + DELETE FOTO BUKTI (multiple, max 5)
    ============================================================ */
    let fotoBuktiArray = [];

    document.getElementById('fotoBukti').addEventListener('change', function () {
        const max = 5;
        const newFiles = Array.from(this.files);

        if (fotoBuktiArray.length + newFiles.length > max) {
            alert("Maksimal upload 5 foto");
            this.value = "";
            return;
        }

        fotoBuktiArray = fotoBuktiArray.concat(newFiles);
        this.value = "";  // reset input

        renderBukti();
        syncBuktiInput();
    });

    function renderBukti() {
        const preview = document.getElementById('previewBukti');
        const count = document.getElementById('fotoBuktiCount');

        preview.innerHTML = "";
        count.textContent = `${fotoBuktiArray.length} foto terpilih`;

        fotoBuktiArray.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const div = document.createElement('div');
                div.classList.add('preview-item');

                div.innerHTML = `
                    <img src="${e.target.result}">
                    <div class="preview-label">${file.name}</div>
                    <button type="button" class="delete-btn">&times;</button>
                `;

                div.querySelector(".delete-btn").onclick = function () {
                    fotoBuktiArray.splice(index, 1);
                    renderBukti();
                    syncBuktiInput();
                };

                preview.appendChild(div);
            };

            reader.readAsDataURL(file);
        });
    }

    function syncBuktiInput() {
        const input = document.getElementById('fotoBukti');
        const dt = new DataTransfer();

        fotoBuktiArray.forEach(file => dt.items.add(file));
        input.files = dt.files; // wajib agar form bisa terkirim
    }
</script>




@endsection