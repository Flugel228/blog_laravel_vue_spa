<?php

namespace App\Http\Controllers\API\AdminPanel\Category;

use App\Http\Controllers\Controller;
use App\Services\API\AdminPanel\Category\CategoryService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }


}
