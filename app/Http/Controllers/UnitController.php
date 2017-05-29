<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\Section;
use App\Subsection;
use App\File;

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
     * Show the section page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $section = Section::find($request->section_id);
        $subsections = Subsection::where('section_id', $section->id)->get();
        foreach ($subsections as $subsection)
        {
            $files = File::where('subsection_id', $subsection->id)->get();
            $subsection->files = $files;
        }
        $data['section'] = $section;
        $data['subsections'] = $subsections;
        return view('section', ['data' => $data]);
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

}
