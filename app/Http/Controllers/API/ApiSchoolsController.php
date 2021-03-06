<?php

namespace App\Http\Controllers\API;

use App\Transformers\CourseTransformer;
use App\Transformers\SchoolTransformer;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\School;
use App\Comment;

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
     * Returns a colleciton of schools.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ( sizeof($request->input()) > 0 ) {
            $schools = $this->search($request);

            return $this->respond([
                'data' => $schools->get()
            ]);

        } else {
            // Else display all
            $schools = School::all();

            return $this->respond([
                'data' => $this->schoolTransformer->transformCollection($schools->all())
            ]);
        }

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

    /**
     * Helper method to search for schools.
     * 
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {

        $query = School::query();
        // Check categories
        $categories_checked = $request->get('categories');
        if ( $categories_checked ) {
            // Want schools that have courses whose categories match the specified ones.
            $query->whereHas('courses', function($q1) use ($categories_checked) {
                $q1->whereHas('categories', function($q2) use ($categories_checked) {
                   $q2->whereIn('text', $categories_checked);
                });
            });
        }
        // Check query string
        if ( $request->get('query_string') ) {
            $query->where('name', 'LIKE', '%' . $request->get('query_string') . '%');
        }

        return $query;
    }

    /**
     * Add a comment to a school.
     *
     * @param School $school
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addComment(School $school, Request $request)
    {
        $this->validate($request, ['text' => 'required']);
        $comment = new Comment($request->all());
        auth()->user()->comments()->save($comment);
        $school->comments()->save($comment);

        return $this->respond(['status' => 'success']);
    }
}