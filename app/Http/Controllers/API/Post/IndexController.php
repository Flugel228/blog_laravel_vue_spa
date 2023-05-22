<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Post\IndexRequest;
use App\Http\Resources\API\Post\IndexResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated();
        if (isset($data['category_id'])) {
            $posts = Post::where('category_id', '=', $data['category_id'])->latest()->paginate(12, ['*'], 'page', $data['page']);
        }
        else {
            $posts = Post::latest()->paginate(12, ['*'], 'page', $data['page']);
        }
        return IndexResource::collection($posts);
    }
}
