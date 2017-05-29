<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Unit;
use App\Announcement;
use App\Assignment;
use App\Section;

class UnitController extends Controller
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
     * Show the unit page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $unit = Unit::find($request->id);
        $sections = Section::where('unit_id', $unit->id)->get();
        $data['unit'] = $unit;
        $data['sections'] = $sections;    
        return view('unit', ['data' => $data]);
    }

    /**
     * Show the unit info page.
     *
     * @return \Illuminate\Http\Response
     */
    public function info(Request $request)
    {
        $unit = Unit::find($request->unit_id);
        $data['unit'] = $unit;
        return view('unit_info', ['data' => $data]);
    }

    /**
     * Show the unit announcements page.
     *
     * @return \Illuminate\Http\Response
     */
    public function announcements(Request $request)
    {
        $unit = Unit::find($request->unit_id);
        $announcements = Announcement::where('unit_id', $unit->id)->get();
        foreach ($announcements as $announcement)
        {
            $announcement->user = User::find($announcement->user_id);
        }
        $data['unit'] = $unit;
        $data['announcements'] = $announcements;
        return view('unit_announcements', ['data' => $data]);
    }
}
