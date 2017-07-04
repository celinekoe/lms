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
use App\Quiz;
use App\UserQuiz;
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
    public function unit(Request $request)
    {
        $user = Auth::user();

        $unit = $this->get_unit($request);
        $unit = $this->set_unit($user, $unit);

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
        $unit = $this->get_unit($request);
        $unit = $this->set_unit_info($user, $unit);
        
        $data['unit'] = $unit;
        return view('unit_info', ['data' => $data]);
    }

    public function unit_info_download(Request $request)
    {
        $user = Auth::user();

        $unit_info_files = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $request->unit_id)
            ->whereNull('files.subsection_id')
            ->where('user_files.user_id', $user->id)
            ->update(['downloaded' => true]);
    }

    public function unit_info_delete(Request $request)
    {
        $user = Auth::user();

        $unit_info_files = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $request->unit_id)
            ->whereNull('files.subsection_id')
            ->where('user_files.user_id', $user->id)
            ->update(['downloaded' => false]);
    }

    // Unit Info Helper Functions

    private function set_unit_info($user, $unit)
    {
        $unit_info_is_downloaded = $this->get_unit_info_is_downloaded($user, $user);
        $unit = $this->set_unit_info_is_downloaded($unit, $unit_info_is_downloaded);

        $unit_info_files = $this->get_unit_info_files($user, $unit);
        $unit = $this->set_unit_info_files($user, $unit, $unit_info_files);

        return $unit;   
    }

    private function get_unit_info_is_downloaded($user, $unit)
    {
        $downloaded_unit_info_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNull('files.subsection_id')
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', true)
            ->count();

        $total_unit_info_files_count = DB::table('files')
            ->where('files.unit_id', $unit->id)
            ->whereNull('files.subsection_id')
            ->count();

        $unit_info_is_downloaded = ($downloaded_unit_info_files_count == $total_unit_info_files_count) ? true : false;

        return $unit_info_is_downloaded;
    }

    private function set_unit_info_is_downloaded($unit, $unit_info_is_downloaded)
    {
        $unit->unit_info_is_downloaded = $unit_info_is_downloaded;

        return $unit;
    }

    private function get_unit_info_files($unit)
    {
        $unit_info_files = File::where('unit_id', $unit->id)
            ->whereNull('subsection_id')
            ->get();

        return $unit_info_files;
    }

    private function set_unit_info_files($user, $unit, $unit_info_files)
    {
        foreach ($unit_info_files as $unit_info_file)
        {
            $unit_info_file = $this->set_unit_info_file($user, $unit_info_file);
        }
        $unit->unit_info_files = $unit_info_files;

        return $unit;
    }

    private function set_unit_info_file($user, $unit_info_file)
    {
        $unit_info_file_is_downloaded = $this->get_unit_info_file_is_downloaded($user, $unit_info_file);
        $unit_info_file = $this->set_unit_info_file_is_downloaded($unit_info_file, $unit_info_file_is_downloaded);

        return $unit_info_file;
    }

    private function get_unit_info_file_is_downloaded($user, $unit_info_file)
    {
        $user_file = DB::table('user_files')
            ->where('user_files.user_id', $user->id)
            ->where('user_files.file_id', $unit_info_file->id)
            ->first();
        $unit_info_file_is_downloaded = $user_file->downloaded;

        return $unit_info_file_is_downloaded;
    }

    private function set_unit_info_file_is_downloaded($unit_info_file, $unit_info_file_is_downloaded)
    {
        $unit_info_file->is_downloaded = $unit_info_file_is_downloaded;

        return $unit_info_file;
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
    public function unit_info_file_download(Request $request)
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
    public function unit_info_file_delete(Request $request)
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

        // Unit Helper Functions

    private function get_unit($request)
    {
        $unit = Unit::find($request->unit_id);

        return $unit;
    }

    private function set_unit($user, $unit)
    {
        $unit_progress = $this->get_unit_progress($user, $unit);
        $unit = $this->set_unit_progress($unit, $unit_progress);

        $unit_is_downloaded = $this->get_unit_is_downloaded($user, $unit);
        $unit = $this->set_unit_is_downloaded($unit, $unit_is_downloaded);

        $sections = $this->get_sections($unit);
        $unit = $this->set_sections($user, $unit, $sections);

        return $unit;
    }

    private function get_unit_progress($user, $unit)
    {
        $completed_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->where('user_files.user_id', $user->id)
            ->where('completed', true)
            ->count();
        $completed_quizzes_count = DB::table('quizzes')
            ->join('user_quizzes', 'quizzes.id', '=', 'user_quizzes.quiz_id')
            ->where('quizzes.unit_id', $unit->id)
            ->where('user_quizzes.user_id', $user->id)
            ->where('user_quizzes.attempt_no', 1) // count only the first attempt 
            ->whereNotNull('submitted_at') // just in case attempt is not submitted
            ->count();
        $completed_files_quizzes_count = $completed_files_count + $completed_quizzes_count;

        $total_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('user_files.user_id', $user->id)
            ->where('files.unit_id', $unit->id)
            ->count();
        $total_quizzes_count = Quiz::where('unit_id', $unit->id)
            ->count();
        $total_files_quizzes = $total_files_count + $total_quizzes_count;

        $unit_progress = $total_files_quizzes == 0 ? 100 : round($completed_files_quizzes_count / $total_files_quizzes * 100);

        return $unit_progress;
    }

    private function set_unit_progress($unit, $unit_progress)
    {
        $unit->progress = $unit_progress;

        return $unit;
    }

    private function get_unit_is_downloaded($user, $unit)
    {
        $downloaded_unit_files_count = DB::table('units')
            ->join('files', 'units.id', '=', 'files.unit_id')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', true)
            ->count();
        $total_unit_files_count = DB::table('units')
            ->join('files', 'units.id', '=', 'files.unit_id')
            ->count();
        $unit_is_downloaded = ($downloaded_unit_files_count == $total_unit_files_count) ? true : false;

        return $unit_is_downloaded;
    }

    private function set_unit_is_downloaded($unit, $unit_is_downloaded)
    {
        $unit->is_downloaded = $unit_is_downloaded;

        return $unit;
    }

    private function get_sections($unit)
    {
        $sections = Section::where('unit_id', $unit->id)
            ->get();

        return $sections;
    }

    private function set_sections($user, $unit, $sections)
    {
        foreach ($sections as $section)
        {
            $section = $this->set_section($user, $section);
        }
        $unit->sections = $sections;

        return $unit;
    }

    private function set_section($user, $section)
    {
        $section_progress = $this->get_section_progress($user, $section);
        $section = $this->set_section_progress($section, $section_progress);

        $section_is_downloaded = $this->get_section_is_downloaded($user, $section);
        $section = $this->set_section_is_downloaded($section, $section_is_downloaded);

        $section_has_files = $this->get_section_has_files($user, $section);
        $section = $this->set_section_has_files($section, $section_has_files);

        return $section;
    }

    private function get_section_progress($user, $section)
    {
        $completed_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.section_id', $section->id)
            ->where('user_files.user_id', $user->id)
            ->where('completed', true)
            ->count();
        $completed_quizzes_count = DB::table('quizzes')
            ->join('user_quizzes', 'quizzes.id', '=', 'user_quizzes.quiz_id')
            ->where('quizzes.section_id', $section->id)
            ->where('user_quizzes.user_id', $user->id)
            ->where('user_quizzes.attempt_no', 1) // count only the first attempt 
            ->whereNotNull('submitted_at') // just in case attempt is not submitted
            ->count();
        $completed_files_quizzes_count = $completed_files_count + $completed_quizzes_count;

        $total_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('user_files.user_id', $user->id)
            ->where('files.section_id', $section->id)
            ->count();
        $total_quizzes_count = Quiz::where('section_id', $section->id)
            ->count();
        $total_files_quizzes = $total_files_count + $total_quizzes_count;

        $section_progress = $total_files_quizzes == 0 ? 100 : round($completed_files_quizzes_count / $total_files_quizzes * 100);

        return $section_progress;
    }

    private function set_section_progress($section, $section_progress)
    {
        $section->progress = $section_progress;

        return $section;
    }

    private function get_section_is_downloaded($user, $section)
    {
        $downloaded_section_files_count = DB::table('sections')
            ->join('files', 'sections.id', '=', 'files.section_id')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', true)
            ->count();
        $total_section_files_count = DB::table('sections')
            ->join('files', 'sections.id', '=', 'files.section_id')
            ->count();
        $section_is_downloaded = ($downloaded_section_files_count == $total_section_files_count) ? true : false;

        return $section_is_downloaded;
    }

    private function set_section_is_downloaded($section, $section_is_downloaded)
    {
        $section->is_downloaded = $section_is_downloaded;

        return $section;
    }

    private function get_section_has_files($user, $section)
    {
        $total_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('user_files.user_id', $user->id)
            ->where('files.section_id', $section->id)
            ->count();
        $section_has_files = ($total_files_count > 0) ? true : false;

        return $section_has_files;
    }

    private function set_section_has_files($section, $section_has_files)
    {
        $section->has_files = $section_has_files;

        return $section;
    }

}
