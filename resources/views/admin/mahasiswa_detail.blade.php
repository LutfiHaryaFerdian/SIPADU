@extends('layouts.admin')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="container my-5">

    <h2 class="fw-bold mb-4">
        <i class="bi bi-person-lines-fill text-primary me-2"></i>Detail Mahasiswa
    </h2>

    <div class="card shadow-sm p-4">

        <div class="text-center mb-4">
            <img src="{{ $mhs->foto_profile ?? 'https://via.placeholder.com/120' }}"
                 class="rounded-circle mb-3" width="120" height="120" alt="Foto Profil">

            <h4 class="fw-bold">{{ $mhs->nama }}</h4>
            <p class="text-muted">{{ $mhs->email }}</p>
        </div>

        <hr>

        <div class="row mt-3">

            <div class="col-md-6">
                <p><strong>NPM:</strong> {{ $mhs->npm }}</p>
                <p><strong>Program Studi:</strong> {{ $mhs->prodi }}</p>
            </div>

            <div class="col-md-6">
                <p><strong>No. HP:</strong> {{ $mhs->no_hp ?? '-' }}</p>
                <p><strong>Alamat:</strong> {{ $mhs->alamat ?? '-' }}</p>
            </div>

        </div>

        <hr>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

        </div>

    </div>

</div>
@endsection
