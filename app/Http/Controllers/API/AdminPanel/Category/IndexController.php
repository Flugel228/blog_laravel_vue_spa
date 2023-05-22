<?php

namespace App\Http\Controllers\API\AdminPanel\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AdminPanel\Category\IndexRequest;
use App\Http\Resources\API\AdminPanel\Category\IndexResource;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated();
        $category = Category::where('title', 'like', "%{$data['like']}%")->paginate(10, ['*'], 'page', $data['page']);
        return IndexResource::collection($category);
    }
}
