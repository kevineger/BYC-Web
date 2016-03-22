<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use App\School;

class PagesController extends Controller
{
    public function home()
    {
        $featuredSchools = School::featured()->get()->slice(0,5);
        $featuredCourses = Course::featured()->get()->slice(0,5);
        return view('pages.home', ['featuredCourses'=>$featuredCourses, 'featuredSchools'=>$featuredSchools]);
    }

    /**
     * Displays contact us page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Displays terms and conditions page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms()
    {
        return view('pages.terms');
    }

    /**
     * Displays about us page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Displays privacy policy page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privacy()
    {
        return view('pages.privacy');
    }
}
