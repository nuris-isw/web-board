<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_published' => 'required|boolean'
        ]);

        $validated['thumbnail'] = null;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            
            // Buat nama file unik
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Simpan ke storage/app/public/news secara manual
            $file->move(storage_path('app/public/news'), $fileName);
            
            // Simpan path relatif ke database
            $validated['thumbnail'] = 'news/' . $fileName;
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($request->title) . '-' . \Illuminate\Support\Str::random(5);
        
        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diterbitkan.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_published' => 'required|boolean'
        ]);

        if ($request->hasFile('thumbnail')) {
            // 1. Hapus file lama secara manual jika ada
            if ($news->thumbnail && file_exists(storage_path('app/public/' . $news->thumbnail))) {
                unlink(storage_path('app/public/' . $news->thumbnail));
            }

            // 2. Proses file baru
            $file = $request->file('thumbnail');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/news'), $fileName);
            
            $validated['thumbnail'] = 'news/' . $fileName;
        } else {
            unset($validated['thumbnail']);
        }

        if ($request->title !== $news->title) {
            $validated['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    // Proses Hapus
    public function destroy(News $news)
    {
        if (!empty($news->thumbnail) && Storage::disk('public')->exists($news->thumbnail)) {
            Storage::disk('public')->delete($news->thumbnail);
        }
        
        $news->delete();

        return back()->with('success', 'Berita telah dihapus.');
    }
}
