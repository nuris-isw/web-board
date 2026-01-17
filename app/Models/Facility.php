<?php

namespace App\Models;

use App\Models\Scopes\SchoolScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['school_id', 'name', 'description', 'image'];

    protected static function booted(): void
    {
        static::addGlobalScope(new SchoolScope);

        static::creating(function ($model) {
            if (empty($model->school_id) && auth()->check() && auth()->user()->school_id) {
                $model->school_id = auth()->user()->school_id;
            }
        });

        // Tambahan: Hapus file fisik saat record dihapus
        static::deleting(function ($facility) {
            if ($facility->image && file_exists(storage_path('app/public/' . $facility->image))) {
                unlink(storage_path('app/public/' . $facility->image));
            }
        });
    }

    /**
     * Relasi ke School
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}