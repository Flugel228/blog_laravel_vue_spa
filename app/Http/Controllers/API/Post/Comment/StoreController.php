<?php

namespace App\Http\Controllers\API\Post\Comment;

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
    public function __invoke(Post $post, StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;;
        $data['post_id'] = $post->id;

        Comment::create($data);

        return response(['message' => 'The comment has been successfully created.'], 200);
    }
}
