<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use App\School;

class PagesController extends Controller {

    public function home()
    {
        $featuredSchools = School::where('featured', 1)->get()->slice(0, 5);
        $featuredCourses = Course::where('featured', 1)->get()->slice(0, 5);
        $banner = Banner::findByName('home');

        return view('pages.home', [
            'featuredCourses' => $featuredCourses,
            'featuredSchools' => $featuredSchools,
            'banner'          => $banner,
            'is_search'       => false
        ]);
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
