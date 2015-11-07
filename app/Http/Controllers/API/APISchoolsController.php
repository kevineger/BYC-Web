<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\School;
use Response;

class APISchoolsController extends Controller
{
    public function index()
    {
        $schools = School::all();

        return Response::json([
//            'data' => $this->transform($schools)
            'data' => $schools->toArray()
        ], 200);
    }

    public function show(School $school)
    {
        // TODO: Fix error handling
        if ( !$school ) {
            return Response::json([
                'error' => 'School does not exist'
            ], 404)->setCallback(Request::input('callback'));
        }

        return Response::json([
            'data' => $school->toArray(),
        ], 200)->setCallback(Request::input('callback'));
    }

    private function transform($schools)
    {
        return array_map(function($school)
        {

        }, $schools->toArray());
    }
}