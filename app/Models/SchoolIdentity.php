<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Scopes\SchoolScope;

class SchoolIdentity extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     * Secara default Laravel mencari jamak, kita tegaskan di sini.
     */
    protected $table = 'school_identities';

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'school_id',
        'logo',
        'welcome_message',
        'headmaster_name',   
        'headmaster_image',
        'history',
        'vision',
        'mission',
        'curriculum',
        'address',
        'email',
        'phone',
        'social_media',
        'google_maps',
    ];

    /**
     * Casting tipe data otomatis untuk kolom JSON.
     */
    protected $casts = [
        'social_media' => 'array',
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
            // HANYA isi otomatis jika school_id kosong 
            // DAN user yang login bukan Superadmin (punya school_id)
            if (empty($model->school_id) && auth()->check() && auth()->user()->school_id) {
                $model->school_id = auth()->user()->school_id;
            }
        });
    }

    /**
     * Relasi balik ke Model School.
     * Setiap identitas hanya dimiliki oleh satu sekolah.
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}