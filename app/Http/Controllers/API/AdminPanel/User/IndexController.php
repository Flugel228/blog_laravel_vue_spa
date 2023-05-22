<?php

namespace App\Http\Controllers\API\AdminPanel\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AdminPanel\User\IndexRequest;
use App\Http\Resources\API\AdminPanel\User\IndexResource;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated();
        $tags = User::where('name', 'like', "%{$data['like']}%")->paginate(10, ['*'], 'page', $data['page']);
        return IndexResource::collection($tags);
    }
}
