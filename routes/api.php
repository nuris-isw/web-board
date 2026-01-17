<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PublicDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sini adalah tempat mendaftarkan API untuk dikonsumsi Astro.
| Semua route di sini otomatis memiliki prefix /api secara default.
|
*/

// Grouping API Versi 1
Route::prefix('v1')->group(function () {

    // Info PPDB (Tahun Ajaran Aktif & Gelombang)
    Route::get('/ppdb', [PublicDataController::class, 'getPpdbInfo']);
    
    // Identitas Sekolah (Nama, Logo, Alamat, Kontak)
    Route::get('/identity', [PublicDataController::class, 'getIdentity']);
    
    // Berita Terbaru (Untuk Landing Page Astro)
    Route::get('/news/latest', [PublicDataController::class, 'getLatestNews']);
    Route::get('/news', [PublicDataController::class, 'getAllNews']);
    Route::get('/teachers', [PublicDataController::class, 'getTeachers']);
    Route::get('/home-content', [PublicDataController::class, 'getHomeData']);
    Route::get('/galleries', [PublicDataController::class, 'getFullGallery']);
    Route::get('/facilities', [PublicDataController::class, 'getFacilities']);
    Route::get('/achievements', [PublicDataController::class, 'getAchievements']);
    Route::get('/extracurriculars', [PublicDataController::class, 'getExtracurriculars']);

});

// Route default bawaan Laravel (bisa dibiarkan)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
