<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Course;
use App\Unit;
use App\Section;
use App\Subsection;
use App\File;
use App\UserFile;

class DownloadController extends Controller
{
    /**
     * Show the download page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $course = Course::find($user->course_id);
        $units = Unit::where('course_id', $course->id)->get();
        foreach ($units as $unit)
        {
            $unit->sections = Section::where('unit_id', $unit->id)->get();
            foreach ($unit->sections as $section)
            {
                $section->subsections = Subsection::where('section_id', $section->id)->get();
                foreach ($section->subsections as $subsection)
                {
                    $subsection->files = File::join('user_files', 'files.id', '=', 'user_files.file_id')->where('subsection_id', $subsection->id)->get();
                }
            }    
        }
        $data['units'] = $units;
        return view('downloads', ['data' => $data]);
    }
}
