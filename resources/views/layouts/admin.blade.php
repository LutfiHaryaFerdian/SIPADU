@extends('layouts.app')

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

<style>
    .modern-navbar {
        background: linear-gradient(to right, #dc2626, #ef4444);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 0.8rem 0;
    }

    .navbar-brand {
        font-weight: 600;
        font-size: 1.2rem;
    }

    .brand-icon {
        width: 38px;
        height: 38px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .navbar-brand:hover .brand-icon {
        background: rgba(255, 255, 255, 0.25);
    }

    .brand-text {
        color: white;
    }

    .modern-nav-link {
        color: rgba(255, 255, 255, 0.85) !important;
        padding: 0.5rem 1rem !important;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .modern-nav-link i {
        font-size: 1rem;
    }

    .modern-nav-link:hover {
        color: #fff !important;
        background: rgba(255, 255, 255, 0.12);
    }

    .modern-nav-link.active {
        color: #fff !important;
        background: rgba(255, 255, 255, 0.2);
        font-weight: 600;
    }

    .logout-btn {
        background: rgba(239, 68, 68, 0.25) !important;
        color: #fff !important;
        padding: 0.5rem 1.2rem !important;
        border-radius: 8px;
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .logout-btn:hover {
        background: rgba(239, 68, 68, 0.4) !important;
        border-color: rgba(255, 255, 255, 0.5);
    }

    .navbar-toggler {
        padding: 0.4rem;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.1);
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.2);
    }

    @media (max-width: 991.98px) {
        .modern-navbar {
            padding: 0.6rem 0;
        }

        .navbar-collapse {
            margin-top: 0.8rem;
            padding: 0.8rem;
            background: rgba(0, 0, 0, 0.15);
            border-radius: 8px;
        }

        .modern-nav-link {
            margin: 0.2rem 0;
        }

        .logout-btn {
            margin-top: 0.4rem;
        }
    }

    body {
        padding-top: 70px;
    }

    @media (max-width: 991.98px) {
        body {
            padding-top: 65px;
        }
    }
</style>
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
