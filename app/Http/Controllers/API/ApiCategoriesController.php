<?php

namespace App\Http\Controllers\API;

use App\Transformers\CategoryTransformer;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests;
use App\Category;
use Response;

class ApiCategoriesController extends ApiController {

    protected $categoryTransformer;

    function __construct(CategoryTransformer $categoryTransformer) {
        $this->categoryTransformer = $categoryTransformer;
    }

    /**
     * Get a list of all categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    function index() {
        $categories = Category::all();

        return $this->respond([
            'data' => $this->categoryTransformer->transformCollection($categories->all())
        ]);

    }

}