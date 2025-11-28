<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi OTP - SIPADU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .otp-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .otp-input {
            width: 50px;
            height: 55px;
            font-size: 24px;
            text-align: center;
            border-radius: 10px;
            border: 1px solid #ced4da;
        }
        .otp-input:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
            outline: none;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center" style="height:100vh;background:#f8fafc;">

<div class="card p-4 shadow" style="width: 420px;border-radius:15px;">
    <h4 class="text-center fw-bold mb-3">Verifikasi OTP</h4>

    @if(session('success')) 
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(session('error')) 
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('forgot.verifyOtp') }}" id="otpForm">
        @csrf

        <label class="form-label text-center d-block mb-2">Masukkan Kode OTP</label>

        <div class="otp-container mb-4">
            <input type="text" maxlength="1" class="otp-input" required>
            <input type="text" maxlength="1" class="otp-input" required>
            <input type="text" maxlength="1" class="otp-input" required>
            <input type="text" maxlength="1" class="otp-input" required>
            <input type="text" maxlength="1" class="otp-input" required>
            <input type="text" maxlength="1" class="otp-input" required>
        </div>

        <!-- hidden input untuk gabungan OTP -->
        <input type="hidden" name="otp" id="otpValue">

        <button type="submit" class="btn btn-warning w-100 fw-semibold">
            Verifikasi
        </button>
    </form>
</div>

<script>
    const inputs = document.querySelectorAll('.otp-input');
    const otpHidden = document.getElementById('otpValue');

    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            updateOTP();
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === "Backspace" && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    function updateOTP() {
        let otp = '';
        inputs.forEach(input => otp += input.value);
        otpHidden.value = otp;
    }
</script>

</body>
</html>
