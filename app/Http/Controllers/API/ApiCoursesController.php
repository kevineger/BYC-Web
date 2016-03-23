<?php

namespace App\Http\Controllers\API;

use App\Transformers\CourseTransformer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Course;

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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ( sizeof($request->input()) > 0 ) {
            $courses = $this->search($request);
        } else {
            // Else display all
            $courses = Course::active()->get();
        }

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

    /**
     * Helper funciton to search for courses.
     * 
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {

        $query = Course::active();

        // Check categories
        $categories_checked = $request->get('categories');
        if ( $categories_checked ) {
            // All courses whose categories match the specified ones.
            $query->whereHas('categories', function ($q) use ($categories_checked) {
                $q->whereIn('text', $categories_checked);
            });
        }
        // Check query string
        if ( $request->get('query_string') ) {
            $query->where('name', 'LIKE', '%' . $request->get('query_string') . '%');
        }

        // Filter the specified prices
        if ( $request->get('max_price') ) {
            $query->where('price', '<=', (int)$request->get('max_price'));
        }

        // Filter by times
        $course_times = $request->get('start_time');
        if ( $course_times ) {
            $query->whereHas('times', function ($q) use ($course_times) {
                $q->where(DB::raw('TIME(start_time)'), ">=", $course_times);
            });
        }

        $course_date = $request->get('start_date');
        if ( $course_date ) {
            $query->whereHas('times', function ($q) use ($course_date) {
                $q->whereDate('beginning_date', '>=', $course_date);
            });
        }

        return $query->get();
    }
}