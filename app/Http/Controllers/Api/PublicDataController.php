<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\PpdbSetting;
use App\Models\News;
use App\Models\Teacher;
use App\Models\Gallery;
use App\Models\Facility;
use App\Models\Achievement;
use App\Models\Extracurricular;
use App\Http\Resources\Api\SchoolResource;
use App\Http\Resources\Api\PpdbResource;
use App\Http\Resources\Api\NewsResource;
use App\Http\Resources\Api\TeacherResource;
use App\Http\Resources\Api\GalleryResource;
use App\Http\Resources\Api\FacilityResource;
use App\Http\Resources\Api\AchievementResource;
use App\Http\Resources\Api\ExtracurricularResource;
use Illuminate\Http\Request;

class PublicDataController extends Controller
{
    /**
     * Mengambil Identitas Sekolah (Branding, Kontak, Sosmed)
     */
    public function getIdentity()
    {
        // Mengambil sekolah pertama beserta relasi identitasnya
        $school = School::with('identity')->first();

        if (!$school) {
            return response()->json([
                'success' => false, 
                'message' => 'Data sekolah tidak ditemukan.'
            ], 404);
        }

        return (new SchoolResource($school))->additional([
            'success' => true
        ]);
    }
    /**
     * Data PPDB Aktif
     */
    public function getPpdbInfo()
    {
        $ppdb = PpdbSetting::with(['periods' => function($q) {
                    $q->where('is_open', true)->orderBy('start_date', 'asc');
                }])
                ->where('is_active', true)
                ->first();

        if (!$ppdb) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return (new PpdbResource($ppdb))->additional(['success' => true]);
    }

    /**
     * Mengambil 3 berita terbaru untuk Landing Page Astro
     */
    public function getLatestNews()
    {
        $news = News::latest()->take(3)->get();
        
        return NewsResource::collection($news)->additional([
            'success' => true
        ]);
    }

    /**
     * Mengambil semua berita dengan pagination untuk halaman Berita di Astro
     */
    public function getAllNews()
    {
        $news = News::latest()->paginate(9);
        
        return NewsResource::collection($news)->additional([
            'success' => true
        ]);
    }

    /**
     * Mengambil daftar Guru & Staf diurutkan berdasarkan 'order'
     */
    public function getTeachers()
    {
        $teachers = Teacher::orderBy('order', 'asc')->get();
        
        return TeacherResource::collection($teachers)->additional([
            'success' => true
        ]);
    }

    /**
     * Mengambil foto galeri terbaru
     */
    /**
     * Endpoint khusus untuk Halaman Beranda (Astro)
     * Mengambil Slider dan Gambar Home Section dalam satu response
     */
    public function getHomeData()
    {
        // 1. Ambil 3-5 slider terbaru untuk Hero
        $sliders = Gallery::where('type', 'slider')
                    ->orderBy('order', 'asc')
                    ->latest()
                    ->take(5)
                    ->get();

        // 2. Ambil 1 gambar terbaru untuk seksi pembuka (Home Section)
        $homeImage = Gallery::where('type', 'home')
                    ->latest()
                    ->first();

        // 3. Ambil 4-8 foto galeri terbaru untuk ditampilkan sekilas di beranda
        $latestGalleries = Gallery::where('type', 'gallery')
                    ->latest()
                    ->take(8)
                    ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'sliders' => GalleryResource::collection($sliders),
                'home_section' => $homeImage ? new GalleryResource($homeImage) : null,
                'latest_galleries' => GalleryResource::collection($latestGalleries),
            ]
        ]);
    }

    /**
     * Endpoint untuk Halaman Galeri (Full)
     */
    public function getFullGallery(Request $request)
    {
        $galleries = Gallery::where('type', 'gallery')
                    ->latest()
                    ->paginate(12);
        
        return GalleryResource::collection($galleries)->additional([
            'success' => true
        ]);
    }

    public function getFacilities()
    {
        return FacilityResource::collection(Facility::all())->additional(['success' => true]);
    }

    public function getAchievements()
    {
        return AchievementResource::collection(Achievement::latest()->get())->additional(['success' => true]);
    }

    public function getExtracurriculars()
    {
        return ExtracurricularResource::collection(Extracurricular::all())->additional(['success' => true]);
    }
}
