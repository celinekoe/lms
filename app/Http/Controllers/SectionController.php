<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Auth;
use App\Unit;
use App\Section;
use App\Subsection;
use App\SubsectionFile;
use App\UserSubsectionDownloadFile;
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
        foreach ($subsections as $subsection)
        {
            $files = SubsectionFile::where('subsection_id', $subsection->id)->get();
            $user_subsection_download_files = UserSubsectionDownloadFile::where('user_id', $user->id)
                                                                            ->where('subsection_id', $subsection->id)
                                                                            ->get();
            foreach ($files as $file)
            {
                $file->downloaded = false;
                foreach ($user_subsection_download_files as $user_subsection_download_file)
                {
                    if ($file->id == $user_subsection_download_file->id)
                    {
                        $file->downloaded = true;
                    }
                }
            }
            $subsection->files = $files;
            $quizzes = Quiz::where('subsection_id', $subsection->id)->get();
            $subsection->quizzes = $quizzes;
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
     * Download the section file.
     *
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $user = Auth::user();
        $subsection_file = SubsectionFile::find($request->file_id);
        $user_subsection_download_files = UserSubsectionDownloadFile::create([
            'user_id' => $user->id,
            'subsection_id' => $request->subsection_id,
            'name' => $subsection_file->name,
            'type' => $subsection_file->type,
            'extension' => $subsection_file->extension,
            'url' => $subsection_file->url
        ]);
    }
}
