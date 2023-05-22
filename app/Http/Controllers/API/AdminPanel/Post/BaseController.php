<?php

namespace App\Http\Controllers\API\AdminPanel\Post;

use App\Http\Controllers\Controller;
use App\Services\API\AdminPanel\Post\PostService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }


}
