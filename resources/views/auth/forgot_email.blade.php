@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 450px;">
    <h3 class="fw-bold mb-3 text-center">Lupa Password</h3>

    @if(session('error')) 
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('forgot.sendOtp') }}" method="POST">
        @csrf
        <label class="form-label">Masukkan Email Anda</label>
        <input type="email" name="email" class="form-control mb-3" required>

        <button class="btn btn-primary w-100">Kirim OTP</button>
    </form>
</div>
@endsection
