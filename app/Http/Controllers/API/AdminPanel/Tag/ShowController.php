<?php

namespace App\Http\Controllers\API\AdminPanel\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class ShowController extends BaseController
{
    public function __invoke(Tag $tag)
    {
        return $tag;
    }
}
