<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PpdbResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'academic_year'     => $this->academic_year,
            'description'       => $this->description,
            'contact_whatsapp'  => $this->contact_whatsapp,
            'registration_link' => $this->registration_link,
            // Konversi path menjadi URL lengkap untuk Astro
            'brochure_image_url' => $this->brochure_image ? asset('storage/' . $this->brochure_image) : null,
            // Memanggil PpdbPeriodResource untuk bagian periods
            'periods'           => PpdbPeriodResource::collection($this->whenLoaded('periods')),
        ];
    }
}
