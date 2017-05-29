<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Storage;
use App\Section;
use App\Subsection;
use App\File;

class SectionController extends Controller
{
    /**
     * Show the section page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $section = Section::find($request->section_id);
        $subsections = Subsection::where('section_id', $section->id)->get();
        foreach ($subsections as $subsection)
        {
            $files = File::where('subsection_id', $subsection->id)->get();
            $subsection->files = $files;
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
    // public function file(Request $request)
    // {
    //     $file = File::find($request->file_id);
    //     $file_path = storage_path('app/public/'.$file->name.$file->extension);
    //     if ($file->type == 'video')
    //     {
    //         return Response::make(file_get_contents($file_path), 200, [
    //             'Content-Type' => 'video/mp4',
    //             'Content-Disposition' => 'inline; filename="'.$file->name.'"'
    //         ]);            
    //     }
    //     else if ($file->type == 'reading')
    //     {
    //         if ($file->extension == '.pdf')
    //         {
    //             return Response::make(file_get_contents($file_path), 200, [
    //                 'Content-Type' => 'application/pdf',
    //                 'Content-Disposition' => 'inline; filename="'.$file->name.'"'
    //             ]);
    //         }
    //         else if ($file->extension == '.docx')
    //         {
    //             return Response::make(file_get_contents($file_path), 200, [
    //                 'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    //                 'Content-Disposition' => 'inline; filename="'.$file->name.'"'
    //             ]);
    //         }
    //         else if ($file->extension == '.pptx')
    //         {
    //             return Response::make(file_get_contents($file_path), 200, [
    //                 'Content-Type' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
    //                 'Content-Disposition' => 'inline; filename="'.$file->name.'"'
    //             ]);
    //         }
    //     }
    // }

    /**
     * test.
     *
     * @return \Illuminate\Http\Response
     */
    public function file(Request $request)
    {
        $file = File::find($request->file_id);
        $data['file'] = $file;
        return view('file', ['data' => $data]);
    }
}
