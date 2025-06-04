<?php

use App\Models\Report;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;

// Rute untuk pengguna yang belum login (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup']);
});

// Rute umum yang tidak memerlukan autentikasi
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/collaboration', [HomeController::class, 'collaboration'])->name('collaboration');

// Rute yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Rute untuk laporan dan peta
    Route::get('/report', [ReportController::class, 'create'])->name('report');
    Route::post('/report', [ReportController::class, 'store'])->name('report.submit');
    Route::get('/map', [MapController::class, 'map'])->name('map');
});

// Rute Admin (accessible by admin and super_admin)
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard/refresh', [ReportController::class, 'getReports'])->name('admin.dashboard.refresh');
    Route::get('/reports', function () {
        $reports = Report::paginate(10);
        return view('admin.reports', compact('reports'));
    })->name('admin.reports');

    Route::get('/setting', function () {
        return view('admin.setting');
    })->name('admin.setting');

    Route::get('/mitra', function () {
        return view('admin.mitra');
    })->name('admin.mitra');

    Route::get('/ecotrack', function () {
        return view('admin.ecotrack');
    })->name('admin.ecotrack');
});

// Rute API
Route::prefix('api')->middleware('api')->group(function () {
    Route::get('/reports', [ReportController::class, 'getReports']);
    Route::get('/reports/statistics', [ReportController::class, 'getReportsStatistics']);
});

Route::get('/', function () {
    return redirect('/home');
});