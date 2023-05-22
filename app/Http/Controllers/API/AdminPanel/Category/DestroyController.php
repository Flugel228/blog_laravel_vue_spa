<?php

namespace App\Http\Controllers\API\AdminPanel\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DestroyController extends BaseController
{
    public function __invoke(Category $category): Response
    {
        $service = $this->service->destroy($category);
        if ($service === 404) {
            return response(['error' => 'Unable to delete category because item has already been deleted from database.'], 404);
        } else if ($service === 200) {
            return response(['message' =>  'The category has been successfully destroyed.'], 200);
        } else {
            return response(['error' => 'Internal Server Error. Please prepare a
            request later or in case of a problem with our technical support.'], 500);
        }
    }
}
