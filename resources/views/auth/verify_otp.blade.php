<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi OTP - SIPADU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center bg-light" style="height:100vh;">

<div class="card p-4 shadow" style="width: 400px;border-radius:15px;">
    <h4 class="text-center mb-3">Verifikasi OTP</h4>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('register.verifyOtp') }}" onsubmit="combineOtp()">
        @csrf

        <label class="form-label text-center w-100">Masukkan Kode OTP</label>

        <div class="d-flex justify-content-center gap-2 mb-4">
            <input type="text" maxlength="1" class="otp-input form-control text-center">
            <input type="text" maxlength="1" class="otp-input form-control text-center">
            <input type="text" maxlength="1" class="otp-input form-control text-center">
            <input type="text" maxlength="1" class="otp-input form-control text-center">
            <input type="text" maxlength="1" class="otp-input form-control text-center">
            <input type="text" maxlength="1" class="otp-input form-control text-center">
        </div>

        <!-- Hidden input yang dikirim ke backend -->
        <input type="hidden" name="otp" id="otpValue">

        <button class="btn btn-warning w-100 fw-semibold">Verifikasi</button>
    </form>
</div>


<style>
.otp-input {
    font-size: 24px;
    font-weight: bold;
    height: 55px;
    width: 50px;
    border-radius: 10px;
}
.otp-input:focus {
    border-color: #f59e0b;
    box-shadow: 0 0 0 0.2rem rgba(245,158,11,.25);
}
</style>

<script>
const inputs = document.querySelectorAll(".otp-input");

inputs.forEach((input, index) => {
    input.addEventListener("input", () => {
        if (input.value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });

    input.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && !input.value && index > 0) {
            inputs[index - 1].focus();
        }
    });
});

function combineOtp() {
    let otp = "";
    inputs.forEach(input => otp += input.value);
    document.getElementById("otpValue").value = otp;
}
</script>

</body>
</html>
