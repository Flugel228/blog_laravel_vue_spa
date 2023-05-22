<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Post\IndexRequest;
use App\Http\Resources\API\Post\IndexResource;
use App\Http\Resources\API\Post\RelatedResource;
use App\Http\Resources\API\Post\ShowResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $relatedPosts = Post::where('category_id', '=', $post->category_id)
            ->where('id', '!=', $post->id)
            ->get()
            ->take(3);
        return response(['post' => ShowResource::make($post), 'relatedPosts' => RelatedResource::collection($relatedPosts)]);
    }
}
