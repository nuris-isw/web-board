<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Facility;
use App\Models\Teacher;
use App\Models\Achievement;
use App\Models\Extracurricular;
use App\Models\PpdbSetting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ppdb_active = PpdbSetting::where('is_active', true)->first();

        return view('dashboard', [
            'school' => auth()->user()->school,
            'news_count' => News::count(),
            'gallery_count' => Gallery::count(),
            'facility_count' => Facility::count(),
            'teacher_count' => Teacher::count(),
            'achievement_count' => Achievement::count(),
            'extra_count' => Extracurricular::count(),
            'ppdb_active_year' => $ppdb_active ? $ppdb_active->academic_year : null,
        ]);
    }
}