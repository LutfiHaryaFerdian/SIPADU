<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Mahasiswa - SIPADU</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
             background-image: url('{{ asset("images/mahasiswa.jpeg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .overlay {
            background: rgba(13, 110, 253, 0.4); /* biru lembut */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(6px);
        }

        .card {
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .btn-success {
            background-color: #198754;
            border: none;
        }

        .btn-success:hover {
            background-color: #157347;
        }

        .register-icon {
            font-size: 3rem;
            color: #0d6efd;
        }
    </style>
</head>
<body>
<div class="overlay">

    <div class="card p-4" style="width: 100%; max-width: 460px;">
        <div class="text-center mb-4">
            <i class="bi bi-person-plus-fill register-icon mb-3"></i>
            <h3 class="fw-bold text-primary mb-1">Daftar Akun Mahasiswa</h3>
            <p class="text-muted mb-0">Isi data berikut untuk membuat akun baru</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger py-2 small text-center">
                <i class="bi bi-x-circle me-1"></i>{{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success py-2 small text-center">
                <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.sendOtp') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">NPM</label>
                <input type="text" name="npm" class="form-control" placeholder="Masukkan NPM" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email aktif" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Buat password" required>
            </div>

            <button type="submit" class="btn btn-success w-100 fw-semibold">
                <i class="bi bi-person-check-fill me-1"></i> Daftar Akun
            </button>
        </form>

        <div class="text-center mt-4 small">
            <p class="mb-1 text-muted">Sudah punya akun?</p>
            <a href="/login/mahasiswa" class="text-decoration-none fw-semibold text-primary">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login Sekarang
            </a>
        </div>

        <div class="text-center mt-3">
            <a href="/" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Utama
            </a>
        </div>

        <footer class="text-center text-muted mt-4 small">
            © {{ date('Y') }} SIPADU - Universitas Lampung
        </footer>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
