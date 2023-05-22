<?php

namespace App\Http\Controllers\API\AdminPanel\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DestroyController extends BaseController
{
    public function __invoke(Post $post): Response
    {
        $service = $this->service->destroy($post);
        if ($service === 404) {
            return response(['error' => 'Unable to delete post because item has already been deleted from database.'], 404);
        } else if ($service === 200) {
            return response(['message' =>  'The post has been successfully destroyed.'], 200);
        } else {
            return response(['error' => 'Internal Server Error. Please prepare a
            request later or in case of a problem with our technical support.'], 500);
        }
    }
}
