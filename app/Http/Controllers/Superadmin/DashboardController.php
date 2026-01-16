<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\News;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('superadmin.dashboard', [
            'total_schools' => School::count(),
            'active_schools' => School::where('is_active', true)->count(),
            'total_news' => News::withoutGlobalScopes()->count(), // Superadmin melihat semua berita
            'schools' => School::latest()->get()
        ]);
    }
}
