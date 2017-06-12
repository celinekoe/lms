<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Unit;
use App\Section;
use App\Subsection;
use App\SubsectionFile;
use App\UserSubsectionFile;
use App\Quiz;

class SectionController extends Controller
{
    /**
     * Show the section page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        $section = Section::find($request->section_id);
        $subsections = Subsection::where('section_id', $section->id)->get();
        $total_section_files = 0;
        $completed_section_files = 0;
        foreach ($subsections as $subsection)
        {
            $files = SubsectionFile::where('subsection_id', $subsection->id)->get();
            $user_subsection_files = UserSubsectionFile::where('user_id', $user->id)
                                                                            ->where('subsection_file_id', $subsection->id)
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
            $subsection->files = $files;
            $quizzes = Quiz::where('subsection_id', $subsection->id)->get();
            $subsection->quizzes = $quizzes;
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
        $file = SubsectionFile::find($request->file_id);
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
        $subsection_file = SubsectionFile::find($request->file_id);
        $user_subsection_file = UserSubsectionFile::where('user_id', $user->id)
                                                    ->where('subsection_file_id', $subsection_file->id)
                                                    ->first();
        $user_subsection_file->completed = true;
        $user_subsection_file->save();
        
        $section = Section::find($request->section_id);
        $subsections = Subsection::where('section_id', $section->id)->get();
        $data = $this->calculateProgress($user, $section, $subsections);
        $subsections = $data['subsections_progress'];

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
        $subsection_file = SubsectionFile::find($request->file_id);
        $user_subsection_file = UserSubsectionFile::where('user_id', $user->id)
                                                    ->where('subsection_file_id', $subsection_file->id)
                                                    ->first();
        $user_subsection_file->completed = false;
        $user_subsection_file->save();

        $section = Section::find($request->section_id);
        $subsections = Subsection::where('section_id', $section->id)->get();
        $data = $this->calculateProgress($user, $section, $subsections);
        $subsections = $data['subsections_progress'];

        return $data;
    }

    /**
     * Download the subsection file.
     *
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $user = Auth::user();
        $subsection_file = SubsectionFile::find($request->file_id);
        $user_subsection_file = UserSubsectionFile::where('user_id', $user->id)
                                                    ->where('subsection_file_id', $subsection_file->id)
                                                    ->first();
        $user_subsection_file->downloaded = true;
        $user_subsection_file->save();
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
            $files = SubsectionFile::where('subsection_id', $subsection->id)->get();
            $user_subsection_files = UserSubsectionFile::where('user_id', $user->id)
                                                                            ->where('subsection_file_id', $subsection->id)
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
