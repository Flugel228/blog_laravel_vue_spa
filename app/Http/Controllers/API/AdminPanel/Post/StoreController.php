<?php

namespace App\Http\Controllers\API\AdminPanel\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AdminPanel\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request): Response
    {
        $data = $request->validated();
        $service = $this->service->store($data);
        if ($service === 409) {
            return response(['error' => 'The post with this title already exists.'], 409);
        } else if ($service === 200) {
            return response(['message' => 'The post has been successfully created.'], 200);
        } else {
            return response(['error' => 'Internal Server Error. Please prepare a
            request later or in case of a problem with our technical support.'], 500);
        }
    }
}
