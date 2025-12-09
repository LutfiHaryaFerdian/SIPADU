@extends('layouts.app')

<!-- Admin CSS -->
    @vite(['resources/css/admin.css'])

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark fixed-top modern-navbar">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="/admin/dashboard">
            <div class="brand-icon me-2">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <span class="brand-text">SIPADU Admin</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarAdmin">
            <ul class="navbar-nav align-items-lg-center gap-1">
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link modern-nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/aduan" class="nav-link modern-nav-link {{ request()->is('admin/aduan') ? 'active' : '' }}">
                        <i class="bi bi-chat-left-text me-2"></i>
                        <span>Aduan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/mahasiswa" class="nav-link modern-nav-link {{ request()->is('admin/mahasiswa*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill me-2"></i>
                        <span>Mahasiswa</span>
                    </a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a href="/logout/admin" class="nav-link logout-btn">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endsection

@section('content')
<div class="container-fluid mt-5 pt-4">
    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Konten halaman --}}
    @yield('content')
</div>
@endsection
