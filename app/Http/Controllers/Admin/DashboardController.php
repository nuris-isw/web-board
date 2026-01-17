<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Facility;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        // Karena ada SchoolScope, News::count() hanya akan menghitung berita milik sekolah ini.
        return view('dashboard', [
            'news_count' => News::count(),
            'gallery_count' => Gallery::count(),
            'facility_count' => Facility::count(),
            'school' => auth()->user()->school // Mengambil data profil sekolah yang login
        ]);
    }
}
