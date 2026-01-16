<?php

namespace App\Models;

use App\Models\Scopes\SchoolScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'school_id',
        'title',
        'image_path',
        'category',
    ];

    /**
     * Boot model untuk menerapkan Global Scope dan logic otomatis.
     */
    protected static function booted(): void
    {
        // 1. Filter otomatis saat memanggil data (SELECT)
        static::addGlobalScope(new SchoolScope);

        // 2. Isi otomatis school_id saat menyimpan data baru (INSERT)
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->school_id = auth()->user()->school_id;
            }
        });
    }
    
    /**
     * Relasi ke model School.
     * Foto galeri terikat pada satu sekolah tertentu.
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Helper untuk mendapatkan URL gambar yang lengkap.
     * Sangat berguna untuk kebutuhan API Frontend.
     */
    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }
}