<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchoolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Akses relasi identity
        $identity = $this->identity;

        return [
            'name'      => $this->name,
            'slug'      => $this->slug,
            // Data dari tabel school_identities
            'email'     => $identity->email ?? null,
            'phone'     => $identity->phone ?? null,
            'address'   => $identity->address ?? null,
            'logo_url'  => $identity?->logo ? asset('storage/' . $identity->logo) : null,
            'vision'    => $identity->vision ?? null,
            'mission'   => $identity->mission ?? null,
            'welcome_message' => $identity->welcome_message ?? null,
            // Social Media pada migrasi Anda adalah JSON
            'social_media' => $identity->social_media ?? [
                'instagram' => null,
                'facebook'  => null,
                'youtube'   => null,
                'tiktok'    => null,
            ],
            // Tema dari tabel schools
            'appearance' => $this->appearance_settings,
        ];
    }
}
