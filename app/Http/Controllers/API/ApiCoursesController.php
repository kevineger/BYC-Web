<?php

namespace App\Http\Controllers\API;

use App\Transformers\CourseTransformer;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests;
use App\Course;
use Response;

class ApiCoursesController extends ApiController
{
    /*
     * @var Transformers\CourseTransformer
     */
    protected $courseTransformer;

    function __construct(CourseTransformer $courseTransformer)
    {
        $this->middleware('jwt.auth');
        $this->courseTransformer = $courseTransformer;
    }

    public function index()
    {
        $courses = Course::all();

        return $this->respond([
            'data' => $this->courseTransformer->transformCollection($courses->all())
        ]);
    }

    public function show(Course $course)
    {
        // TODO: Fix error handling
        if ( !$course ) {
            return $this->respondNotFound('Course does not exist.');
        }

        return $this->respond([
            'data' => $this->courseTransformer->transform($course)
        ]);
    }
}