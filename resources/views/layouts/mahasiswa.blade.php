@extends('layouts.app')

@section('title', 'Mahasiswa - SIPADU')

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-semibold" href="/mahasiswa/dashboard">
            <i class="bi bi-mortarboard-fill me-2"></i> SIPADU Mahasiswa
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMahasiswa">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarMahasiswa">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="/mahasiswa/dashboard" class="nav-link {{ request()->is('mahasiswa/dashboard') ? 'active fw-bold' : '' }}">
                        <i class="bi bi-house-door me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/mahasiswa/aduan/create" class="nav-link {{ request()->is('mahasiswa/aduan/create') ? 'active fw-bold' : '' }}">
                        <i class="bi bi-pencil-square me-1"></i>Buat Aduan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/mahasiswa/aduan" class="nav-link {{ request()->is('mahasiswa/aduan') ? 'active fw-bold' : '' }}">
                        <i class="bi bi-file-earmark-text me-1"></i>Aduan Saya
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/logout/mahasiswa" class="nav-link text-light fw-semibold bg-danger bg-opacity-25 px-3 rounded-3">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Tambahkan padding agar tidak ketutupan navbar -->
<div style="padding-top: 75px;"></div>
@endsection
