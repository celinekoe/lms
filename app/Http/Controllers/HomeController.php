<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Course;
use App\Unit;
use App\Section;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $units = [];
        if ($user->course_id != NULL)
        {
            $course = Course::find($user->course_id);
            $units = Unit::where('course_id', $course->id)->get();
        }  
        return view('home', ['units' => $units]);
    }
}
