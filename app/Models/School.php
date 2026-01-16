<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'domain',
        'theme_type',
        'appearance_settings',
        'is_active',
    ];

    /**
     * Casting tipe data otomatis untuk kolom JSON.
     */
    protected $casts = [
        'appearance_settings' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke Identitas Sekolah (Visi, Misi, Alamat, dll).
     */
    public function identity(): HasOne
    {
        return $this->hasOne(SchoolIdentity::class);
    }

    /**
     * Relasi ke Berita Sekolah.
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    /**
     * Relasi ke Galeri Foto.
     */
    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
}