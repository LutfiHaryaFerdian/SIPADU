<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PicController;


// ===== Autentikasi =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== Dashboard per Role =====
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin']);
    Route::get('/admin/aduan', [AdminController::class, 'index']);
    Route::post('/admin/aduan/{id}/verifikasi', [AdminController::class, 'verifikasi']);
    Route::post('/admin/aduan/{id}/assign', [AdminController::class, 'assign']);
});

Route::middleware('mahasiswa')->group(function () {
    Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswa'])->name('dashboard.mahasiswa');
    Route::get('/mahasiswa/aduan', [AduanController::class, 'index'])->name('aduan.index');
    Route::get('/mahasiswa/aduan/create', [AduanController::class, 'create']);
    Route::post('/mahasiswa/aduan/store', [AduanController::class, 'store']);
});

Route::middleware('pic')->group(function () {
    Route::get('/pic/dashboard', [DashboardController::class, 'pic']);
    Route::get('/pic/tindaklanjut', [PicController::class, 'index']);
    Route::post('/pic/tindaklanjut/store', [PicController::class, 'tindakLanjut']);
});
