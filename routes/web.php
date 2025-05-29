<?php

use App\Models\Report;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;

// Rute Umum dan Autentikasi
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth:sanctum');
Route::get('/collaboration', [HomeController::class, 'collaboration'])->name('collaboration');

// Rute yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    // Menampilkan form laporan (menggunakan ReportController)
    Route::get('/report', [ReportController::class, 'create'])->name('report');

    // Menerima data POST dari form laporan (menggunakan ReportController)
    // Ini adalah rute untuk submit form HTML dari browser
    Route::post('/report', [ReportController::class, 'store'])->name('report.submit');

    // Menggunakan MapController untuk view peta
    Route::get('/map', [MapController::class, 'map'])->name('map');
});

// Rute Admin
Route::view('/admin/dashboard', 'admin.index')->name('admin.dashboard'); // <-- Tambahkan ini
Route::get('/admin/reports', function () {
    $reports = Report::paginate(10);
    return view('admin.reports', compact('reports'));
})->name('admin.reports'); // <-- Sangat disarankan untuk memberi nama semua rute Anda
Route::get('/admin/setting', function () {
    return view('admin.setting');
})->name('admin.setting');
Route::get('/admin/mitra', function () {
    return view('admin.mitra');
})->name('admin.mitra');

// Rute API untuk laporan
Route::get('/api/reports', [ReportController::class, 'getReports']);
Route::get('/api/reports/statistics', [ReportController::class, 'getAreaStatistics']); // Rute API baru untuk statistik area
