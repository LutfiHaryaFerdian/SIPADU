@extends('layouts.app')

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-semibold" href="/admin/dashboard">
            <i class="bi bi-shield-lock-fill me-2"></i>SIPADU Admin
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarAdmin">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/aduan" class="nav-link {{ request()->is('admin/aduan') ? 'active' : '' }}">
                        <i class="bi bi-chat-left-text me-1"></i>Aduan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/logout/admin" class="nav-link text-light fw-semibold bg-danger bg-opacity-25 px-3 rounded-3">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endsection
