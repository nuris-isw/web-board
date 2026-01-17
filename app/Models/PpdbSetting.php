<?php

namespace App\Models;

use App\Models\Scopes\SchoolScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpdbSetting extends Model
{
    protected $fillable = [
        'school_id', 
        'academic_year', 
        'brochure_image', 
        'contact_whatsapp', 
        'registration_link', 
        'description', 
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new SchoolScope);

        static::creating(function ($model) {
            if (empty($model->school_id) && auth()->check()) {
                $model->school_id = auth()->user()->school_id;
            }
        });

        // Hapus file brosur saat data dihapus
        static::deleting(function ($model) {
            if ($model->brochure_image && file_exists(storage_path('app/public/' . $model->brochure_image))) {
                unlink(storage_path('app/public/' . $model->brochure_image));
            }
        });
    }

    /**
     * Relasi ke Gelombang/Periode
     */
    public function periods(): HasMany
    {
        return $this->hasMany(PpdbPeriod::class)->orderBy('start_date', 'asc');
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}