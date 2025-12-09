@extends('layouts.app')

<!-- Mahasiswa CSS -->
    @vite(['resources/css/mahasiswa.css'])

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark fixed-top modern-navbar">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="/mahasiswa/dashboard">
            <div class="brand-icon me-2">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <span class="brand-text">SIPADU Mahasiswa</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMahasiswa">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarMahasiswa">
            <ul class="navbar-nav align-items-lg-center gap-1">
                <li class="nav-item">
                    <a href="/mahasiswa/dashboard" class="nav-link modern-nav-link {{ request()->is('mahasiswa/dashboard') ? 'active' : '' }}">
                        <i class="bi bi-house-door-fill me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/mahasiswa/aduan/create" class="nav-link modern-nav-link {{ request()->is('mahasiswa/aduan/create') ? 'active' : '' }}">
                        <i class="bi bi-pencil-square me-2"></i>
                        <span>Buat Aduan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/mahasiswa/aduan" class="nav-link modern-nav-link {{ request()->is('mahasiswa/aduan') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text-fill me-2"></i>
                        <span>Aduan Saya</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/mahasiswa/aduan-publik" class="nav-link modern-nav-link {{ request()->is('mahasiswa/aduan-publik') ? 'active' : '' }}">
                        <i class="bi bi-globe2 me-2"></i>
                        <span>Aduan Publik</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mahasiswa.profile') }}" class="nav-link modern-nav-link {{ request()->routeIs('mahasiswa.profile') ? 'active' : '' }}">
                        <i class="bi bi-person-circle me-2"></i>
                        <span>Profil</span>
                    </a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a href="/logout/mahasiswa" class="nav-link logout-btn">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@endsection
