<?php

namespace App\Http\Controllers\API\AdminPanel\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ShowController extends BaseController
{
    public function __invoke(Category $category)
    {
        return $category;
    }
}
