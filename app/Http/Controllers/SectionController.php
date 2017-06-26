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

    /**
     * Show the section page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $section = Section::find($request->section_id);
        $subsections = Subsection::where('section_id', $section->id)->get();
        $total_section_files = 0;
        $completed_section_files = 0;
        $section->downloaded = true;
        foreach ($subsections as $subsection)
        {
            $files = File::where('subsection_id', $subsection->id)->get();
            $user_subsection_files = DB::table('subsections')
                ->join('files', 'subsections.id', '=', 'files.subsection_id')
                ->join('user_files', 'files.id', '=', 'user_files.file_id')
                ->join('users', 'user_files.user_id', '=', 'users.id')
                ->where('users.id', $user->id)
                ->where('subsections.id', $subsection->id)
                ->get();
            $total_subsection_files = 0;
            $completed_subsection_files = 0;
            $subsection->downloaded = true;
            foreach ($files as $file)
            {
                $total_subsection_files++;
                foreach ($user_subsection_files as $user_subsection_file)
                {
                    if ($file->id == $user_subsection_file->file_id)
                    {
                        if ($user_subsection_file->completed)
                        {
                            $completed_subsection_files++;
                        }
                        $file->completed = $user_subsection_file->completed;
                        $file->downloaded = $user_subsection_file->downloaded;
                        if ($user_subsection_file->downloaded == false)
                        {
                            $subsection->downloaded = false;
                        }
                    }
                }
            }
            $total_section_files += $total_subsection_files;
            $completed_section_files += $completed_subsection_files;
            $subsection->files = $files;
            $quizzes = Quiz::where('subsection_id', $subsection->id)->get();
            $subsection->quizzes = $quizzes;
            if ($subsection->downloaded == false)
            {
                $section->downloaded = false;
            }
        }
        $section->progress = ($total_section_files > 0) ? round($completed_section_files/$total_section_files * 100) : 100;

        $data = $this->calculateProgress($user, $section, $subsections);
        foreach ($subsections as $subsection)
        {
            foreach ($data['subsections_progress'] as $subsection_progress)
            {
                if ($subsection->id == $subsection_progress->id)
                {
                    $subsection->progress = $subsection_progress->progress;
                }
            }
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

    /**
     * Complete the subsection file.
     *
     * @return \Illuminate\Http\Response
     */
    public function complete(Request $request)
    {
        $user = Auth::user();
        $subsection_file = File::find($request->file_id);
        $user_subsection_file = UserFile::where('user_id', $user->id)
                                            ->where('file_id', $subsection_file->id)
                                            ->first();
        $user_subsection_file->completed = true;
        $user_subsection_file->save();
        
        $subsection = Subsection::find($request->subsection_id);
        $section = Section::find($request->section_id);
        $subsections = Subsection::where('section_id', $section->id)->get();
        $data = $this->calculateProgress($user, $section, $subsections);
        foreach ($data['subsections_progress'] as $subsection_progress)
        {
            if ($subsection->id == $subsection_progress->id)
            {
                $subsection->progress = $subsection_progress->progress;
            }
        }
        $data['subsection_progress'] = $subsection->progress;

        return $data;
    }

    /**
     * Incomplete the subsection file.
     *
     * @return \Illuminate\Http\Response
     */
    public function incomplete(Request $request)
    {
        $user = Auth::user();
        $subsection_file = File::find($request->file_id);
        $user_subsection_file = UserFile::where('user_id', $user->id)
                                                    ->where('file_id', $subsection_file->id)
                                                    ->first();
        $user_subsection_file->completed = false;
        $user_subsection_file->save();

        $subsection = Subsection::find($request->subsection_id);
        $section = Section::find($request->section_id);
        $subsections = Subsection::where('section_id', $section->id)->get();
        $data = $this->calculateProgress($user, $section, $subsections);
        foreach ($data['subsections_progress'] as $subsection_progress)
        {
            if ($subsection->id == $subsection_progress->id)
            {
                $subsection->progress = $subsection_progress->progress;
            }
        }
        $data['subsection_progress'] = $subsection->progress;

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
        $user_subsection_files = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->join('users', 'user_files.user_id', '=', 'users.id')
            ->where('users.id', $user->id)
            ->where('files.id', $file->id)
            ->update(['downloaded' => false]);
    }

    /**
     * Calculate section progress.
     *
     * @return \Illuminate\Http\Response
     */
    private function calculateProgress($user, $section, $subsections)
    {
        $total_section_files = 0;
        $completed_section_files = 0;
        foreach ($subsections as $subsection)
        {
            $files = File::where('subsection_id', $subsection->id)->get();
            $user_subsection_files = DB::table('subsections')
                ->join('files', 'subsections.id', '=', 'files.subsection_id')
                ->join('user_files', 'files.id', '=', 'user_files.file_id')
                ->join('users', 'user_files.user_id', '=', 'users.id')
                ->where('users.id', $user->id)
                ->where('subsections.id', $subsection->id)
                ->get();
            $total_subsection_files = 0;
            $completed_subsection_files = 0;
            foreach ($files as $file)
            {
                $total_subsection_files++;
                foreach ($user_subsection_files as $user_subsection_file)
                {
                    if ($file->id == $user_subsection_file->id)
                    {
                        if ($user_subsection_file->completed)
                        {
                            $completed_subsection_files++;
                        }
                        $file->completed = $user_subsection_file->completed;
                        $file->downloaded = $user_subsection_file->downloaded;
                    }
                }

            }
            $total_section_files += $total_subsection_files;
            $completed_section_files += $completed_subsection_files;
            $subsection->progress = ($total_subsection_files > 0) ? round($completed_subsection_files/$total_subsection_files * 100) : 100;
        }
        $section->progress = ($total_section_files > 0) ? round($completed_section_files/$total_section_files * 100) : 100;
        $data['section_progress'] = $section->progress;
        $data['subsections_progress'] = $subsections;
        return $data;
    }
}
