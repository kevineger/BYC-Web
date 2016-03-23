<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeSchoolRequest;
use App\Http\Requests\SchoolRequest;
use App\Photo;
use App\Comment;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Course;
use App\School;
use Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class SchoolsController extends Controller {

    /**
     * Create a new Schools Controller instance
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('vendor', ['except' => ['index', 'show', 'addComment']]);
    }

    /**
     * Limit the result set by specified search.
     * TODO: Refactor this method to a repository for modularity.
     *
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $query = School::active();
        // Check categories
        $categories_checked = $request->get('categories');
        if ($categories_checked)
        {
            // All courses whose categories match the specified ones.
            $query->whereHas('categories', function ($q) use ($categories_checked)
            {
                $q->whereIn('text', $categories_checked);
            });
        }
        // Check query string
        if ($request->get('query_string'))
        {
            $query->where('name', 'LIKE', '%' . $request->get('query_string') . '%');
        }

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
        if (sizeof($request->input()) > 0)
        {
            $schools = $this->search($request);
        } else
        {
            // Else display all
            $schools = School::all();
        }

        $categories = Category::all();

        // Flash old input to repopulate on search
        $request->flash();

        return view('school.index', [
            'schools'    => $schools,
            'categories' => $categories
        ]);

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
     * @param ChangeSchoolRequest $request
     * @return int
     */
    public function addPhoto($school, ChangeSchoolRequest $request)
    {
        $photo = $this->makePhoto($request->file('photo'));

        $school->addPhoto($photo);

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
        Auth::user()->comments()->save($comment);
        $school->comments()->save($comment);

        return redirect()->action('SchoolsController@show', ['school' => $school]);

    }

}
