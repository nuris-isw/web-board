<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolIdentity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolIdentityController extends Controller
{
    public function edit()
    {
        // Ambil identitas sekolah milik user yang sedang login
        $identity = SchoolIdentity::where('school_id', Auth::user()->school_id)->firstOrFail();
        return view('admin.identity.edit', compact('identity'));
    }

    public function update(Request $request)
    {
        $identity = SchoolIdentity::where('school_id', Auth::user()->school_id)->firstOrFail();

        $validated = $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'welcome_message' => 'nullable|string',
            'headmaster_name' => 'nullable|string|max:255',
            'history' => 'nullable|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'curriculum' => 'nullable|string',
            'google_maps' => 'nullable|string', // Untuk Iframe
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'headmaster_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'social_media' => 'nullable|array',
            'social_media.instagram' => 'nullable|url',
            'social_media.facebook' => 'nullable|url',
            'social_media.youtube' => 'nullable|url',
            'social_media.twitter' => 'nullable|url',
        ]);

        // --- Handle Upload Logo ---
        if ($request->hasFile('logo')) {
            if ($identity->logo && file_exists(storage_path('app/public/' . $identity->logo))) {
                unlink(storage_path('app/public/' . $identity->logo));
            }
            $file = $request->file('logo');
            $fileName = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/identity'), $fileName);
            $validated['logo'] = 'identity/' . $fileName;
        }

        // --- Handle Upload Foto Kepsek ---
        if ($request->hasFile('headmaster_image')) {
            if ($identity->headmaster_image && file_exists(storage_path('app/public/' . $identity->headmaster_image))) {
                unlink(storage_path('app/public/' . $identity->headmaster_image));
            }
            $file = $request->file('headmaster_image');
            $fileName = 'kepsek_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/identity'), $fileName);
            $validated['headmaster_image'] = 'identity/' . $fileName;
        }

        $identity->update($validated);

        return redirect()->back()->with('success', 'Identitas sekolah berhasil diperbarui.');
    }
}