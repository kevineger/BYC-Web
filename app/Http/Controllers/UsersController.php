<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeUserRequest;
use App\Http\Requests\UserRequest;
use App\Photo;
use App\Purchase;
use App\School;
use App\Course;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UsersController extends Controller {

    /**
     *Create a Users Controller instance
     */
    public function __construct()
    {
        $this->middleware('admin', ['only' => 'admin']);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('updateUser', $user);

        return view('user.edit', ['user' => $user]);
    }

    /**
     * Respond to AJAX calls for adding a photo to a school.
     *
     * @param $user
     * @param ChangeUserRequest $request
     * @return int
     */
    public function addPhoto($user, ChangeUserRequest $request)
    {
        $photo = $this->makePhoto($request->file('photo'));

        $user->addPhoto($photo);

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
     * @param UserRequest|Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('updateUser', $user);

        $user->update($request->all());

        return redirect()->action('UsersController@show', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy(User $user)
    {
        $this->authorize('updateUser', $user);

        $user->delete();

        return redirect()->action('SchoolsController@index');
    }

    /**
     * Displays admin page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin()
    {
        $users = User::all();
        $schools = School::all();
        $courses = Course::all();
        $purchases = Purchase::all();
        $home_banner = Banner::findByName('home');
        $school_banner = Banner::findByName('school');
        $course_banner = Banner::findByName('course');

        return view('user.admin', [
            'users'         => $users,
            'schools'       => $schools,
            'courses'       => $courses,
            'purchases'     => $purchases,
            'home_banner'   => $home_banner,
            'school_banner' => $school_banner,
            'course_banner' => $course_banner
        ]);
    }

    /**
     * Update school feature
     *
     * @param School $school
     * @return \Illuminate\Http\RedirectResponse
     */
    public function featureSchool(School $school)
    {
        if (!$this->authorize('update', $school))
        {
            return "You are not authorized";
        }

        $school->featured = !$school->featured;
        $school->save();

        return "Successfully set school" . $school->id . " featured = " . $school->featured;
    }


    /**
     * Update Course feature.
     *
     * @param Course $course
     * @return string
     */
    public function featureCourse(Course $course)
    {
        if (!$this->authorize('updateCourse', $course))
        {
            return "You are not authorized";
        }

        $course->featured = !$course->featured;
        $course->save();

        return "Successfully set school" . $course->id . " featured = " . $course->featured;
    }

}
