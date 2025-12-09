@extends('layouts.app')

<!-- PIC CSS -->
    @vite(['resources/css/pic.css'])

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark fixed-top modern-navbar-pic">
    <div class="container-fluid px-4">
        <!-- Updated brand styling to match mahasiswa layout with icon background -->
        <a class="navbar-brand d-flex align-items-center" href="/pic/dashboard">
            <div class="brand-icon me-2">
                <i class="bi bi-building-gear"></i>
            </div>
            <span class="brand-text">SIPADU - PIC Unit</span>
        </a>

        <!-- Added border-0 class to toggler to match mahasiswa styling -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPic"
            aria-controls="navbarPic" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarPic">
            <ul class="navbar-nav align-items-lg-center gap-1">
                <!-- Updated Dashboard link styling to match mahasiswa nav-link pattern -->
                <li class="nav-item">
                    <a href="/pic/dashboard" 
                       class="nav-link modern-nav-link {{ Request::is('pic/dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Updated Aduan Ditugaskan link styling to match mahasiswa nav-link pattern -->
                <li class="nav-item">
                    <a href="/pic/aduan" 
                       class="nav-link modern-nav-link {{ Request::is('pic/aduan*') ? 'active' : '' }}">
                        <i class="bi bi-list-task me-2"></i>
                        <span>Aduan Ditugaskan</span>
                    </a>
                </li>

                <!-- Updated logout button styling to match mahasiswa logout-btn pattern -->
                <li class="nav-item ms-lg-2">
                    <a href="/logout/pic" class="nav-link logout-btn">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@endsection
