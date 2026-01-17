<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class PpdbPeriod extends Model
{
    protected $fillable = [
        'ppdb_setting_id', 
        'type', 
        'name', 
        'start_date', 
        'end_date', 
        'status_label', 
        'is_open'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_open' => 'boolean',
    ];

    /**
     * Relasi ke Setting PPDB Utama
     */
    public function ppdbSetting(): BelongsTo
    {
        return $this->belongsTo(PpdbSetting::class);
    }

    /**
     * Accessor untuk mengecek apakah periode saat ini sedang berjalan
     * Digunakan untuk label otomatis "Buka/Tutup" di Frontend
     */
    public function getIsRunningAttribute(): bool
    {
        $today = Carbon::today();
        return $this->is_open && $today->between($this->start_date, $this->end_date);
    }
}