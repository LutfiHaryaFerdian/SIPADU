<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login {{ ucfirst($role) }} - SIPADU</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* === Background per role === */
        @if($role === 'admin')
            body {
                background-image: url('{{ asset("images/admin.png") }}');
            }
            .overlay { background: rgba(220, 53, 69, 0.4); } /* merah transparan */
            .theme-color { color: #dc3545; }
            .btn-theme { background-color: #dc3545; border: none; }
            .btn-theme:hover { background-color: #b02a37; }
        @elseif($role === 'mahasiswa')
            body {
                background-image: url('{{ asset("images/mahasiswa.jpeg") }}');
            }
            .overlay { background: rgba(13, 110, 253, 0.4); } /* biru transparan */
            .theme-color { color: #0d6efd; }
            .btn-theme { background-color: #0d6efd; border: none; }
            .btn-theme:hover { background-color: #0b5ed7; }
        @elseif($role === 'pic')
            body {
                background-image: url('{{ asset("images/TIK.png") }}');
            }
            .overlay { background: rgba(255, 193, 7, 0.4); } /* kuning transparan */
            .theme-color { color: #ffc107; }
            .btn-theme { background-color: #ffc107; border: none; color: #212529; }
            .btn-theme:hover { background-color: #e0a800; color: #212529; }
        @endif

        .overlay {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            backdrop-filter: blur(5px);
        }

        .card {
            border-radius: 1rem;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-icon {
            font-size: 3.5rem;
        }
    </style>
</head>
<body>
<div class="overlay">

    <div class="card p-4 fade-in" style="width: 100%; max-width: 420px;">
        <div class="text-center mb-4">
            <i class="bi bi-mortarboard-fill login-icon theme-color mb-3"></i>
            <h3 class="fw-bold theme-color mb-1">SIPADU Universitas Lampung</h3>
            <p class="text-muted mb-0">Login sebagai <strong>{{ ucfirst($role) }}</strong></p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger py-2 small text-center">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login/{{ $role }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email..." required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password..." required>
            </div>

            <button type="submit" class="btn btn-theme w-100 fw-semibold">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login
            </button>
        </form>

        

        

        @if($role === 'mahasiswa')
        <div class="text-center mt-3">
            <a href="{{ route('google.redirect') }}" class="btn btn-danger w-100">
                <i class="bi bi-google me-2"></i> Login dengan Google
            </a>
        </div>
        <div class="text-center mt-3 small">
            <p class="mb-0">Belum punya akun?
                <a href="/register" class="text-decoration-none fw-semibold text-primary">Daftar Sekarang</a>
            </p>
        </div>
        <div class="text-center mt-3 small">
            <p class="mb-0">Lupa password?
                <a href="{{ route('forgot.email') }}" class="text-decoration-none fw-semibold text-primary">Ganti Password</a>
            </p>
        </div>
        @elseif($role === 'admin')
        <div class="text-center mt-3 small">
            <p class="mb-0">Hubungi PIC Unit untuk membuat akun Admin.</p>
        </div>
        @elseif($role === 'pic')
        <div class="text-center mt-3 small">
            <p class="mb-0">Hubungi Admin untuk membuat akun PIC Unit.</p>
        </div>
        @endif

        <div class="text-center mt-4 small">
            <p class="text-muted mb-1">Login sebagai:</p>
            <a href="/login/admin" class="text-danger text-decoration-none me-2 fw-semibold">Admin</a> |
            <a href="/login/mahasiswa" class="text-primary text-decoration-none mx-2 fw-semibold">Mahasiswa</a> |
            <a href="/login/pic" class="text-warning text-decoration-none ms-2 fw-semibold">PIC</a>
        </div>

        <div class="text-center mt-4">
            <a href="/" class="btn btn-outline-success btn-sm">
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
