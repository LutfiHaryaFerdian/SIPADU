<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MultiAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Auth\GoogleController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// ==========================
// FORGOT PASSWORD + OTP
// ==========================
Route::get('/forgot-password', [ForgotPasswordController::class, 'showEmailForm'])->name('forgot.email');
Route::post('/forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('forgot.sendOtp');

Route::get('/forgot-password/verify', [ForgotPasswordController::class, 'showVerifyForm'])->name('forgot.verifyForm');
Route::post('/forgot-password/verify', [ForgotPasswordController::class, 'verifyOtp'])->name('forgot.verifyOtp');

Route::get('/forgot-password/reset', [ForgotPasswordController::class, 'showResetForm'])->name('forgot.resetForm');
Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('forgot.resetPassword');


Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register/send-otp', [RegisterController::class, 'sendOtp'])->name('register.sendOtp');
Route::get('/register/verify', [RegisterController::class, 'verifyForm'])->name('register.verifyForm');
Route::post('/register/verify', [RegisterController::class, 'verifyOtp'])->name('register.verifyOtp');

// Public aduan detail (accessible tanpa login)
Route::get('/aduan-publik/{id}', [AduanController::class, 'publicDetail'])->name('aduan.publik.detail');

// ===================================================
// AUTHENTICATION (Login & Logout per Role)
// ===================================================
Route::get('/login/{role}', [MultiAuthController::class, 'showLogin'])->name('login.role');
Route::post('/login/{role}', [MultiAuthController::class, 'login'])->name('login.process');
Route::get('/logout/{role}', [MultiAuthController::class, 'logout'])->name('logout.role');

// ===================================================
// ADMIN ROUTES
// ===================================================
Route::middleware('admin')->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Manajemen Aduan
    Route::get('/admin/aduan', [AdminController::class, 'indexAduan'])->name('admin.aduan.index');
    Route::get('/admin/aduan/{id}/detail', [AdminController::class, 'detailAduan'])->name('admin.aduan.detail');
    Route::post('/admin/aduan/{id}/validate', [AdminController::class, 'validateAduan'])->name('admin.aduan.validate');
    Route::post('/admin/aduan/{id}/reject', [AdminController::class, 'rejectAduan'])->name('admin.aduan.reject');
    Route::post('/admin/aduan/{id}/assign', [AdminController::class, 'assignToPic'])->name('admin.aduan.assign');
    Route::post('/admin/aduan/{id}/done', [AdminController::class, 'markAsDone'])->name('admin.aduan.done');
});

// ===================================================
// MAHASISWA ROUTES
// ===================================================
Route::middleware('mahasiswa')->group(function () {
    // Dashboard Mahasiswa
    Route::get('/mahasiswa/dashboard', fn() => view('dashboard.mahasiswa'))->name('mahasiswa.dashboard');

    // CRUD Aduan Mahasiswa
    Route::get('/mahasiswa/aduan', [AduanController::class, 'index'])->name('aduan.index');
    Route::get('/mahasiswa/aduan/create', [AduanController::class, 'create'])->name('aduan.create');
    Route::post('/mahasiswa/aduan', [AduanController::class, 'store'])->name('aduan.store');
    // Lihat Aduan Publik (tanpa identitas)
    Route::get('/mahasiswa/aduan-publik', [AduanController::class, 'publik'])->name('aduan.publik');
    Route::delete('/mahasiswa/aduan/{id}', [AduanController::class, 'destroy'])->name('aduan.destroy');
});

// ===================================================
// PIC UNIT ROUTES
// ===================================================
Route::middleware('pic')->group(function () {
    // Dashboard PIC
    Route::get('/pic/dashboard', [PicController::class, 'index'])->name('pic.dashboard');

    // Aduan & Tindak Lanjut
    Route::get('/pic/aduan', [PicController::class, 'indexAduan'])->name('pic.aduan.index');
    Route::get('/pic/aduan/{id}/tindaklanjut', [PicController::class, 'tindakLanjutForm'])->name('pic.tindaklanjut.form');
    Route::post('/pic/aduan/{id}/tindaklanjut', [PicController::class, 'tindakLanjutStore'])->name('pic.tindaklanjut.store');
    Route::get('/pic/aduan/{id}/view', [PicController::class, 'viewTindakLanjut'])->name('pic.tindaklanjut.view');
    Route::get('/pic/aduan/{id}/edit-dikerjakan', [PicController::class, 'editCatatanDikerjakan'])->name('pic.catatan.edit-dikerjakan');
    Route::put('/pic/aduan/{id}/update-dikerjakan', [PicController::class, 'updateCatatanDikerjakan'])->name('pic.catatan.update-dikerjakan');
    Route::get('/pic/aduan/{id}/edit-selesai', [PicController::class, 'editCatatanSelesai'])->name('pic.catatan.edit-selesai');
    Route::put('/pic/aduan/{id}/update-selesai', [PicController::class, 'updateCatatanSelesai'])->name('pic.catatan.update-selesai');
});
