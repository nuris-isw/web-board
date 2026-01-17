<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'      => $this->name,
            'title'     => $this->title, // Jabatan (Kepala Sekolah, Guru Mapel, dll)
            'image_url' => $this->image ? asset('storage/' . $this->image) : null,
            'order'     => $this->order,
        ];
    }
}
