@extends('layouts.app')

@section('title', 'PIC Unit - SIPADU')

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background: linear-gradient(90deg, #ffca2c, #ffc107);">
    <div class="container-fluid px-4">
        <!-- 🔸 Logo -->
        <a class="navbar-brand fw-semibold text-dark d-flex align-items-center" href="/pic/dashboard">
            <i class="bi bi-building-gear me-2"></i>
            <span>SIPADU - PIC Unit</span>
        </a>

        <!-- Toggle Button (Mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPic"
            aria-controls="navbarPic" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- 🔸 Navbar Menu -->
        <div class="collapse navbar-collapse" id="navbarPic">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="/pic/dashboard" 
                       class="nav-link {{ Request::is('pic/dashboard') ? 'active fw-bold text-dark' : 'text-dark' }}">
                        <i class="bi bi-speedometer2 me-1"></i>Dashboard
                    </a>
                </li>

                <!-- Aduan Ditugaskan -->
                <li class="nav-item">
                    <a href="/pic/aduan" 
                       class="nav-link {{ Request::is('pic/aduan*') ? 'active fw-bold text-dark' : 'text-dark' }}">
                        <i class="bi bi-list-task me-1"></i>Aduan Ditugaskan
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="/logout/pic" class="nav-link text-light fw-semibold bg-danger bg-opacity-25 px-3 rounded-3">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
.nav-link.active {
    background-color: rgba(255, 255, 255, 0.4);
    border-radius: 0.5rem;
}
.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.25);
    border-radius: 0.5rem;
    transition: 0.3s;
}
.navbar-brand:hover {
    opacity: 0.85;
    transition: 0.3s ease;
}
</style>
@endsection
