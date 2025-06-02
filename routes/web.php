<?php

use App\Models\Report;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;

// Rute Umum dan Autentikasi
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/collaboration', [HomeController::class, 'collaboration'])->name('collaboration');

// Rute yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/report', [ReportController::class, 'create'])->name('report');
    Route::post('/report', [ReportController::class, 'store'])->name('report.submit');
    Route::get('/map', [MapController::class, 'map'])->name('map');
});

// Rute Admin (accessible by admin and super_admin)
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [ReportController::class, 'index'])->name('admin.dashboard'); // Diubah untuk menggunakan ReportController@index
    Route::get('/admin/dashboard/refresh', [ReportController::class, 'getReports'])->name('admin.dashboard.refresh'); // Rute untuk polling
    Route::get('/admin/reports', function () {
        $reports = Report::paginate(10);
        return view('admin.reports', compact('reports'));
    })->name('admin.reports');
    Route::get('/admin/setting', function () {
        return view('admin.setting');
    })->name('admin.setting');
    Route::get('/admin/mitra', function () {
        return view('admin.mitra');
    })->name('admin.mitra');
});

// Rute API untuk laporan
Route::get('/api/reports', [ReportController::class, 'getReports']);
Route::get('/api/reports/statistics', [ReportController::class, 'getAreaStatistics']);
