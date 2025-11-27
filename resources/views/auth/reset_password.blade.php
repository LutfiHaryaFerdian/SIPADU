@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 450px;">
    <h3 class="fw-bold mb-3 text-center">Reset Password Baru</h3>

    @if($errors->any())
        <div class="alert alert-danger">Periksa kembali input Anda.</div>
    @endif

    <form action="{{ route('forgot.resetPassword') }}" method="POST">
        @csrf
        <label class="form-label">Password Baru</label>
        <input type="password" name="password" class="form-control mb-3" required>

        <label class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control mb-3" required>

        <button class="btn btn-success w-100">Simpan Password</button>
    </form>
</div>
@endsection
