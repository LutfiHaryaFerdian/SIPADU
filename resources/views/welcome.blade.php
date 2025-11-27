<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPADU - Sistem Pengaduan Mahasiswa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e8f5e9, #f8fff8);
            color: #333;
        }

        .navbar {
            background: linear-gradient(to right, #0f5132, #198754);
        }

        .hero {
            min-height: 100vh;
            background: url('{{ asset("images/unilahd.jpg") }}') center/cover no-repeat;
            position: relative;
        }
        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(15, 81, 50, 0.6);
        }
        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
        }

        .role-card {
            transition: all 0.35s ease;
            border-radius: 16px;
            overflow: hidden;
        }
        .role-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .role-card img {
            height: 140px;
            object-fit: cover;
            border-bottom: 4px solid #0d6efd;
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <!-- 🔹 Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="/">
                <i class="bi bi-mortarboard-fill me-2"></i>SIPADU
            </a>
            <div>
                <a href="#login" class="btn btn-outline-light rounded-pill px-3">
                    <i class="bi bi-box-arrow-in-right me-1"></i>Login
                </a>
            </div>
        </div>
    </nav>

    <!-- 🔹 Hero Section -->
    <section class="hero d-flex align-items-center text-center">
        <div class="container hero-content fade-in">
            <h1 class="display-4 fw-bold mb-3">Selamat Datang di <span class="text-warning">SIPADU</span></h1>
            <p class="lead mb-5 text-light">
                Sistem Informasi Pengaduan Mahasiswa Universitas Lampung.<br>
                Sampaikan aspirasi, aduan, dan keluhan Anda secara cepat, mudah, dan transparan.
            </p>

            <a href="#login" class="btn btn-light btn-lg rounded-pill shadow-sm px-4 py-2">
                <i class="bi bi-arrow-down-circle me-2"></i>Mulai Sekarang
            </a>
        </div>
    </section>

    <!-- 🔹 Login Section -->
    <section class="py-5" id="login">
        <div class="container text-center">
            <h2 class="fw-bold mb-4 text-dark">Pilih Peran Login Anda</h2>
            <p class="text-muted mb-5">Masuk sesuai peran Anda untuk mengakses sistem SIPADU.</p>

            <div class="row justify-content-center g-4">
                <!-- Mahasiswa -->
                <div class="col-md-4 col-lg-3">
                    <div class="card role-card shadow-sm border-0 fade-in">
                        <img src="{{ asset('images/mahasiswa.jpeg') }}" alt="PIC Unit" onerror="this.src='https://via.placeholder.com/800x140/f0ad4e/ffffff?text=PIC+Unit';">
                            <div class="card-body text-center">
                            <i class="bi bi-person-circle text-primary display-5 mb-2"></i>
                            <h5 class="fw-semibold mb-3">Login Mahasiswa</h5>
                            <a href="/login/mahasiswa" class="btn btn-primary w-100">Masuk</a>
                        </div>
                    </div>
                </div>

                <!-- PIC Unit -->
                <div class="col-md-4 col-lg-3">
                    <div class="card role-card shadow-sm border-0 fade-in">
                       <img src="{{ asset('images/TIK.png') }}" alt="PIC Unit" onerror="this.src='https://via.placeholder.com/800x140/f0ad4e/ffffff?text=PIC+Unit';">
                        <div class="card-body text-center">
                            <i class="bi bi-building-gear text-warning display-5 mb-2"></i>
                            <h5 class="fw-semibold mb-3">Login PIC Unit</h5>
                            <a href="/login/pic" class="btn btn-warning text-white w-100">Masuk</a>
                        </div>
                    </div>
                </div>

                <!-- Admin -->
                <div class="col-md-4 col-lg-3">
                    <div class="card role-card shadow-sm border-0 fade-in">
                        <img src="{{ asset('images/admin.png') }}" alt="Admin SIPADU">
                        <div class="card-body text-center">
                            <i class="bi bi-shield-lock text-danger display-5 mb-2"></i>
                            <h5 class="fw-semibold mb-3">Login Admin</h5>
                            <a href="/login/admin" class="btn btn-danger w-100">Masuk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 🔹 Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-1 fw-semibold">
                <i class="bi bi-mortarboard me-1"></i>Universitas Lampung
            </p>
            <small class="text-light-50">
                © {{ date('Y') }} SIPADU - Sistem Pengaduan Mahasiswa
            </small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
