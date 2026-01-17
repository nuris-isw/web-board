<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AchievementController extends Controller
{
    public function index(Request $request)
    {
        $query = Achievement::latest();

        // Filter berdasarkan tipe jika ada
        if ($request->has('type') && $request->type != '') {
            $query->where('achievement_type', $request->type);
        }

        $achievements = $query->paginate(10);
        return view('admin.achievement.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.achievement.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'achievement_type' => 'required|in:siswa,guru,sekolah',
            'title' => 'required|string|max:255',
            'winner_name' => 'nullable|required_if:achievement_type,siswa,guru|string|max:255',
            'competition_name' => 'nullable|string|max:255',
            'level' => 'required|in:kecamatan,kabupaten,provinsi,nasional,internasional',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'ach_' . time() . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/achievements'), $fileName);
            $validated['image'] = 'achievements/' . $fileName;
        }

        Achievement::create($validated);

        return redirect()->route('admin.achievement.index')->with('success', 'Data prestasi berhasil ditambahkan.');
    }

    public function edit(Achievement $achievement)
    {
        return view('admin.achievement.edit', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $validated = $request->validate([
            'achievement_type' => 'required|in:siswa,guru,sekolah',
            'title' => 'required|string|max:255',
            'winner_name' => 'nullable|required_if:achievement_type,siswa,guru|string|max:255',
            'competition_name' => 'nullable|string|max:255',
            'level' => 'required|in:kecamatan,kabupaten,provinsi,nasional,internasional',
            'year' => 'required|digits:4|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($achievement->image && file_exists(storage_path('app/public/' . $achievement->image))) {
                unlink(storage_path('app/public/' . $achievement->image));
            }

            $file = $request->file('image');
            $fileName = 'ach_' . time() . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/achievements'), $fileName);
            $validated['image'] = 'achievements/' . $fileName;
        }

        $achievement->update($validated);

        return redirect()->route('admin.achievement.index')->with('success', 'Data prestasi berhasil diperbarui.');
    }

    public function destroy(Achievement $achievement)
    {
        // File fisik terhapus otomatis via Model Deleting Hook
        $achievement->delete();
        return redirect()->route('admin.achievement.index')->with('success', 'Data prestasi berhasil dihapus.');
    }
}
