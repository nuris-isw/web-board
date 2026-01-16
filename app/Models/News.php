<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Scopes\SchoolScope;

class News extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'school_id',
        'title',
        'slug',
        'content',
        'thumbnail',
        'is_published',
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
     * Casting tipe data.
     */
    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Menggunakan 'slug' sebagai pengganti 'id' secara default 
     * saat memanggil model di Route atau API.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Relasi ke model School.
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}