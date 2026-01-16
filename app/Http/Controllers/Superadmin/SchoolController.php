<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\User;
use App\Models\SchoolIdentity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SchoolController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:schools,name', // Tambahkan unique:schools,name
            'theme_type' => 'required|in:kindergarten,elementary,highschool',
        ], [
            'name.unique' => 'Nama sekolah ini sudah terdaftar di sistem.'
        ]);

        // 1. Create School
        $school = School::create([
            'uuid' => Str::uuid(),
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'theme_type' => $validated['theme_type'],
            'appearance_settings' => [
                'color_mode' => 'preset',
                'colors' => [
                    'primary' => '#1e40af',
                    'secondary' => '#3b82f6',
                    'accent' => '#f59e0b',
                    'background' => '#ffffff'
                ]
            ],
        ]);

        // 2. Inisialisasi Identitas (biar tidak error saat diakses)
        SchoolIdentity::create([
            'school_id' => $school->id, // Masukkan ID secara eksplisit
            'vision' => 'Visi belum diatur',
            'mission' => 'Misi belum diatur',
            'address' => '-',
            'email' => '-',
            'phone' => '-',
        ]);

        return back()->with('success', 'Sekolah ' . $school->name . ' berhasil ditambahkan.');
    }

    public function show(School $school)
    {
        // Kita load relasi identity agar bisa ditampilkan di detail
        $school->load('identity');
        
        // Kita juga ambil user yang terikat dengan sekolah ini
        $admins = \App\Models\User::where('school_id', $school->id)->get();

        return view('superadmin.schools.show', compact('school', 'admins'));
    }

    public function storeAdmin(Request $request, School $school)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_id' => $school->id, // Mengunci user ke sekolah ini
        ]);

        return back()->with('success', 'Akun admin berhasil dibuat untuk ' . $school->name);
    }
}
