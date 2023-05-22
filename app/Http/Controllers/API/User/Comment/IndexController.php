<?php

namespace App\Http\Controllers\API\User\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\Comment\IndexRequest;
use App\Http\Resources\API\User\Comment\IndexResource;
use App\Models\Comment;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated();
        $comments = Comment::where('user_id', '=', auth()->user()->id)
            ->latest()
            ->paginate(15, ['*'], 'page', $data['page']);
        return IndexResource::collection($comments);
    }
}
