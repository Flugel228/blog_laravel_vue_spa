<?php

namespace App\Http\Controllers\API\AdminPanel\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AdminPanel\Post\IndexRequest;
use App\Http\Resources\API\AdminPanel\Post\IndexResource;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated();
        $tags = Post::where('title', 'like', "%{$data['like']}%")->paginate(10, ['*'], 'page', $data['page']);
        return IndexResource::collection($tags);
    }
}
