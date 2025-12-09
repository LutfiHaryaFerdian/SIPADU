@extends('layouts.mahasiswa')

@section('title', 'SIPADU - Profil Mahasiswa')

@section('content')

<!-- Mahasiswa CSS -->
    <link rel="stylesheet" href="{{ asset('css/mahasiswa.css') }}">

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