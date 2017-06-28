<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Unit;
use App\Announcement;
use App\Assignment;
use App\UserAssignment;
use App\Section;
use App\Subsection;
use App\File;
use App\UserFile;
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
        $unit = Unit::find($request->unit_id);

        $unit->sections = Section::where('unit_id', $unit->id)
            ->get();
        foreach ($unit->sections as $section)
        {
            $section->subsections = Subsection::where('section_id', $section->id)
                ->get();
            foreach ($section->subsections as $subsection)
            {
                $user_subsection_files = DB::table('users')
                    ->join('user_files', 'users.id', '=', 'user_files.user_id')
                    ->join('files', 'user_files.id', '=', 'files.id')
                    ->where('users.id', $user->id)
                    ->where('files.subsection_id', $subsection->id)
                    ->get();
                $subsection->files = $user_subsection_files;
            }
        }
        $unit = $this->unit_progress($user, $unit);

        $unit->has_files = $this->unit_has_files($unit);
        foreach ($unit->sections as $section)
        {
            $section->has_files = $this->section_has_files($section);    
        }

        $unit->downloaded = $this->unit_downloaded($unit);
        foreach ($unit->sections as $section)
        {
            $section->downloaded = $this->section_downloaded($section);    
        }

        $data['unit'] = $unit;
        return view('unit', ['data' => $data]);
    }

    /**
     * Download the unit files.
     *
     * @return void
     */
    public function unit_download(Request $request)
    {
        $user = Auth::user();
        $user_unit_files = DB::table('users')
            ->join('user_files', 'users.id', '=', 'user_files.user_id')
            ->join('files', 'user_files.file_id', '=', 'files.id')
            ->join('subsections', 'files.subsection_id', '=', 'subsections.id')
            ->join('sections', 'subsections.section_id', '=', 'sections.id')
            ->join('units', 'sections.unit_id', '=', 'sections.unit_id')
            ->where('users.id', $user->id)
            ->where('units.id', $request->unit_id)
            ->update(['user_files.downloaded' => true]);
    }


    /**
     * Delete the unit files.
     *
     * @return void
     */
    public function unit_delete(Request $request)
    {
        $user = Auth::user();
        $user_unit_files = DB::table('users')
            ->join('user_files', 'users.id', '=', 'user_files.user_id')
            ->join('files', 'user_files.file_id', '=', 'files.id')
            ->join('subsections', 'files.subsection_id', '=', 'subsections.id')
            ->join('sections', 'subsections.section_id', '=', 'sections.id')
            ->join('units', 'sections.unit_id', '=', 'sections.unit_id')
            ->where('users.id', $user->id)
            ->where('units.id', $request->unit_id)
            ->update(['user_files.downloaded' => false]);
    }

    /**
     * Show the unit info page.
     *
     * @return \Illuminate\Http\Response
     */
    public function unit_info(Request $request)
    {
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);
        $user_unit_info_files = DB::table('users')
            ->join('user_files', 'users.id', '=', 'user_files.user_id')
            ->join('files', 'user_files.file_id', '=', 'files.id')
            ->where('users.id', $user->id)
            ->where('files.unit_id', $unit->id)
            ->get();
        $unit->user_unit_info_files = $user_unit_info_files;
        $data['unit'] = $unit;
        return view('unit_info', ['data' => $data]);
    }

    /**
     * Show the unit info file.
     *
     * @return \Illuminate\Http\Response
     */
    public function unit_info_file(Request $request)
    {
        $unit = Unit::find($request->unit_id);
        $file = File::find($request->file_id);     
        $data['unit'] = $unit;
        $data['file'] = $file;
        return view('unit_info_file', ['data' => $data]);
    }

    /**
     * Download the unit info file.
     *
     * @return \Illuminate\Http\Response
     */
    public function unit_info_download(Request $request)
    {
        $user = Auth::user();
        $user_unit_info_file = UserFile::where('user_id', $user->id)
            ->where('file_id', $request->file_id)
            ->first();
        $user_unit_info_file->downloaded = true;
        $user_unit_info_file->save();
    }

    /**
     * Delete the unit info file.
     *
     * @return \Illuminate\Http\Response
     */
    public function unit_info_delete(Request $request)
    {
        $user = Auth::user();
        $user_unit_info_file = UserFile::where('user_id', $user->id)
            ->where('file_id', $request->file_id)
            ->first();
        $user_unit_info_file->downloaded = false;
        $user_unit_info_file->save();
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
    private function unit_progress($user, $unit)
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

    private function unit_has_files($unit)
    {
        foreach ($unit->sections as $section)
        {
            if (!$this->section_has_files($section))
            {
                return true;
            }
        }
        return false;
    }

    private function section_has_files($section)
    {
        foreach ($section->subsections as $subsection)
        {
            if ($subsection->files->count() > 0)
            {
                return true;
            }
        }
        return false;
    }

    private function unit_downloaded($unit)
    {
        foreach ($unit->sections as $section)
        {
            if (!$this->section_downloaded($section))
            {
                return false;
            }
        }
        return true;
    }

    private function section_downloaded($section)
    {
        foreach ($section->subsections as $subsection)
        {
            if ($subsection->files->contains('downloaded', false))
            {
                return false;
            }
        }
        return true;
    }
}
