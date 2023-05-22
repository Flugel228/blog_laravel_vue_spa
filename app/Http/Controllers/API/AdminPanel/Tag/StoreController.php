<?php

namespace App\Http\Controllers\API\AdminPanel\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AdminPanel\Tag\StoreRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request): Response
    {
        $data = $request->validated();
        $service = $this->service->store($data);
        if ($service === 409) {
            return response(['error' => 'The tag with this title already exists.'], 409);
        } else if ($service === 200) {
            return response(['message' => 'The tag has been successfully created.'], 200);
        } else {
            return response(['error' => 'Internal Server Error. Please prepare a
            request later or in case of a problem with our technical support.'], 500);
        }
    }
}
