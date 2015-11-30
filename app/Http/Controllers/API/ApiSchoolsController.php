<?php

namespace App\Http\Controllers\API;

use App\Transformers\SchoolTransformer;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests;
use App\School;
use Response;

class ApiSchoolsController extends ApiController
{
    /*
     * @var Transformers\SchoolTransformer
     */
    protected $schoolTransformer;

    function __construct(SchoolTransformer $schoolTransformer)
    {
        $this->middleware('jwt.auth', ['except' => ['index']]);
        $this->middleware('jwt.refresh', ['except' => 'index']);
        $this->schoolTransformer = $schoolTransformer;
    }

    public function index()
    {
        $schools = School::all();

        return $this->respond([
            'data' => $this->schoolTransformer->transformCollection($schools->all())
        ]);
    }

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
}