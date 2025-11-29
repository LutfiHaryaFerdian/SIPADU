<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - SIPADU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8fafc;
        }
        .card-custom {
            width: 420px;
            border-radius: 15px;
        }
        .form-control {
            height: 50px;
            border-radius: 10px;
        }
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.2);
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center" style="min-height:100vh;">

<div class="card p-4 shadow card-custom">
    <h4 class="text-center fw-bold mb-3">Reset Password Baru</h4>
    <p class="text-center text-muted mb-4" style="font-size:14px;">
        Silakan buat password baru untuk akun Anda
    </p>

    @if($errors->any())
        <div class="alert alert-danger text-center">
            Periksa kembali input Anda.
        </div>
    @endif

    <form action="{{ route('forgot.resetPassword') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Password Baru</label>
            <input 
                type="password" 
                name="password" 
                class="form-control" 
                placeholder="Masukkan password baru"
                required
            >
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Konfirmasi Password</label>
            <input 
                type="password" 
                name="password_confirmation" 
                class="form-control" 
                placeholder="Ulangi password"
                required
            >
        </div>

        <button type="submit" class="btn btn-success w-100 fw-semibold">
            Simpan Password
        </button>
    </form>
</div>

</body>
</html>
