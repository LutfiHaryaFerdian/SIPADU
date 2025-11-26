@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 450px;">
    <h3 class="fw-bold mb-3 text-center">Verifikasi OTP</h3>

    @if(session('success')) 
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error')) 
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('forgot.verifyOtp') }}">
        @csrf
        <label class="form-label">Kode OTP</label>
        <input type="text" name="otp" class="form-control mb-3" required>

        <button class="btn btn-warning w-100">Verifikasi</button>
    </form>
</div>
@endsection
