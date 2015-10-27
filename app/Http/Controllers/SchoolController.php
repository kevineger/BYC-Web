<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\School;

class SchoolController extends Controller {

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
        // TODO: Assign to Authenticated user
        $user = User::find(25);

        $school = $user->schools()->create($request->all());

        return redirect()->action('SchoolController@show', ['school' => $school]);
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
        return view('school.edit', ['school' => $school]);
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
        $school->update($request->all());

        return redirect()->action('SchoolController@show', ['school' => $school]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param School $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();

        return redirect()->action('SchoolController@index');
    }
}
