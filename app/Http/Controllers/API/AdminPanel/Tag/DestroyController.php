<?php

namespace App\Http\Controllers\API\AdminPanel\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DestroyController extends BaseController
{
    public function __invoke(Tag $tag): Response
    {
        $service = $this->service->destroy($tag);
        if ($service === 404) {
            return response(['error' => 'Unable to delete tag because item has already been deleted from database.'], 404);
        } else if ($service === 200) {
            return response(['message' =>  'The tag has been successfully destroyed.'], 200);
        } else {
            return response(['error' => 'Internal Server Error. Please prepare a
            request later or in case of a problem with our technical support.'], 500);
        }
    }
}
