<?php

namespace App\Http\Controllers\AdminPanel\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminPanel\Post\CategoryResource;
use App\Http\Resources\AdminPanel\Post\TagResource;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact('categories', 'tags'));
    }
}
