<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AchievementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'       => $this->title,
            'date'        => $this->date->format('d M Y'),
            'description' => $this->description,
            'image_url'   => $this->image ? asset('storage/' . $this->image) : null,
        ];
    }
}
