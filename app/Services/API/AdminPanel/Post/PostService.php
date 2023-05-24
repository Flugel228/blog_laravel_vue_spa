<?php

namespace App\Services\API\AdminPanel\Post;

use App\Models\Image;
use App\Models\PostTag;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PostService
{

    public function store(array $data): int
    {
        if(Post::where('title', '=', $data['title'])->first())
        {
            return 409;
        }
        $name = md5(Carbon::now() . '_' . $data['preview']->getClientOriginalName()) . '.' . $data['preview']->getClientOriginalExtension();
        $data['preview'] = Storage::disk('public')->putFileAs('/images', $data['preview'], $name);
        $image = Image::create([
            'path' => $data['preview'],
            'url' => url('/storage/'.$data['preview'])
        ]);
        unset($data['preview']);
        $data['preview_id'] = $image->id;
        $tags = $data['tag_ids'];
        unset($data['tag_ids']);
        $post = Post::create($data);
        $post->tags()->attach($tags);
        return 200;
    }

    public function update(array $data, Post $post): int
    {
        $existPost = Post::where('title', '=', $data['title'])->first();
        if ($post->title !== $data['title'] && $post->title === $existPost->title)
        {
            return 409;
        }
        if (isset($data['preview'])) {
            $name = md5(Carbon::now() . '_' . $data['preview']->getClientOriginalName()) . '.' . $data['preview']->getClientOriginalExtension();
            $data['preview'] = Storage::disk('public')->putFileAs('/images', $data['preview'], $name);
            Image::where('id', '=', $post->preview_id)->update([
                'path' => $data['preview'],
                'url' => url('/storage/'.$data['preview'])
            ]);
            unset($data['preview']);
        }
        if (isset($data['tag_ids'])) {
            $tags = $data['tag_ids'];
            unset($data['tag_ids']);
            $post->tags()->sync($tags);
        } else {
            $post->tags()->sync([]);
        }
        $post->update($data);
        return 200;
    }

    public function destroy(Post $post): int
    {
        if (!Post::where('title', '=', $post->title)->first())
        {
            return 404;
        }
        $post->tags()->detach();
        $post->postComments()->delete();
        $post->likedUsers()->detach();
        $post->delete();
        return 200;
    }
}
