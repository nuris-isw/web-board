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
        $query = Gallery::query();

        // Fitur Filter
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Sorting: Slider dulu berdasarkan order, baru gallery terbaru
        $galleries = $query->orderBy('type', 'asc')
                           ->orderBy('order', 'asc')
                           ->latest()
                           ->paginate(12)
                           ->withQueryString();
        
        $categories = Gallery::whereNotNull('category')->distinct()->pluck('category');
        $types = ['slider', 'home', 'gallery'];

        return view('admin.gallery.index', compact('galleries', 'categories', 'types'));
    }

    public function create()
    {
        // Ambil kategori yang sudah ada untuk saran/autocomplete di form jika perlu
        $existingCategories = Gallery::whereNotNull('category')->distinct()->pluck('category');
        
        return view('admin.gallery.create', compact('existingCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:slider,home,gallery',
            'order' => 'nullable|integer|min:0',
            'category' => 'nullable|string|max:100',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            
            // Menggunakan move() sesuai permintaan Anda
            $file->move(storage_path('app/public/gallery'), $fileName);

            Gallery::create([
                'school_id' => auth()->user()->school_id,
                'title' => $request->title,
                'type' => $request->type,
                'order' => $request->order ?? 0,
                'category' => $request->category,
                'image_path' => 'gallery/' . $fileName
            ]);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Konten berhasil diunggah.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:slider,home,gallery',
            'order' => 'nullable|integer|min:0',
            'category' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072'
        ]);

        $data = [
            'title' => $request->title,
            'type' => $request->type,
            'order' => $request->order ?? 0,
            'category' => $request->category,
        ];

        if ($request->hasFile('image')) {
            // Hapus file fisik lama menggunakan unlink
            $oldPath = storage_path('app/public/' . $gallery->image_path);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/gallery'), $fileName);
            
            $data['image_path'] = 'gallery/' . $fileName;
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        $filePath = storage_path('app/public/' . $gallery->image_path);
        
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $gallery->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }
}