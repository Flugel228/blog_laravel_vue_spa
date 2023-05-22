<?php

namespace App\Services\API\AdminPanel\Category;

use App\Models\Category;
use App\Models\Post;

class CategoryService
{

    public function store(array $data): int
    {
        if(Category::where('title', '=', $data['title'])->first())
        {
            return 409;
        }
        Category::create($data);
        return 200;
    }

    public function update(array $data, Category $category): int
    {
        if ($data['title'] !== $category->title and Category::where('title', '=', $data['title'])->first())
        {
            return 409;
        }
        $category->update($data);
        return 200;
    }

    public function destroy(Category $category): int
    {
        if (!Category::where('title', '=', $category->title)->first())
        {
            return 404;
        }
        Post::where('category_id', '=', $category->id)->delete();
        $category->delete();
        return 200;
    }
}
