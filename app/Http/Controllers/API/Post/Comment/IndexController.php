<?php

namespace App\Http\Controllers\API\Post\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Post\Comment\IndexRequest;
use App\Http\Resources\API\Post\Comment\IndexResource;
use App\Models\Comment;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke(Post $post, IndexRequest $request)
    {
        $data = $request->validated();
        $comments = Comment::where('post_id', '=', $post->id)->latest()->paginate(15, ['*'], 'page', $data['page']);
        return IndexResource::collection($comments);
    }
}
