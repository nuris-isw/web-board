<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'type'       => $this->type, // slider, home, gallery
            'order'      => $this->order,
            'category'   => $this->category,
            // Menggunakan image_path sesuai migrasi dan move()
            'image_url'  => $this->image_path ? asset('storage/' . $this->image_path) : null,
            'created_at' => $this->created_at->format('d M Y'),
        ];
    }
}
