<?php

namespace App\Http\Controllers\API;

use App\Transformers\CommentTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests;
use Response;

class ApiCommentsController extends ApiController {
    /*
     * @var Transformers\CourseTransformer
     */
    protected $commentTransformer;

    function __construct(CommentTransformer $commentTransformer)
    {
        $this->middleware('jwt.auth');
        $this->middleware('jwt.refresh');
        $this->commentTransformer = $commentTransformer;
    }

    /**
     * Get the specified course.
     *
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($resource)
    {
        // TODO: Fix error handling
        if ( !$resource ) {
            return $this->respondNotFound('Course does not exist.');
        }

        return $this->respond([
            'data' => $this->commentTransformer->transformCollection($resource->comments->all())
        ]);
    }
}