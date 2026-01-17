<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Scopes\SchoolScope;

class Achievement extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'school_id',
        'achievement_type', // siswa, guru, sekolah
        'title',
        'winner_name',
        'competition_name',
        'level',            // kecamatan, kabupaten, dll
        'year',
        'description',
        'image',
    ];

    /**
     * Boot model untuk menerapkan Global Scope dan logic otomatis.
     */
    protected static function booted(): void
    {
        // 1. Filter otomatis berdasarkan sekolah user yang login
        static::addGlobalScope(new SchoolScope);

        // 2. Isi otomatis school_id saat INSERT
        static::creating(function ($model) {
            if (empty($model->school_id) && auth()->check() && auth()->user()->school_id) {
                $model->school_id = auth()->user()->school_id;
            }
        });

        // 3. Hapus file fisik image saat record dihapus
        static::deleting(function ($model) {
            if ($model->image && file_exists(storage_path('app/public/' . $model->image))) {
                unlink(storage_path('app/public/' . $model->image));
            }
        });
    }

    /**
     * Relasi ke model School.
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
