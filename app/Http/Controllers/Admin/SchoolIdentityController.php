<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolIdentity;
use Illuminate\Http\Request;

class SchoolIdentityController extends Controller
{
    public function edit()
    {
        // Global Scope otomatis memfilter identitas milik sekolah yang login
        $identity = SchoolIdentity::first();
        return view('admin.identity.edit', compact('identity'));
    }

    public function update(Request $request)
    {
        $identity = SchoolIdentity::first();

        $validated = $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'welcome_message' => 'nullable|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);

        $identity->update($validated);

        return back()->with('success', 'Identitas sekolah berhasil diperbarui.');
    }
}
