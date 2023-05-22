<?php

namespace App\Http\Resources\API\Post;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function Symfony\Component\Translation\t;
use Illuminate\Support\Facades\Auth;

class ShowResource extends JsonResource
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
            'content' => $this->content,
            'date' => $this->dateAsCarbon,
            'comments' => $this->postComments->count(),
            'likes' => $this->likedUsers->count(),
            'img' => $this->image->url,
            'liked' => auth()->check() ? auth()->user()->likedPosts->contains($this->id) : false
        ];
    }
}
