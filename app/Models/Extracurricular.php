<?php

namespace App\Models;

use App\Models\Scopes\SchoolScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Extracurricular extends Model
{
    protected $fillable = ['school_id', 'name', 'slug', 'coach', 'description', 'image'];

    protected static function booted(): void
    {
        static::addGlobalScope(new SchoolScope);

        static::creating(function ($model) {
            // Otomatisasi school_id
            if (empty($model->school_id) && auth()->check()) {
                $model->school_id = auth()->user()->school_id;
            }
            // Otomatisasi Slug
            $model->slug = Str::slug($model->name) . '-' . Str::random(5);
        });

        // Hapus file fisik saat record dihapus
        static::deleting(function ($model) {
            if ($model->image && file_exists(storage_path('app/public/' . $model->image))) {
                unlink(storage_path('app/public/' . $model->image));
            }
        });
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
