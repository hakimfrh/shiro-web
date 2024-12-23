<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardHistoryController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\KoiDetectionController;
use App\Http\Controllers\JsonApiController;

// Halaman utama
Route::get('/', [HomeController::class, 'index']);

// Rute login dan logout
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::resource('/dashboard/controls', DashboardHistoryController::class)->middleware('auth');

// Monitoring data (Revisi: Semua dihandle satu fungsi untuk efisiensi)
Route::get('/monitoring', [MonitoringController::class, 'showDashboard'])->middleware('auth');

// Simpan data sensor (Gunakan POST untuk keamanan)
Route::post('/monitoring/simpan', [MonitoringController::class, 'simpan'])->middleware('auth');

// Deteksi ikan Koi
Route::get('/detect-koi', [KoiDetectionController::class, 'showForm'])->name('detect-koi');
Route::post('/detect-koi', [KoiDetectionController::class, 'detect'])->name('detect-koi.submit');

// Grafik data
Route::get('/grafik', [GrafikController::class, 'index'])->middleware('auth')->name('grafik');
