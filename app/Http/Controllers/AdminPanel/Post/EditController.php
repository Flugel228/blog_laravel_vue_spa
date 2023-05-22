<?php

namespace App\Http\Controllers\AdminPanel\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminPanel\Post\CategoryResource;
use App\Http\Resources\AdminPanel\Post\TagResource;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $image = Image::where('id', '=', $post->preview_id)->first();
        return view('admin.post.edit', compact('post', 'tags', 'categories', 'image'));
    }
}
