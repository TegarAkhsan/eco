<?php

namespace App\Http\Controllers;

use App\Models\Report; // Mungkin tidak perlu jika hanya untuk view
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage; // Tidak lagi diperlukan
// use Illuminate\Support\Facades\Validator; // Tidak lagi diperlukan
// use Illuminate\Support\Facades\Log; // Tidak lagi diperlukan
// use GuzzleHttp\Client; // Tidak lagi diperlukan

class MapController extends Controller
{
    // Menampilkan halaman form laporan (jika MapController yang bertanggung jawab)
    // Jika ReportController@create yang menampilkan form, metode ini bisa dihapus.
    public function report()
    {
        return view('report');
    }

    // Metode submit dan getReports dihapus dari sini
    // karena sudah ditangani oleh ReportController untuk konsistensi API dan Web.

    // Menampilkan halaman peta interaktif
    public function map()
    {
        return view('map');
    }

    // Perhatikan: Metode getReports ini dihapus atau dipindahkan ke ReportController@getReports
    // Untuk menghindari duplikasi dan memastikan API berjalan melalui ReportController
    // public function getReports() { ... }

    // Helper function getProvinceFromCoordinates juga dihapus dari sini
    // karena sudah ada di ReportController.
    // private function getProvinceFromCoordinates($latitude, $longitude) { ... }
}
