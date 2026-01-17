<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Superadmin\SchoolController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\SchoolIdentityController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\ExtracurricularController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\PpdbController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 1. Dashboard Redirect Logic
Route::get('/dashboard', function () {
    if (auth()->user()->school_id === null) {
        return redirect()->route('superadmin.dashboard');
    }
    return app(AdminDashboard::class)->index();
})->middleware(['auth', 'verified'])->name('dashboard');

// 2. Superadmin Routes
Route::middleware(['auth', 'superadmin'])->prefix('superadmin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard');
    Route::post('/schools', [SchoolController::class, 'store'])->name('superadmin.schools.store');
    Route::get('/schools/{school:uuid}', [SchoolController::class, 'show'])->name('superadmin.schools.show');
    Route::post('/schools/{school}/admins', [SchoolController::class, 'storeAdmin'])->name('superadmin.schools.storeAdmin');
});

// 3. Admin Sekolah Routes (TAMBAHKAN INI)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/identity', [SchoolIdentityController::class, 'edit'])->name('identity.edit');
    Route::put('/identity', [SchoolIdentityController::class, 'update'])->name('identity.update');
    Route::resource('news', NewsController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('facility', FacilityController::class);
    Route::resource('achievement', AchievementController::class);
    Route::resource('extracurricular', ExtracurricularController::class);
    Route::resource('teacher', TeacherController::class);
    Route::resource('ppdb', PpdbController::class);
    Route::post('ppdb/{ppdb}/periods', [PpdbController::class, 'storePeriod'])->name('ppdb.periods.store');
    Route::delete('ppdb/periods/{period}', [PpdbController::class, 'destroyPeriod'])->name('ppdb.periods.destroy');
});

// 4. Profile & Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';