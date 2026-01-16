<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class SchoolScope implements Scope
{
    /**
     * Terapkan scope ke query Eloquent.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // Jika pengguna sudah login, filter data berdasarkan school_id milik user
        if (Auth::check()) {
            $user = Auth::user();
            
            // Jika user punya school_id, filter datanya.
            // Jika school_id NULL, jangan filter (Superadmin bisa lihat semua).
            if ($user->school_id !== null) {
                $builder->where($model->getTable() . '.school_id', $user->school_id);
            }
        }
    }
}
