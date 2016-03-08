<?php

namespace App\Http\Controllers\API;

use App\Transformers\CourseTransformer;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests;
use App\Course;
use Response;

class ApiCoursesController extends ApiController {
    /*
     * @var Transformers\CourseTransformer
     */
    protected $courseTransformer;

    function __construct(CourseTransformer $courseTransformer)
    {
        $this->middleware('jwt.auth', ['except' => ['index']]);
        $this->middleware('jwt.refresh', ['except' => 'index']);
        $this->courseTransformer = $courseTransformer;
    }

    /**
     * Get a list of all courses.
     * TODO: Pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $courses = Course::all();

        return $this->respond([
            'data' => $this->courseTransformer->transformCollection($courses->all())
        ]);
    }

    /**
     * Get the specified course.
     *
     * @param Course $course
     * @return \Illuminate\Http\JsonResponse
     */
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