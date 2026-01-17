<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::latest();

        // Fitur Filter jika kategori dipilih
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $galleries = $query->paginate(12);
        
        // Ambil semua kategori unik untuk tombol filter
        $categories = Gallery::whereNotNull('category')
                            ->distinct()
                            ->pluck('category');

        return view('admin.gallery.index', compact('galleries', 'categories'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'nullable|string|max:100',
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:3072'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // Buat nama file unik
                $fileName = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                
                // Pindahkan file secara fisik
                $file->move(storage_path('app/public/gallery'), $fileName);

                // Buat record di database
                Gallery::create([
                    'title' => $file->getClientOriginalName(),
                    'category' => $request->category,
                    'image_path' => 'gallery/' . $fileName
                ]);
            }
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Foto-foto berhasil diunggah.');
    }

    public function destroy(Gallery $gallery)
    {
        // Hapus file fisik
        if ($gallery->image_path && file_exists(storage_path('app/public/' . $gallery->image_path))) {
            unlink(storage_path('app/public/' . $gallery->image_path));
        }

        $gallery->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
