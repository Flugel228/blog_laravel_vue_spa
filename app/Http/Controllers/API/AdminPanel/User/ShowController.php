<?php

namespace App\Http\Controllers\API\AdminPanel\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends BaseController
{
    public function __invoke(User $user)
    {
        return response(['user' => $user]);
    }
}
