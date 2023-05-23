<?php

namespace App\Services\API\AdminPanel\Tag;

use App\Models\PostTag;
use App\Models\Tag;

class TagService
{

    public function store(array $data): int
    {
        if(Tag::where('title', '=', $data['title'])->first())
        {
            return 409;
        }
        Tag::create($data);
        return 200;
    }

    public function update(array $data, Tag $tag): int
    {
        if ($data['title'] !== $tag->title and Tag::where('title', '=', $data['title'])->first())
        {
            return 409;
        }
        $tag->update($data);
        return 200;
    }

    public function destroy(Tag $tag): int
    {
        if (!Tag::where('title', '=', $tag->title)->first())
        {
            return 404;
        }
        $tag->posts()->detach();
        $tag->delete();
        return 200;
    }
}
