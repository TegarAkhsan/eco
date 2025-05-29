<?php

// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController; // Pastikan ini diimpor
use App\Http\Controllers\MapController; // Jika Anda masih menggunakan MapController

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Reports API routes
Route::post('/reports', [ReportController::class, 'store']);
Route::get('/reports', [ReportController::class, 'getReports']);

// New API routes for choropleth data
Route::get('/reports/province-counts', [ReportController::class, 'getReportsByProvince']);
Route::get('/reports/city-counts', [ReportController::class, 'getReportsByCity']);

// Example web route (if not already defined in web.php)
