<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('vendor');
    }
    /**
     * Displays page where vendors can manage their courses and schools
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $school = Auth::user()->school;
        $courses = $school->courses;
        return view('dashboard.show', ['school'=>$school, 'courses'=>$courses]);

    }
}
