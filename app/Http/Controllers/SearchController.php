<?php

namespace App\Http\Controllers;

use App\Course;
use App\School;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller {

    /**
     * Search available schools.
     *
     * @param Request $request
     * @return mixed
     */
    public function searchSchools(Request $request)
    {
        $schools_query = School::active();
        if ($request->has('query_string'))
            $schools_query->where('name', 'LIKE', '%' . $request->get('query_string') . '%');

        return $schools_query->get();
    }

    /**
     * Search available courses.
     *
     * @param Request $request
     * @return mixed
     */
    public function searchCourses(Request $request)
    {
        $courses_query = Course::active();
        if ($request->has('query_string'))
            $courses_query->where('name', 'LIKE', '%' . $request->get('query_string') . '%');

        return $courses_query->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $featuredSchools = $this->searchSchools($request);
        $featuredCourses = $this->searchCourses($request);

        return view('pages.home', [
            'featuredCourses' => $featuredCourses,
            'featuredSchools' => $featuredSchools,
            'is_search'       => true
        ]);
    }
}
