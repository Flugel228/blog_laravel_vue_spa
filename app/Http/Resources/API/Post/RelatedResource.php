<?php

namespace App\Http\Resources\API\Post;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function Symfony\Component\Translation\t;

class RelatedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'img' => $this->image->url,
            'category' => $this->category->title,
            'likes' => $this->likedUsers->count(),
            'liked' => auth()->check() ? auth()->user()->likedPosts->contains($this->id) : false
        ];
    }
}
