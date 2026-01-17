<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    public function index()
    {
        $extras = Extracurricular::latest()->get();
        return view('admin.extracurricular.index', compact('extras'));
    }

    public function create()
    {
        return view('admin.extracurricular.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'coach' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'extra_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/extracurriculars'), $fileName);
            $validated['image'] = 'extracurriculars/' . $fileName;
        }

        Extracurricular::create($validated);

        return redirect()->route('admin.extracurricular.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function edit(Extracurricular $extracurricular)
    {
        return view('admin.extracurricular.edit', compact('extracurricular'));
    }

    public function update(Request $request, Extracurricular $extracurricular)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'coach' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($extracurricular->image && file_exists(storage_path('app/public/' . $extracurricular->image))) {
                unlink(storage_path('app/public/' . $extracurricular->image));
            }
            $file = $request->file('image');
            $fileName = 'extra_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/extracurriculars'), $fileName);
            $validated['image'] = 'extracurriculars/' . $fileName;
        }

        $extracurricular->update($validated);

        return redirect()->route('admin.extracurricular.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(Extracurricular $extracurricular)
    {
        $extracurricular->delete();
        return redirect()->route('admin.extracurricular.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
