<?php

namespace App\Http\Controllers\API;

use App\Transformers\CourseTransformer;
use App\Transformers\SchoolTransformer;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests;
use App\School;
use Response;

class ApiSchoolsController extends ApiController {
    /*
     * @var Transformers\SchoolTransformer
     */
    protected $schoolTransformer;
    protected $courseTransformer;

    function __construct(SchoolTransformer $schoolTransformer, CourseTransformer $courseTransformer)
    {
        $this->middleware('jwt.auth', ['except' => ['index']]);
        $this->middleware('jwt.refresh', ['except' => 'index']);
        $this->schoolTransformer = $schoolTransformer;
        $this->courseTransformer = $courseTransformer;
    }

    /**
     * Returns a colleciton of all schools.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $schools = School::all();

        return $this->respond([
            'data' => $this->schoolTransformer->transformCollection($schools->all())
        ]);
    }

    /**
     * Returns a single school resource.
     *
     * @param School $school
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(School $school)
    {
        // TODO: Fix error handling
        if ( !$school ) {
            return $this->respondNotFound('School does not exist.');
        }

        return $this->respond([
            'data' => $this->schoolTransformer->transform($school)
        ]);
    }

    /**
     * Returns the colleciton of courses.
     *
     * @param $school
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourses($school)
    {
        return $this->respond([
            'data' => $this->courseTransformer->transformCollection($school->courses->all())
        ]);
    }
}