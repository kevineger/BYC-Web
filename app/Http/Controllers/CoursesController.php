<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\School;
use App\Course;

class CoursesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * Update the specified resource in storage.
     *
     * @param CourseRequest|Request $request
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->all());

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
}
