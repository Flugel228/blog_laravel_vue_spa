<?php

namespace App\Http\Controllers\API\AdminPanel\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AdminPanel\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UpdateController extends BaseController
{
    public function __invoke(User $user, UpdateRequest $request): Response
    {
        $data = $request->validated();
        $service = $this->service->update($data, $user);
        if ($service === 409) {
            return response(['error' => 'The user with this email already exists.'], 409);
        } else if ($service === 200) {
            return response(['message' => 'The user has been successfully updated.'], 200);
        } else {
            return response(['error' => 'Internal Server Error. Please prepare a
            request later or in case of a problem with our technical support.'], 500);
        }
    }
}
