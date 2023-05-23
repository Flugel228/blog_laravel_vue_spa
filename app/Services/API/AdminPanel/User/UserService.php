<?php

namespace App\Services\API\AdminPanel\User;

use App\Models\Image;
use App\Models\PostTag;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{

    public function store(array $data): int
    {
        if (User::where('email', '=', $data['email'])->first()) {
            return 409;
        }
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return 200;
    }

    public function update(array $data, User $user): int
    {
        if ($data['email'] !== $user->email and User::where('email', '=', $data['email'])->first()) {
            return 409;
        }
        $user->update($data);
        return 200;
    }

    public function destroy(User $user): int
    {
        if (!User::where('email', '=', $user->email)->first()) {
            return 404;
        }
        $user->userComments()->delete();
        $user->likedPosts()->detach();
        $user->delete();
        return 200;
    }
}
