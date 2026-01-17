<?php

namespace App\Models;

use App\Models\Scopes\SchoolScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    protected $fillable = ['school_id', 'name', 'nip', 'position', 'type', 'photo', 'order', 'is_active'];

    protected static function booted(): void
    {
        static::addGlobalScope(new \App\Models\Scopes\SchoolScope);

        static::creating(function ($model) {
            if (empty($model->school_id) && auth()->check()) {
                $model->school_id = auth()->user()->school_id;
            }
        });

        static::deleting(function ($model) {
            if ($model->photo && file_exists(storage_path('app/public/' . $model->photo))) {
                unlink(storage_path('app/public/' . $model->photo));
            }
        });
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
