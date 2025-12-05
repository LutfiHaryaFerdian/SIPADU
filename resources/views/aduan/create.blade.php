@extends('layouts.mahasiswa')

@section('title', 'SIPADU - Buat Aduan Baru')

@section('content')

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

<style>
    .aduan-hero {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        position: relative;
        overflow: hidden;
    }

    .aduan-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .aduan-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        right: -5%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.1);
        z-index: 1;
    }

    .aduan-hero .container {
        z-index: 2;
    }

    .hero-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        font-size: 2rem;
    }

    .form-card {
        border-radius: 20px;
        overflow: hidden;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    .header-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        font-size: 1.5rem;
    }

    /* Progress Steps */
    .progress-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        padding: 0 30px;
    }

    .progress-steps::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 30px;
        right: 30px;
        height: 2px;
        background: #e9ecef;
        z-index: 0;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e9ecef;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }

    .step.active .step-number {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(2, 132, 199, 0.4);
    }

    .step-label {
        font-size: 0.85rem;
        color: #6c757d;
        font-weight: 600;
    }

    .step.active .step-label {
        color: #0284c7;
    }

    /* Form Controls */
    .form-control, .form-control-lg {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 12px 16px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-control-lg:focus {
        border-color: #0284c7;
        box-shadow: 0 0 0 0.2rem rgba(2, 132, 199, 0.15);
    }

    textarea.form-control {
        resize: none;
    }

    /* Upload Box */
    .upload-box {
        border: 3px dashed #dee2e6;
        border-radius: 16px;
        padding: 40px;
        text-align: center;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .upload-box:hover {
        border-color: #0284c7;
        background: #f0f5ff;
    }

    .upload-label {
        cursor: pointer;
        margin: 0;
        display: block;
    }

    .upload-label:hover i {
        transform: translateY(-5px);
    }

    .upload-label i {
        transition: transform 0.3s ease;
    }

    /* Preview Container */
    .preview-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
    }

    .preview-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .preview-item:hover {
        transform: translateY(-5px);
    }

    .preview-item img {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .preview-label {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 8px;
        font-size: 0.75rem;
        text-align: center;
    }

    /* Disclaimer Card */
    .disclaimer-card {
        border-radius: 16px;
        overflow: hidden;
        border: 3px solid #ffc107;
        background: #fff3cd;
    }

    .disclaimer-header {
        background: #ffc107;
        color: #000;
        padding: 16px 20px;
        font-size: 1.1rem;
    }

    .disclaimer-body {
        padding: 20px;
        background: white;
    }

    .disclaimer-scroll {
        max-height: 180px;
        overflow-y: auto;
        margin-bottom: 16px;
    }

    .disclaimer-check {
        margin-top: 12px;
    }

    .disclaimer-check .form-check-input {
        width: 1.25em;
        height: 1.25em;
        margin-top: 0.25em;
    }

    .disclaimer-check .form-check-input:checked {
        background-color: #0284c7;
        border-color: #0284c7;
    }

    /* Info Steps */
    .info-step {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .info-step:last-child {
        margin-bottom: 0;
    }

    .info-step-number {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        color: white;
        border-radius: 50%;
        font-weight: bold;
        margin-right: 16px;
        flex-shrink: 0;
    }

    .info-step-content {
        flex: 1;
    }

    .info-step-content strong {
        display: block;
        font-size: 0.95rem;
        color: #212529;
        margin-bottom: 4px;
    }

    .info-step-content small {
        display: block;
        font-size: 0.85rem;
        color: #6c757d;
    }

    .preview-item {
        position: relative;
        display: inline-block;
        margin: 10px;
        border-radius: 14px;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        cursor: pointer;
    }

    .preview-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.18);
    }

    .preview-item img {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 14px;
        display: block;
    }

    /* Delete Button Modern */
    .delete-btn {
        position: absolute;
        top: 6px;
        right: 6px;
        width: 30px;
        height: 30px;
        border: none;
        border-radius: 50%;

        /* Glass effect */
        backdrop-filter: blur(6px);
        background: rgba(0, 0, 0, 0.45);

        color: #fff;
        font-size: 18px;
        line-height: 30px;
        text-align: center;
        cursor: pointer;

        display: flex;
        align-items: center;
        justify-content: center;

        opacity: 0;
        transform: scale(0.8);
        transition: opacity 0.25s ease, transform 0.25s ease;
    }

    /* Button muncul hanya saat hover */
    .preview-item:hover .delete-btn {
        opacity: 1;
        transform: scale(1);
    }

    /* Hover effect delete */
    .delete-btn:hover {
        background: rgba(255, 0, 0, 0.8);
    }



    /* Responsive */
    @media (max-width: 768px) {
        .progress-steps {
            padding: 0 15px;
        }

        .progress-steps::before {
            left: 15px;
            right: 15px;
        }

        .step-number {
            width: 36px;
            height: 36px;
            font-size: 0.9rem;
        }

        .upload-box {
            padding: 30px 20px;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-body p-md-5 {
            padding: 1.5rem;
        }
    }
</style>

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