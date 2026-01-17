<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Menampilkan daftar Guru & Staf dengan filter tipe.
     */
    public function index(Request $request)
    {
        $query = Teacher::orderBy('order', 'asc');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $teachers = $query->get();
        return view('admin.teacher.index', compact('teachers'));
    }

    /**
     * Form tambah data baru.
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Simpan data ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'position' => 'required|string|max:255',
            'type' => 'required|in:guru,staf',
            'order' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = 'teacher_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/teachers'), $fileName);
            $validated['photo'] = 'teachers/' . $fileName;
        }

        Teacher::create($validated);

        return redirect()->route('admin.teacher.index')->with('success', 'Data Guru/Staf berhasil ditambahkan.');
    }

    /**
     * Form edit data.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teacher.edit', compact('teacher'));
    }

    /**
     * Perbarui data yang ada.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'position' => 'required|string|max:255',
            'type' => 'required|in:guru,staf',
            'order' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika diganti
            if ($teacher->photo && file_exists(storage_path('app/public/' . $teacher->photo))) {
                unlink(storage_path('app/public/' . $teacher->photo));
            }

            $file = $request->file('photo');
            $fileName = 'teacher_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/teachers'), $fileName);
            $validated['photo'] = 'teachers/' . $fileName;
        }

        $teacher->update($validated);

        return redirect()->route('admin.teacher.index')->with('success', 'Data Guru/Staf berhasil diperbarui.');
    }

    /**
     * Hapus data (file fisik dihapus otomatis via model hook).
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('admin.teacher.index')->with('success', 'Data Guru/Staf berhasil dihapus.');
    }
}