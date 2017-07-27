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
        $unit_files = File::where('unit_id', $request->unit_id)
            ->get();
        $user_unit_files = UserFile::where('user_id', $user->id)
            ->where('file_id', $unit_files->pluck('id'))
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
        $unit_files = File::where('unit_id', $request->unit_id)
            ->get();
        $user_unit_files = UserFile::where('user_id', $user->id)
            ->where('file_id', $unit_files->pluck('id'))
            ->update(['user_files.downloaded' => false]);
    }

    /**
     * Download the sections files.
     *
     * @return void
     */
    public function sections_download(Request $request)
    {
        $user = Auth::user();
        $sections_files = File::where('unit_id', $request->unit_id)
            ->whereNotNull('files.section_id')
            ->get();
        $sections_user_files = UserFile::where('user_id', $user->id)
            ->where('file_id', $sections_files->pluck('id'))
            ->update(['downloaded' => true]);
    }

    /**
     * Delete the sections files.
     *
     * @return void
     */
    public function sections_delete(Request $request)
    {
        $user = Auth::user();
        $sections_files = File::where('unit_id', $request->unit_id)
            ->whereNotNull('files.section_id')
            ->get();
        $sections_user_files = UserFile::where('user_id', $user->id)
            ->where('file_id', $sections_files->pluck('id'))
            ->update(['downloaded' => false]);
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
        $unit_info_files = File::where('unit_id', $request->unit_id)
            ->whereNull('subsection_id')
            ->whereNull('assignment_id')
            ->get();
        $unit_info_user_files = UserFile::where('user_id', $user->id)
            ->where('file_id', $unit_info_files->pluck('id'))
            ->update(['downloaded' => true]);
    }

    public function unit_info_delete(Request $request)
    {
        $user = Auth::user();
        $unit_info_files = File::where('unit_id', $request->unit_id)
            ->whereNull('subsection_id')
            ->whereNull('assignment_id')
            ->get();
        $unit_info_user_files = UserFile::where('user_id', $user->id)
            ->where('file_id', $unit_info_files->pluck('id'))
            ->update(['downloaded' => false]);
    }

    // Unit Info Helper Functions

    private function set_unit_info($user, $unit)
    {
        $unit_info_has_files = $this->get_unit_info_has_files($unit);
        $unit = $this->set_unit_info_has_files($unit, $unit_info_has_files);

        $unit_info_is_downloaded = $this->get_unit_info_is_downloaded($user, $unit);
        $unit = $this->set_unit_info_is_downloaded($unit, $unit_info_is_downloaded);

        $unit_info_files = $this->get_unit_info_files($unit);
        $unit = $this->set_unit_info_files($user, $unit, $unit_info_files);

        return $unit;   
    }

    private function get_unit_info_has_files($unit)
    {
        $total_files_count = File::where('files.unit_id', $unit->id)
            ->whereNull('subsection_id')
            ->whereNull('assignment_id')
            ->count();
        $unit_info_has_files = ($total_files_count > 0) ? true : false;

        return $unit_info_has_files;
    }

    private function set_unit_info_has_files($unit, $unit_info_has_files)
    {
        $unit->unit_info_has_files = $unit_info_has_files;

        return $unit;
    }

    private function get_unit_info_files($unit)
    {
        $unit_info_files = File::where('unit_id', $unit->id)
            ->whereNull('subsection_id')
            ->whereNull('assignment_id')
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
        $unit_info_file = $this->set_formatted_file_size($unit_info_file);

        $unit_info_file_is_downloaded = $this->get_unit_info_file_is_downloaded($user, $unit_info_file);
        $unit_info_file = $this->set_unit_info_file_is_downloaded($unit_info_file, $unit_info_file_is_downloaded);

        return $unit_info_file;
    }

    private function set_formatted_file_size($file)
    {
        $file->formatted_file_size = $this->format_file_size($file->size);

        return $file;
    }

    /**
     * Format file size
     *
     * @return string
     */
    private function format_file_size($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'K', 'M', 'G', 'T');   
        $formatted_file_size = round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];

        return $formatted_file_size;
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
            $announcement = $this->set_announcement($announcement);
        }
        $data['unit'] = $unit;
        $data['announcements'] = $announcements;
        return view('unit_announcements', ['data' => $data]);
    }

    private function set_announcement($announcement)
    {
        $announcement->user = User::find($announcement->user_id);
        $announcement->created_by_date = Carbon::parse($announcement->created_at)->toDateString();
        
        return $announcement;
    }

    /**
     * Show the unit announcement page.
     *
     * @return \Illuminate\Http\Response
     */
    public function announcement(Request $request)
    {
        $unit = Unit::find($request->unit_id);
        $announcement = Announcement::find($request->announcement_id);
        $announcement = $this->set_announcement($announcement);

        $data['unit'] = $unit;
        $data['announcement'] = $announcement;
        
        return view('unit_announcement', ['data' => $data]);
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

        $unit_has_files = $this->get_unit_has_files($unit);
        $unit = $this->set_unit_has_files($unit, $unit_has_files);

        $unit_is_downloaded = $this->get_unit_is_downloaded($user, $unit);
        $unit = $this->set_unit_is_downloaded($unit, $unit_is_downloaded);

        $unit_info_is_downloaded = $this->get_unit_info_is_downloaded($user, $unit);
        $unit = $this->set_unit_info_is_downloaded($unit, $unit_info_is_downloaded);

        $assignments_is_downloaded = $this->get_assignments_is_downloaded($user, $unit);
        $unit = $this->set_assignments_is_downloaded($unit, $assignments_is_downloaded);

        $sections_has_files = $this->get_sections_has_files($unit);
        $unit = $this->set_sections_has_files($unit, $sections_has_files);

        $sections_progress = $this->get_sections_progress($user, $unit);
        $unit = $this->set_sections_progress($unit, $sections_progress);

        $sections_is_downloaded = $this->get_sections_is_downloaded($user, $unit);
        $unit = $this->set_sections_is_downloaded($unit, $sections_is_downloaded);

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

    private function get_unit_has_files($unit)
    {
        $total_files_count = DB::table('files')
            ->where('files.unit_id', $unit->id)
            ->count();
        $unit_has_files = ($total_files_count > 0) ? true : false;

        return $unit_has_files;
    }

    private function set_unit_has_files($unit, $unit_has_files)
    {
        $unit->has_files = $unit_has_files;

        return $unit;
    }

    private function get_unit_is_downloaded($user, $unit)
    {
        $downloaded_unit_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', true)
            ->count();
        $total_unit_files_count = File::where('unit_id', $unit->id)
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('user_files.user_id', $user->id)
            ->count();
        $unit_is_downloaded = ($downloaded_unit_files_count == $total_unit_files_count) ? true : false;

        return $unit_is_downloaded;
    }

    private function set_unit_is_downloaded($unit, $unit_is_downloaded)
    {
        $unit->is_downloaded = $unit_is_downloaded;

        return $unit;
    }

    private function get_unit_info_is_downloaded($user, $unit)
    {
        $downloaded_unit_info_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNull('files.subsection_id')
            ->whereNull('files.assignment_id')
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', true)
            ->count();

        $total_unit_info_files_count = DB::table('files')
            ->where('files.unit_id', $unit->id)
            ->whereNull('files.subsection_id')
            ->whereNull('files.assignment_id')
            ->count();

        $unit_info_is_downloaded = ($downloaded_unit_info_files_count == $total_unit_info_files_count) ? true : false;

        return $unit_info_is_downloaded;
    }

    private function set_unit_info_is_downloaded($unit, $unit_info_is_downloaded)
    {
        $unit->unit_info_is_downloaded = $unit_info_is_downloaded;

        return $unit;
    }

    private function get_assignments_is_downloaded($user, $unit)
    {
        $downloaded_assignments_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNotNull('files.assignment_id')
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', true)
            ->count();
        $total_assignments_files_count = DB::table('files')
            ->where('files.unit_id', $unit->id)
            ->whereNotNull('files.assignment_id')
            ->count();

        $assignments_is_downloaded = ($downloaded_assignments_files_count == $total_assignments_files_count) ? true : false;

        return $assignments_is_downloaded;
    }

    private function set_assignments_is_downloaded($unit, $assignments_is_downloaded)
    {
        $unit->assignments_is_downloaded = $assignments_is_downloaded;

        return $unit;
    }

    private function get_sections_progress($user, $unit)
    {
        $completed_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNotNull('files.section_id')
            ->where('user_files.user_id', $user->id)
            ->where('completed', true)
            ->count();
        $completed_quizzes_count = DB::table('quizzes')
            ->join('user_quizzes', 'quizzes.id', '=', 'user_quizzes.quiz_id')
            ->where('quizzes.unit_id', $unit->id)
            ->whereNotNull('quizzes.section_id')
            ->where('user_quizzes.user_id', $user->id)
            ->where('user_quizzes.attempt_no', 1) // count only the first attempt 
            ->whereNotNull('submitted_at') // just in case attempt is not submitted
            ->count();
        $completed_files_quizzes_count = $completed_files_count + $completed_quizzes_count;

        $total_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNotNull('files.section_id')
            ->where('user_files.user_id', $user->id)
            ->count();
        $total_quizzes_count = Quiz::where('unit_id', $unit->id)
            ->whereNotNull('quizzes.section_id')
            ->count();
        $total_files_quizzes = $total_files_count + $total_quizzes_count;

        $sections_progress = $total_files_quizzes == 0 ? 100 : round($completed_files_quizzes_count / $total_files_quizzes * 100);

        return $sections_progress;
    }

    private function set_sections_progress($unit, $sections_progress)
    {
        $unit->sections_progress = $sections_progress;

        return $unit;
    }

    private function get_sections_is_downloaded($user, $unit)
    {
        $downloaded_sections_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNotNull('files.subsection_id')
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', true)
            ->count();
        $total_sections_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNotNull('files.subsection_id')
            ->where('user_files.user_id', $user->id)
            ->count();
        $sections_is_downloaded = ($downloaded_sections_files_count == $total_sections_files_count) ? true : false;

        return $sections_is_downloaded;
    }

    private function get_sections_has_files($unit)
    {
        $total_files_count = DB::table('files')
            ->where('files.unit_id', $unit->id)
            ->whereNotNull('section_id')
            ->count();
        $sections_has_files = ($total_files_count > 0) ? true : false;

        return $sections_has_files;
    }

    private function set_sections_has_files($unit, $sections_has_files)
    {
        $unit->sections_has_files = $sections_has_files;

        return $unit;
    }

    private function set_sections_is_downloaded($unit, $sections_is_downloaded)
    {
        $unit->sections_is_downloaded = $sections_is_downloaded;

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
            ->where('files.section_id', $section->id)
            ->where('user_files.user_id', $user->id)
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
        $downloaded_section_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.section_id', $section->id)
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', true)
            ->count();
        $total_section_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.section_id', $section->id)
            ->where('user_files.user_id', $user->id)
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
