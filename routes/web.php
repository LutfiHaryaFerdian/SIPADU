<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MultiAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

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
