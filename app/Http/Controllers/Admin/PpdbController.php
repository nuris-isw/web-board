<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbSetting;
use App\Models\PpdbPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PpdbController extends Controller
{
    public function index()
    {
        $ppdbs = PpdbSetting::withCount('periods')->latest()->get();
        return view('admin.ppdb.index', compact('ppdbs'));
    }

    public function create()
    {
        return view('admin.ppdb.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'academic_year' => 'required|string|max:20',
            'brochure_image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            'contact_whatsapp' => 'nullable|string|max:20',
            'registration_link' => 'nullable|url',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('brochure_image')) {
            $file = $request->file('brochure_image');
            $fileName = 'ppdb_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/ppdb'), $fileName);
            $validated['brochure_image'] = 'ppdb/' . $fileName;
        }

        // Simpan dan ambil objeknya
        $ppdb = PpdbSetting::create($validated);

        // REDIRECT KE EDIT agar bisa lanjut isi gelombang
        return redirect()->route('admin.ppdb.edit', $ppdb->id)
                        ->with('success', 'Tahun ajaran dibuat. Silahkan tambahkan gelombang pendaftaran.');
    }

    public function edit(PpdbSetting $ppdb)
    {
        $ppdb->load('periods');
        return view('admin.ppdb.edit', compact('ppdb'));
    }

    public function update(Request $request, PpdbSetting $ppdb)
    {
        $validated = $request->validate([
            'academic_year' => 'required|string|max:20',
            'brochure_image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            'contact_whatsapp' => 'nullable|string|max:20',
            'registration_link' => 'nullable|url',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('brochure_image')) {
            if ($ppdb->brochure_image && file_exists(storage_path('app/public/' . $ppdb->brochure_image))) {
                unlink(storage_path('app/public/' . $ppdb->brochure_image));
            }
            $file = $request->file('brochure_image');
            $fileName = 'ppdb_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/ppdb'), $fileName);
            $validated['brochure_image'] = 'ppdb/' . $fileName;
        }

        $ppdb->update($validated);

        return redirect()->route('admin.ppdb.index')->with('success', 'Pengaturan PPDB diperbarui.');
    }

    public function destroy(PpdbSetting $ppdb)
    {
        $ppdb->delete(); // File fisik terhapus via Model Hook
        return redirect()->route('admin.ppdb.index')->with('success', 'Data PPDB dihapus.');
    }

    // --- Manajemen Gelombang (Periods) ---

    public function storePeriod(Request $request, PpdbSetting $ppdb)
    {
        $validated = $request->validate([
            'type' => 'required|in:1,2,3,khusus',
            'name' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status_label' => 'nullable|string|max:50',
        ]);

        $ppdb->periods()->create($validated);

        return back()->with('success', 'Gelombang pendaftaran berhasil ditambahkan.');
    }

    public function destroyPeriod(PpdbPeriod $period)
    {
        $period->delete();
        return back()->with('success', 'Gelombang berhasil dihapus.');
    }
}