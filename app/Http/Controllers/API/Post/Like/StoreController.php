<?php

namespace App\Http\Controllers\API\Post\Like;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Post\Comment\StoreRequest;
use App\Http\Requests\API\Post\IndexRequest;
use App\Http\Resources\API\Post\IndexResource;
use App\Http\Resources\API\Post\RelatedResource;
use App\Http\Resources\API\Post\ShowResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Tymon\JWTAuth\Facades\JWTAuth;

class StoreController extends Controller
{
    public function __invoke(Post $post)
    {
        if (auth()->check()) {
            auth()->user()->likedPosts()->toggle($post->id);

            return response(['message' => 'The like has been successfully created or deleted.'], 200);
        }
        return response('Unauthorized', 401);
    }
}
