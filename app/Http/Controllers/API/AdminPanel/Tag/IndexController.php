<?php

namespace App\Http\Controllers\API\AdminPanel\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AdminPanel\Tag\IndexRequest;
use App\Http\Resources\API\AdminPanel\Tag\IndexResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated();
        $tags = Tag::where('title', 'like', "%{$data['like']}%")->paginate(10, ['*'], 'page', $data['page']);
        return IndexResource::collection($tags);
    }
}
