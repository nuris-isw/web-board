<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Superadmin\SchoolController;
use App\Http\Controllers\Superadmin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->school_id === null) {
        return redirect()->route('superadmin.dashboard');
    }
    return view('dashboard'); // Dashboard untuk Admin Sekolah
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'superadmin'])->prefix('superadmin')->group(function () {
    // Halaman Visual Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard');

    Route::post('/schools', [SchoolController::class, 'store'])->name('superadmin.schools.store');
    // Tambahkan rute manajemen sekolah lainnya di sini
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
