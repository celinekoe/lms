<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Unit;
use App\Announcement;
use App\Assignment;
use App\UserAssignment;
use App\Section;
use App\Subsection;
use App\SubsectionFile;
use App\UserSubsectionFile;
use Carbon\Carbon;

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
        $user = Auth::user();
        $unit = Unit::find($request->id);
        $unit->sections = Section::where('unit_id', $unit->id)->get();
        foreach ($unit->sections as $section)
        {
            $section->subsections = Subsection::where('section_id', $section->id)->get();
            foreach ($section->subsections as $subsection)
            {
                $subsection->files = SubsectionFile::where('subsection_id', $subsection->id)->get();
            }
        }
        $unit = $this->calculateUnitProgress($user, $unit);
        $data['unit'] = $unit;
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
            $announcement->created_by_date = Carbon::parse($announcement->created_at)->toDateString();
        }
        $data['unit'] = $unit;
        $data['announcements'] = $announcements;
        return view('unit_announcements', ['data' => $data]);
    }

    /**
     * Calculate unit progress.
     *
     * @return \Illuminate\Http\Response
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
                    $user_subsection_file = UserSubsectionFile::where('user_id', $user->id)
                                                                ->where('subsection_file_id', $file->id)
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
}
