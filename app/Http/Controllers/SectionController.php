<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Unit;
use App\Section;
use App\Subsection;
use App\File;
use App\UserFile;
use App\Quiz;
use App\UserQuiz;

class SectionController extends Controller
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

    public function index(Request $request)
    {
        $user = Auth::user();

        $unit = Unit::find($request->unit_id);
        $section = $this->get_section($request);
        $section = $this->set_section($user, $section);

        $data['unit'] = $unit;
        $data['section'] = $section;

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

    /**
     * Mark subsection file as complete.
     *
     * @return \Illuminate\Http\Response
     */
    public function complete(Request $request)
    {
        $user = Auth::user();
        $this->update_user_file_is_complete($user, $request);

        $section = Section::find($request->section_id);
        $section_progress = $this->get_section_progress($user, $section);
        $subsection = Subsection::find($request->subsection_id);
        $subsection_progress = $this->get_subsection_progress($user, $subsection);

        $data['section_progress'] = $section_progress;
        $data['subsection_progress'] = $subsection_progress;

        return $data;
    }

    /**
     * Mark susbection file as incomplete.
     *
     * @return \Illuminate\Http\Response
     */
    public function incomplete(Request $request)
    {
        $user = Auth::user();
        $this->update_user_file_is_incomplete($user, $request);

        $section = Section::find($request->section_id);
        $section_progress = $this->get_section_progress($user, $section);
        $subsection = Subsection::find($request->subsection_id);
        $subsection_progress = $this->get_subsection_progress($user, $subsection);

        $data['section_progress'] = $section_progress;
        $data['subsection_progress'] = $subsection_progress;

        return $data;
    }

    // Download

    /**
     * Download the section files.
     *
     * @return \Illuminate\Http\Response
     */
    public function section_download(Request $request)
    {
        $user = Auth::user();
        $section = Section::find($request->section_id);
        $subsection_ids = Subsection::where('section_id', $section->id)->pluck('id');
        $user_subsection_files = DB::table('subsections')
            ->join('files', 'subsections.id', '=', 'files.subsection_id')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->join('users', 'user_files.user_id', '=', 'users.id')
            ->where('users.id', $user->id)
            ->whereIn('subsections.id', $subsection_ids)
            ->update(['downloaded' => true]);
    }

    /**
     * Delete the section files.
     *
     * @return \Illuminate\Http\Response
     */
    public function section_delete(Request $request)
    {
        $user = Auth::user();
        $section = Section::find($request->section_id);
        $subsection_ids = Subsection::where('section_id', $section->id)->pluck('id');
        $user_subsection_files = DB::table('subsections')
            ->join('files', 'subsections.id', '=', 'files.subsection_id')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->join('users', 'user_files.user_id', '=', 'users.id')
            ->where('users.id', $user->id)
            ->whereIn('subsections.id', $subsection_ids)
            ->update(['downloaded' => false]);
    }

    /**
     * Download the subsection files.
     *
     * @return \Illuminate\Http\Response
     */
    public function subsection_download(Request $request)
    {
        $user = Auth::user();
        $subsection = Subsection::find($request->subsection_id);
        $user_subsection_files = DB::table('subsections')
            ->join('files', 'subsections.id', '=', 'files.subsection_id')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->join('users', 'user_files.user_id', '=', 'users.id')
            ->where('users.id', $user->id)
            ->where('subsections.id', $subsection->id)
            ->update(['downloaded' => true]);
    }

    /**
     * Delete the subsection files.
     *
     * @return \Illuminate\Http\Response
     */
    public function subsection_delete(Request $request)
    {
        $user = Auth::user();
        $subsection = Subsection::find($request->subsection_id);
        $user_subsection_files = DB::table('subsections')
            ->join('files', 'subsections.id', '=', 'files.subsection_id')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->join('users', 'user_files.user_id', '=', 'users.id')
            ->where('users.id', $user->id)
            ->where('subsections.id', $subsection->id)
            ->update(['downloaded' => false]);
    }

    /**
     * Download the individual file.
     *
     * @return \Illuminate\Http\Response
     */
    public function individual_download(Request $request)
    {
        $user = Auth::user();
        $file = File::find($request->file_id);
        $user_subsection_files = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->join('users', 'user_files.user_id', '=', 'users.id')
            ->where('users.id', $user->id)
            ->where('files.id', $file->id)
            ->update(['downloaded' => true]);
    }

    /**
     * Delete the individual file.
     *
     * @return \Illuminate\Http\Response
     */
    public function individual_delete(Request $request)
    {
        $user = Auth::user();
        $file = File::find($request->file_id);
        $user_file = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.id', $file->id)
            ->where('user_files.user_id', $user->id)
            ->first();
        $user_file->downloaded = false;
        $user_file->save();
    }

    // Section Page Helper Functions

    private function get_section($request)
    {
        $section = Section::find($request->section_id);

        return $section;
    }

    private function set_section($user, $section)
    {
        $section_progress = $this->get_section_progress($user, $section);
        $section = $this->set_section_progress($section, $section_progress);

        $section_has_files = $this->get_section_has_files($user, $section);
        $section = $this->set_section_has_files($section, $section_has_files);

        $section_is_downloaded = $this->get_section_is_downloaded($user, $section);
        $section = $this->set_section_is_downloaded($section, $section_is_downloaded);

        $subsections = $this->get_subsections($section);
        $section = $this->set_subsections($user, $section, $subsections);

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

    private function get_subsections($section)
    {
        $subsections = Subsection::where('section_id', $section->id)
            ->get();
        return $subsections;
    }

    private function set_subsections($user, $section, $subsections)
    {
        foreach ($subsections as $subsection)
        {
            $subsection = $this->set_subsection($user, $subsection);
        }
        $section->subsections = $subsections;

        return $section;
    }

    private function set_subsection($user, $subsection)
    {
        $subsection_progress = $this->get_subsection_progress($user, $subsection);
        $subsection = $this->set_subsection_progress($user, $subsection, $subsection_progress);
        $subsection = $this->set_subsection_is_downloaded($user, $subsection);
        
        $files = $this->get_subsection_files($subsection);
        $subsection = $this->set_subsection_files($user, $subsection, $files);
        $quizzes = $this->get_subsection_quizzes($subsection);
        $subsection = $this->set_subsection_quizzes($user, $subsection, $quizzes);

        return $subsection;
    }

    private function get_subsection_progress($user, $subsection)
    {
        $completed_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.subsection_id', $subsection->id)
            ->where('user_files.user_id', $user->id)
            ->where('completed', true)
            ->count();
        $completed_quizzes_count = DB::table('quizzes')
            ->join('user_quizzes', 'quizzes.id', '=', 'user_quizzes.quiz_id')
            ->where('quizzes.subsection_id', $subsection->id)
            ->where('user_quizzes.user_id', $user->id)
            ->where('user_quizzes.attempt_no', 1) // count only the first attempt 
            ->whereNotNull('submitted_at') // just in case attempt is not submitted
            ->count();
        $completed_files_quizzes_count = $completed_files_count + $completed_quizzes_count;

        $total_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('user_files.user_id', $user->id)
            ->where('files.subsection_id', $subsection->id)
            ->count();
        $total_quizzes_count = Quiz::where('subsection_id', $subsection->id)
            ->count();
        $total_files_quizzes = $total_files_count + $total_quizzes_count;

        $subsection_progress = $total_files_quizzes == 0 ? 100 : round($completed_files_quizzes_count / $total_files_quizzes * 100);

        return $subsection_progress;
    }

    private function set_subsection_progress($user, $subsection, $subsection_progress)
    {
        $subsection->progress = $subsection_progress;

        return $subsection;
    }

    private function set_subsection_is_downloaded($user, $subsection)
    {
        $downloaded_subsection_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.subsection_id', $subsection->id)
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', true)
            ->count();
        $total_subsection_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.subsection_id', $subsection->id)
            ->where('user_files.user_id', $user->id)
            ->count();
        $subsection->is_downloaded = ($downloaded_subsection_files_count == $total_subsection_files_count) ? true : false;
        return $subsection;
    }

    private function get_subsection_files($subsection)
    {
        $files = File::where('subsection_id', $subsection->id)
            ->get();

        return $files;
    }

    private function set_subsection_files($user, $subsection, $files)
    {
        foreach ($files as $file)
        {
            $file = $this->set_subsection_file($user, $file);
        }
        $subsection->files = $files;

        return $subsection;
    }

    private function set_subsection_file($user, $file)
    {
        $file = $this->set_formatted_file_size($file);
        $file = $this->set_file_is_complete($user, $file);
        $file = $this->set_file_is_downloaded($user, $file);

        return $file;
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

    private function set_file_is_complete($user, $file)
    {
        $user_file = UserFile::where('user_id', $user->id)
            ->where('file_id', $file->id)
            ->first();
        $file->is_complete = $user_file->completed;

        return $file;
    }

    private function set_file_is_downloaded($user, $file)
    {
        $user_file = UserFile::where('user_id', $user->id)
            ->where('file_id', $file->id)
            ->first();
        $file->is_downloaded = $user_file->downloaded;

        return $file;
    }

    private function get_subsection_quizzes($subsection)
    {
        $quizzes = Quiz::where('subsection_id', $subsection->id)
            ->get();

        return $quizzes;
    }

    private function set_subsection_quizzes($user, $subsection, $quizzes)
    {
        foreach ($quizzes as $quiz)
        {
            $quiz = $this->set_subsection_quiz($user, $quiz);
        }
        $subsection->quizzes = $quizzes;

        return $subsection;
    }

    private function set_subsection_quiz($user, $quiz)
    {
        $quiz = $this->set_quiz_is_complete($user, $quiz);

        return $quiz;
    }

    private function set_quiz_is_complete($user, $quiz)
    {
        $user_quiz = UserQuiz::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->where('attempt_no', 1)
            ->whereNotNull('submitted_at')
            ->first();
        $quiz->is_complete = ($user_quiz != null) ? true : false;

        return $quiz;
    }

    // Complete and Incomplete Helper Functions

    private function update_user_file_is_complete($user, $request)
    {
        $user_file = UserFile::where('user_id', $user->id)
            ->where('file_id', $request->file_id)
            ->first();
        $user_file->completed = true;
        $user_file->save();
    }

    private function update_user_file_is_incomplete($user, $request)
    {
        $user_file = UserFile::where('user_id', $user->id)
            ->where('file_id', $request->file_id)
            ->first();
        $user_file->completed = false;
        $user_file->save();
    }

}
