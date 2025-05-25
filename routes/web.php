<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/dashboard', action: [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth:sanctum');
Route::get('/collaboration', [HomeController::class, 'collaboration'])->name('collaboration');

Route::middleware('auth')->group(function () {
    Route::get('/report', [MapController::class, 'report'])->name('report');
    Route::post('/report', [MapController::class, 'submit'])->name('report.submit');
    Route::get('/map', [MapController::class, 'map'])->name('map');
});
