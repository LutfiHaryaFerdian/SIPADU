<?php

use App\Http\Controllers\MultiAuthController;
use Illuminate\Support\Facades\Route;

// Halaman login untuk masing-masing role
Route::get('/login/{role}', [MultiAuthController::class, 'showLogin'])->name('login.role');
Route::post('/login/{role}', [MultiAuthController::class, 'login'])->name('login.process');
Route::get('/logout/{role}', [MultiAuthController::class, 'logout'])->name('logout.role');

// Middleware per role
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', fn() => view('dashboard.admin'));
});

Route::middleware('mahasiswa')->group(function () {
    Route::get('/mahasiswa/dashboard', fn() => view('dashboard.mahasiswa'));
});

Route::middleware('pic')->group(function () {
    Route::get('/pic/dashboard', fn() => view('dashboard.pic'));
});
