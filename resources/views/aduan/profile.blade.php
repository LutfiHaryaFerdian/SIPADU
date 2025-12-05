@extends('layouts.mahasiswa')

@section('title', 'SIPADU - Profil Mahasiswa')

@section('content')

<!-- Hero Header -->
<section class="profile-hero position-relative text-white mb-5">
    <div class="hero-overlay"></div>
    <div class="container position-relative py-5">
        <div class="row align-items-center">
            <div class="col-auto">
                <div class="profile-avatar-large">
                    <img id="previewImageLarge"
                         src="{{ $mahasiswa?->foto_profile ? $mahasiswa->foto_profile : 'https://cdn-icons-png.flaticon.com/512/847/847969.png' }}"
                         alt="Profile">
                </div>
            </div>
            <div class="col">
                <h1 class="fw-bold mb-2">{{ $mahasiswa->nama }}</h1>
                <p class="mb-1 fs-5">{{ $mahasiswa->npm }}</p>
                <p class="mb-0 opacity-75"><i class="bi bi-mortarboard-fill me-2"></i>{{ $mahasiswa->prodi ?? 'Belum diisi' }}</p>
            </div>
        </div>
    </div>
</section>

<div class="container mb-5">
    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                <div>
                    <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Form Profil -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-person-fill-gear me-2 text-primary"></i>Edit Profil
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('mahasiswa.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Upload Foto -->
                        <div class="mb-4 text-center pb-4 border-bottom">
                            <label class="form-label fw-semibold d-block mb-3">Foto Profil</label>
                            <div class="profile-upload-wrapper">
                                <img id="previewImage"
                                     src="{{ $mahasiswa?->foto_profile ? $mahasiswa->foto_profile : 'https://cdn-icons-png.flaticon.com/512/847/847969.png' }}"
                                     class="profile-avatar-preview mb-3">
                                <div>
                                    <label class="btn btn-primary btn-upload">
                                        <i class="bi bi-camera-fill me-2"></i>Ganti Foto
                                        <input type="file"
                                               name="foto_profile"
                                               id="fotoInput"
                                               class="d-none"
                                               accept="image/*">
                                    </label>
                                    <p class="text-muted small mt-2 mb-0">
                                        <i class="bi bi-info-circle me-1"></i>Format: JPG, PNG (Max 2MB)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <!-- Nama Lengkap -->
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-person me-2 text-primary"></i>Nama Lengkap
                                </label>
                                <input type="text" 
                                       name="nama" 
                                       value="{{ $mahasiswa->nama }}"
                                       class="form-control form-control-lg"
                                       placeholder="Masukkan nama lengkap"
                                       required>
                            </div>

                            <!-- NPM -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-card-text me-2 text-primary"></i>NPM
                                </label>
                                <input type="text" 
                                       name="npm" 
                                       value="{{ $mahasiswa->npm }}"
                                       class="form-control form-control-lg"
                                       placeholder="Masukkan NPM"
                                       required>
                            </div>

                            <!-- No HP -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-telephone me-2 text-primary"></i>No HP
                                </label>
                                <input type="text" 
                                       name="no_hp" 
                                       value="{{ $mahasiswa->no_hp }}"
                                       class="form-control form-control-lg"
                                       placeholder="08xxxxxxxxxx">
                            </div>

                            <!-- Prodi -->
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-mortarboard me-2 text-primary"></i>Program Studi
                                </label>
                                <input type="text" 
                                       name="prodi" 
                                       value="{{ $mahasiswa->prodi }}"
                                       class="form-control form-control-lg"
                                       placeholder="Contoh: Teknik Informatika">
                            </div>

                            <!-- Alamat -->
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-geo-alt me-2 text-primary"></i>Alamat
                                </label>
                                <textarea name="alamat" 
                                          class="form-control form-control-lg" 
                                          rows="4"
                                          placeholder="Masukkan alamat lengkap">{{ $mahasiswa->alamat }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4 d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-secondary btn-lg px-4">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card Keamanan -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-shield-lock me-2 text-danger"></i>Keamanan Akun
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="security-item">
                        <div class="d-flex align-items-start">
                            <div class="security-icon">
                                <i class="bi bi-key-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-semibold">Password</h6>
                                <p class="text-muted mb-3 small">
                                    Ubah password Anda secara berkala untuk menjaga keamanan akun
                                </p>
                                <a href="{{ route('forgot.email') }}" class="btn btn-outline-danger">
                                    <i class="bi bi-key me-2"></i>Ganti Password
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning border-0 mt-4 mb-0 d-flex align-items-start">
                        <i class="bi bi-exclamation-triangle-fill fs-5 me-3 flex-shrink-0"></i>
                        <div class="small">
                            <strong>Tips Keamanan:</strong>
                            <ul class="mb-0 mt-2 ps-3">
                                <li>Gunakan password yang kuat (minimal 8 karakter)</li>
                                <li>Kombinasikan huruf besar, kecil, angka, dan simbol</li>
                                <li>Jangan gunakan password yang sama dengan akun lain</li>
                                <li>Ganti password secara berkala</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-lg-4">
            <!-- Account Info -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white border-0 py-3">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-shield-check me-2"></i>Informasi Akun
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="info-item">
                        <div class="info-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="info-content">
                            <small class="text-muted">Terdaftar Sejak</small>
                            <p class="mb-0 fw-semibold">{{ $mahasiswa->created_at ? $mahasiswa->created_at->format('d M Y') : '-' }}</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <div class="info-content">
                            <small class="text-muted">Status</small>
                            <p class="mb-0 fw-semibold">
                                <span class="badge bg-success">Aktif</span>
                            </p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon bg-info bg-opacity-10 text-info">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="info-content">
                            <small class="text-muted">Email</small>
                            <p class="mb-0 fw-semibold small">{{ $mahasiswa->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-lightbulb-fill fs-1 me-3 flex-shrink-0"></i>
                        <div>
                            <h6 class="fw-bold mb-2">Tips Profil</h6>
                            <ul class="small mb-0 ps-3">
                                <li class="mb-1">Gunakan foto profil yang jelas</li>
                                <li class="mb-1">Lengkapi semua informasi</li>
                                <li class="mb-1">Update data secara berkala</li>
                                <li>Jaga keamanan password Anda</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-hero {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        position: relative;
        overflow: hidden;
    }

    .profile-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .profile-hero .container {
        z-index: 2;
    }

    .profile-avatar-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.3);
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .profile-avatar-large img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-avatar-preview {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #f8f9fa;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .profile-avatar-preview:hover {
        transform: scale(1.05);
    }

    .btn-upload {
        border-radius: 50px;
        padding: 10px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-upload:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(2, 132, 199, 0.3);
    }

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

    .form-label {
        margin-bottom: 8px;
        color: #495057;
    }

    .card {
        border-radius: 16px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: 2px solid #f8f9fa;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
    }

    .info-item {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f8f9fa;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        font-size: 20px;
        flex-shrink: 0;
    }

    .info-content {
        flex: 1;
    }

    /* Security Section Styles */
    .security-item {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .security-item:hover {
        background: #e9ecef;
        transform: translateY(-2px);
    }

    .security-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        margin-right: 20px;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .btn-outline-danger {
        border: 2px solid #dc3545;
        color: #dc3545;
        font-weight: 600;
        border-radius: 10px;
        padding: 10px 24px;
        transition: all 0.3s ease;
    }

    .btn-outline-danger:hover {
        background: #dc3545;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(220, 53, 69, 0.3);
    }

    .alert {
        border-radius: 12px;
    }

    .alert-warning {
        background: #fff3cd;
        color: #856404;
    }

    .btn {
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .btn-primary {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        border: none;
    }

    .btn-primary:hover {
        box-shadow: 0 6px 20px rgba(2, 132, 199, 0.4);
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-avatar-large {
            width: 90px;
            height: 90px;
        }

        .profile-avatar-preview {
            width: 120px;
            height: 120px;
        }

        .security-icon {
            width: 48px;
            height: 48px;
            font-size: 1.25rem;
            margin-right: 15px;
        }
    }
</style>

{{-- Script Preview Foto --}}
<script>
    const fotoInput = document.getElementById('fotoInput');
    const previewImage = document.getElementById('previewImage');
    const previewImageLarge = document.getElementById('previewImageLarge');

    fotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Validasi ukuran file (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                this.value = '';
                return;
            }

            // Validasi tipe file
            if (!file.type.match('image.*')) {
                alert('File harus berupa gambar!');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            
            reader.onload = function(event) {
                previewImage.src = event.target.result;
                previewImageLarge.src = event.target.result;
            };
            
            reader.readAsDataURL(file);
        }
    });

    // Smooth scroll untuk alert
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.add('show');
            }, 100);
        });
    });
</script>

@endsection