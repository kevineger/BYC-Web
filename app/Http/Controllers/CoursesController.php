<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeCourseRequest;
use App\Http\Requests\CourseRequest;
use App\Photo;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\School;
use App\Comment;
use App\Course;
use Cart;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CoursesController extends Controller {

    /**
     * Create a new course controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('vendor', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: Only serve 'active' courses
        $courses = Course::all();

        return view('course.index', ['courses' => $courses]);
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
        return view('course.edit', ['course' => $course]);
    }

    /**
     * Respond to AJAX calls for adding a photo to a course.
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
     * Respond to AJAX calls for removing a photo of a course.
     *
     * @param Request $request
     * @return string
     */
    public function removePhoto(Request $request)
    {
        try
        {
            Photo::destroy($request->input('id'));
        } catch (Exception $e)
        {
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
        $course->update($request->all());
        if ($request->get('active')) $course->active = true;
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
        $course->delete();

        return redirect()->action('CoursesController@index');
    }

    /**
     * Add a comment to a course.
     *
     * @param Course $course
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addComment(Course $course, Request $request)
    {
        $this->validate($request, ['text'=>'required']);
        $comment = new Comment($request->all());
        auth()->user()->comments()->save($comment);
        $course->comments()->save($comment);

        return redirect()->action('CoursesController@show', ['course' => $course]);

    }

}
