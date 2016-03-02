<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeCourseRequest;
use App\Http\Requests\CourseRequest;
use App\Photo;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\School;
use App\Course;
use Cart;
use Input;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CoursesController extends Controller {

    /**
     * Create a new courses controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('vendor', ['except' => ['index', 'show']]);
    }

    /**
     * Limit the result set by specified search.
     * TODO: Refactor this method to a repository for modularity.
     *
     * @param Request $request
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
        $query->where('price', '>', (int)$request->get('min_price'));
        $query->where('price', '<', (int)$request->get('max_price'));

        return $query->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // If search params have been specified, filter the result set
        if ( sizeof($request->input()) > 0 ) {
            $courses = $this->search($request);
        } else {
            // Else display all
            $courses = Course::active()->get();
        }

        $categories = Category::all();

        // Course prices for filter sliders
        $cheapest = Course::cheapest();
        $most_expensive = Course::expensive();

        // Flash old input to repopulate on search
        $request->flash();

        return view('course.index', [
            'courses'        => $courses,
            'categories'     => $categories,
            'cheapest'       => $cheapest,
            'most_expensive' => $most_expensive
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $school = auth()->user()->school;

        $course = $school->courses()->create($request->all());

        return redirect()->action('CoursesController@show', ['course' => $course]);
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('course.show', ['course' => $course]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $this->authorize('updateCourse', $course);

        return view('course.edit', ['course' => $course]);
    }

    /**
     * Respond to AJAX calls for adding a photo to a school.
     *
     * @param $course
     * @param ChangeCourseRequest $request
     * @return int
     */
    public function addPhoto($course, ChangeCourseRequest $request)
    {
        $photo = $this->makePhoto($request->file('photo'));

        $course->addPhoto($photo);

        return $photo->id;
    }

    protected function makePhoto(UploadedFile $file)
    {
        return Photo::named($file->getClientOriginalName())->move($file);
    }

    /**
     * Respond to AJAX calls for removing a photo of a school.
     *
     * @param Request $request
     * @return string
     */
    public function removePhoto(Request $request)
    {
        try {
            Photo::destroy($request->input('id'));
        } catch ( Exception $e ) {
            return "Unable to remove photo: " . $request->input('id');
        }

        return "Photo " . $request->input('id') . " successfully removed.";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseRequest|Request $request
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
        $this->authorize('updateCourse', $course);

        $course->update($request->all());
        if ( $request->get('active') ) $course->active = true;
        else $course->active = false;
        $course->save();

        return redirect()->action('CoursesController@show', ['course' => $course]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Course $course)
    {
        $this->authorize('updateCourse', $course);

        $course->delete();

        return redirect()->action('CoursesController@index');
    }

}
