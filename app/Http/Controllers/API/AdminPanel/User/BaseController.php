<?php

namespace App\Http\Controllers\API\AdminPanel\User;

use App\Http\Controllers\Controller;
use App\Services\API\AdminPanel\User\UserService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


}
