<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - SIPADU</title>
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
    <h4 class="text-center fw-bold mb-3">Lupa Password</h4>
    <p class="text-center text-muted mb-4" style="font-size:14px;">
        Masukkan email terdaftar untuk menerima kode OTP
    </p>

    @if(session('error')) 
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    @if(session('success')) 
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form action="{{ route('forgot.sendOtp') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input 
                type="email" 
                name="email" 
                class="form-control" 
                placeholder="contoh@gmail.com"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary w-100 fw-semibold">
            Kirim OTP
        </button>
    </form>
</div>

</body>
</html>
