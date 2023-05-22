<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Post\IndexRequest;
use App\Http\Resources\API\Post\IndexResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        return response(['categories' => $categories], 200);
    }
}
