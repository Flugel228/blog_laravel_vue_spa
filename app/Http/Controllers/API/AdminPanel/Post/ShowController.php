<?php

namespace App\Http\Controllers\API\AdminPanel\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;

class ShowController extends BaseController
{
    public function __invoke(Post $post)
    {
        $image = Image::where('id', '=', $post->preview_id)->first();
        $category = Category::where('id', '=', $post->category_id)->first();
        $tags = $post->tags;
        return response(['post' => $post, 'image' => $image, 'category' => $category, 'tags' => $tags]);
    }
}
