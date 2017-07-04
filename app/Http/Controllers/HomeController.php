<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Course;
use App\Unit;
use App\Assignment;
use App\Section;
use App\Subsection;
use App\File;
use App\UserFile;
use Carbon\Carbon;

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
    public function home()
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
                    $subsection->files = File::where('subsection_id', $subsection->id)->get();
                }
            }
            $unit = $this->calculateUnitProgress($user, $unit);
            $assignment = Assignment::where('unit_id', $unit->id)
                                        ->orderBy('submit_by_date', 'desc')
                                        ->first();
            $unit->submit_by_date = ($assignment != null) ? Carbon::parse($assignment->submit_by_date)->toDateTimeString() : null;
        }

        $data['units'] = $units;
        
        return view('home', ['data' => $data]);
    }

    /**
     * Get unit progress.
     *
     * @return integer $unit_progress
     */
    private function calculateUnitProgress($user, $unit)
    {
        $total_unit_files = 0;
        $completed_unit_files = 0;
        foreach ($unit['sections'] as $section)
        {
            $total_section_files = 0;
            $completed_section_files = 0;
            foreach ($section->subsections as $subsection)
            {
                $total_subsection_files = 0;
                $completed_subsection_files = 0;
                foreach ($subsection->files as $file)
                {
                    $user_subsection_file = UserFile::where('user_id', $user->id)
                                                                ->where('file_id', $file->id)
                                                                ->first();
                    if ($user_subsection_file->completed)
                    {
                        $completed_subsection_files++;
                    }
                    $total_subsection_files++;

                }
                $total_section_files += $total_subsection_files;
                $completed_section_files += $completed_subsection_files;
                $subsection->progress = ($total_subsection_files > 0) ? round(($completed_subsection_files/$total_subsection_files) * 100) : 100;
            }
            $total_unit_files += $total_section_files;
            $completed_unit_files += $completed_section_files;
            $section->progress = ($total_section_files > 0) ? round($completed_section_files/$total_section_files * 100) : 100;
        }
        $unit->progress = ($total_unit_files > 0) ? round($completed_unit_files/$total_unit_files * 100) : 100;
        return $unit;
    }

    /**
     * Set unit progress.
     *
     * @return Unit $unit
     */
    private function set_unit_progress($unit, $unit_progress)
    {
        $unit->unit_progress = $unit_progress;

        return $unit;
    }
}
