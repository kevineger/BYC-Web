<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolRequest;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SchoolPhoto;
use App\Course;
use App\School;
use Response;


class SchoolsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $schools = School::all();

            return view('school.index', ['schools' => $schools]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SchoolRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolRequest $request)
    {
        $school = auth()->user()->school()->create($request->all());

        return redirect()->action('SchoolsController@show', ['school' => $school]);
    }

    /**
     * Display the specified resource.
     *
     * @param School $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return view('school.show', ['school' => $school]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param School $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        $this->authorize('update', $school);

        return view('school.edit', ['school' => $school]);
    }

    /**
     * Respond to AJAX calls for adding a photo to a school.
     *
     * @param $school
     * @param Request $request
     * @return int
     */
    public function addPhoto($school, Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpeg,jpg,tiff,gif,bmp,png'
        ]);

        $photo = SchoolPhoto::fromForm($request->file('photo'));

        $school->addPhoto($photo);

        return $photo->id;
    }

    /**
     * Respond to AJAX calls for removing a photo of a school.
     *
     * @param Request $request
     * @return string
     */
    public function removePhoto(Request $request)
    {
        try
        {
            SchoolPhoto::destroy($request->input('id'));
        } catch (Exception $e)
        {
            return "Unable to remove photo: " . $request->input('id');
        }

        return "Photo " . $request->input('id') . " successfully removed.";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SchoolRequest|Request $request
     * @param School $school
     * @return \Illuminate\Http\Response
     */
    public function update(SchoolRequest $request, School $school)
    {
        $this->authorize('update', $school);

        $school->update($request->all());

        return redirect()->action('SchoolsController@show', ['school' => $school]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param School $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $this->authorize('update', $school);

        $school->delete();

        return redirect()->action('SchoolsController@index');
    }
}
