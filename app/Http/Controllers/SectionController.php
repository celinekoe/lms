<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Storage;
use App\Unit;
use App\Section;
use App\Subsection;
use App\File;

class SectionController extends Controller
{
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
     * Show the section file.
     *
     * @return \Illuminate\Http\Response
     */
    public function file(Request $request)
    {
        $unit = Unit::find($request->unit_id);
        $section = Section::find($request->section_id);
        $file = File::find($request->file_id);
        $data['unit'] = $unit;
        $data['section'] = $section;
        $data['file'] = $file;
        return view('file', ['data' => $data]);
    }
}
