<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'         => $this->title,
            'slug'          => $this->slug,
            'content'       => $this->content, // Isi lengkap untuk halaman detail
            'excerpt'       => Str::limit(strip_tags($this->content), 150), // Ringkasan untuk kartu berita
            'image_url'     => $this->image ? asset('storage/' . $this->image) : null,
            'published_at'  => $this->created_at->format('d M Y'),
            'author'        => $this->user->name ?? 'Admin',
        ];
    }
}
