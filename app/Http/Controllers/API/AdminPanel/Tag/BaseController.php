<?php

namespace App\Http\Controllers\API\AdminPanel\Tag;

use App\Http\Controllers\Controller;
use App\Services\API\AdminPanel\Tag\TagService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public TagService $service;

    public function __construct(TagService $service)
    {
        $this->service = $service;
    }


}
