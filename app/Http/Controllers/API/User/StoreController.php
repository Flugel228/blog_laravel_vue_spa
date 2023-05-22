<?php

namespace App\Http\Controllers\API\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        if (User::where('email', $data['email'])->first()){
            return response(['message' => 'The user with this email already exists.'],409);
        }
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $token = auth()->tokenById($user->id);
        return response(['message' => 'The user has been successfully created.', 'accessToken' => $token], 200);
    }
}
