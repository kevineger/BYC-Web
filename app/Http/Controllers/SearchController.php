<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\School;
use App\Course;

class SearchController extends Controller {


    /**
     * Displays view with search results.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = $request->get('q');

        $schools = School::search($query)->get();
        $courses = Course::search($query)->get();

        return view('search.index', ['schools' => $schools, 'courses' => $courses]);
    }

}
