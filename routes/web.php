<?php

use App\Http\Controllers\MultiAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PicController;

// Halaman login untuk masing-masing role
Route::get('/login/{role}', [MultiAuthController::class, 'showLogin'])->name('login.role');
Route::post('/login/{role}', [MultiAuthController::class, 'login'])->name('login.process');
Route::get('/logout/{role}', [MultiAuthController::class, 'logout'])->name('logout.role');

// Middleware per role
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', fn() => view('dashboard.admin'));
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/aduan', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.aduan.index');
    Route::post('/admin/aduan/{id}/assign', [App\Http\Controllers\AdminController::class, 'assignToPic'])->name('admin.aduan.assign');
    Route::post('/admin/aduan/{id}/done', [App\Http\Controllers\AdminController::class, 'markAsDone'])->name('admin.aduan.done');
});

Route::middleware('mahasiswa')->group(function () {
    Route::get('/mahasiswa/dashboard', fn() => view('dashboard.mahasiswa'));

    Route::get('/mahasiswa/aduan', [App\Http\Controllers\AduanController::class, 'index'])->name('aduan.index');
    Route::get('/mahasiswa/aduan/create', [App\Http\Controllers\AduanController::class, 'create'])->name('aduan.create');
    Route::post('/mahasiswa/aduan', [App\Http\Controllers\AduanController::class, 'store'])->name('aduan.store');
    Route::delete('/mahasiswa/aduan/{id}', [App\Http\Controllers\AduanController::class, 'destroy'])->name('aduan.destroy');
});

Route::middleware('pic')->group(function () {
    Route::get('/pic/dashboard', fn() => view('dashboard.pic'));
    Route::get('/pic/dashboard', [PicController::class, 'index'])->name('pic.dashboard');
    Route::get('/pic/aduan', [App\Http\Controllers\PicController::class, 'index'])->name('pic.aduan.index');
    Route::get('/pic/aduan/{id}/tindaklanjut', [App\Http\Controllers\PicController::class, 'tindakLanjutForm'])->name('pic.tindaklanjut.form');
    Route::post('/pic/aduan/{id}/tindaklanjut', [App\Http\Controllers\PicController::class, 'tindakLanjutStore'])->name('pic.tindaklanjut.store');
});
