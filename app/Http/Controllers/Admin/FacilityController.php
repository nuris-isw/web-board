<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::latest()->get();
        return view('admin.facility.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.facility.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'facility_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/facilities'), $fileName);
            $validated['image'] = 'facilities/' . $fileName;
        }

        Facility::create($validated);

        return redirect()->route('admin.facility.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Facility $facility)
    {
        return view('admin.facility.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($facility->image && file_exists(storage_path('app/public/' . $facility->image))) {
                unlink(storage_path('app/public/' . $facility->image));
            }

            $file = $request->file('image');
            $fileName = 'facility_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/facilities'), $fileName);
            $validated['image'] = 'facilities/' . $fileName;
        }

        $facility->update($validated);

        return redirect()->route('admin.facility.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Facility $facility)
    {
        // File fisik dihapus otomatis melalui model boot 'deleting' yang kita buat sebelumnya
        $facility->delete();
        return redirect()->route('admin.facility.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}