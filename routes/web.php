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

Route::get('/', [HomeController::class, 'index']);

// Login routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout');
});

// Riwayat Monitoring
Route::get('/dashboard/histories', [DashboardHistoryController::class, 'index'])->name('dashboard.histories.index')->middleware('auth');
Route::delete('/dashboard/histories/{id}', [DashboardHistoryController::class, 'destroy'])->middleware('auth');
Route::get('/dashboard/cetak', [DashboardHistoryController::class, 'cetak'])->middleware('auth');
// Route::get('/dashboard/histories/cetak', [DashboardHistoryController::class, 'cetak'])->middleware('auth')->name('dashboard.histories.cetak');
// Route::get('/dashboard/histories', [MonitoringController::class, 'index'])->name('monitoring.index');
// Route::delete('/dashboard/histories/{id}', [MonitoringController::class, 'destroy'])->name('monitoring.destroy');

// Dashboard routes
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::resource('/dashboard/controls', DashboardHistoryController::class)->middleware('auth');

Route::get('/api/sensor-data', [DashboardController::class, 'getSensorData']);
// Detect Koi routes
Route::get('/detect-koi', [KoiDetectionController::class, 'showForm'])->name('detect-koi');
// Route::post('/detect-koi', [KoiDetectionController::class, 'detect'])->name('detect-koi.submit');
Route::post('/classify-koi', [KoiDetectionController::class, 'classifyKoi']);
// Grafik routes
// Route::get('/grafik', [GrafikController::class, 'index'])->middleware('auth')->name('grafik');
// Route untuk grafik monitoring
Route::get('/grafik', [GrafikController::class, 'index'])->middleware('auth')->name('grafik');

// Route::get('/grafik', [GrafikController::class, 'index'])->middleware('auth')->name('grafik');

// Route untuk menyimpan nilai sensor ke database
Route::get('/simpan/{temperature}/{turbidity}/{ph}/{jarak}/{pompa_masuk}/{pompa_keluar}', [MonitoringController::class, 'simpan']);

//Route api mobile
Route::controller(JsonApiController::class)->group(function () {
    Route::get('/api/login', 'authenticate');
    Route::get('/api/getdata', 'getData');
    Route::post('/api/classify', 'classifyKoi');
});