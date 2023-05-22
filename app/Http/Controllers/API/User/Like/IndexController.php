<?php

namespace App\Http\Controllers\API\User\Like;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\Like\IndexRequest;
use App\Http\Resources\API\User\Like\IndexResource;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated();
        if (isset($data['category_id'])) {
            $posts = Post::whereHas('likedUsers', function($query) {
                $query->where('user_id', '=', auth()->user()->id);
            })->where('category_id', '=', $data['category_id'])->paginate(12, ['*'], 'page', $data['page']);
        }
        else {
            $posts = Post::whereHas('likedUsers', function($query) {
                $query->where('user_id', '=', auth()->user()->id);
            })->paginate(12, ['*'], 'page', $data['page']);
        }
        return IndexResource::collection($posts);
    }
}
