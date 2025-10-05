<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Halaman login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Role-based routes
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', fn() => view('dashboard.admin'));
});

Route::middleware('mahasiswa')->group(function () {
    Route::get('/mahasiswa/dashboard', fn() => view('dashboard.mahasiswa'));
});

Route::middleware('pic')->group(function () {
    Route::get('/pic/dashboard', fn() => view('dashboard.pic'));
});
