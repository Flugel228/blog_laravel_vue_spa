<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $guarded = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function likedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_user_likes','post_id', 'user_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'preview_id','id');
    }

    public function postComments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function getDateAsCarbonAttribute()
    {
        return Carbon::parse($this->created_at)->format('F d,Y • H:i');
    }
}
