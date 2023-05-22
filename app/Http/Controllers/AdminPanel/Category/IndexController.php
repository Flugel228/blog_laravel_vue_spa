<?php

namespace App\Http\Controllers\AdminPanel\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('admin.category.index');
    }
}
