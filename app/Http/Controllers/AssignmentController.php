<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Unit;
use App\Assignment;
use App\UserAssignment;
use App\File;
use App\UserFile;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    /**
     * Show the unit assignments page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $unit = Unit::find($request->unit_id);
        $assignments = Assignment::where('unit_id', $unit->id)->get();
        foreach ($assignments as $assignment)
        {
            $assignment->submit_by_date_format = Carbon::parse($assignment->submit_by_date)->toDateString();
            $assignment->files = File::where('user_id', null)
                                        ->where('assignment_id', $assignment->id)
                                        ->get();
        }
        $data['unit'] = $unit;
        $data['assignments'] = $assignments;
        return view('unit_assignments', ['data' => $data]);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);
        $assignment = Assignment::find($request->assignment_id);
        $assignment = $this->getAssignment($user, $assignment);

        $data['unit'] = $unit;
        $data['assignment'] = $assignment;

        return view('unit_assignment', ['data' => $data]);
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);
        $assignment = Assignment::find($request->assignment_id);
        if ($request->file_type == "document")
        {
            $url = "https://drive.google.com/subsection_file/d/0B4OsqsghY0urbFlsX1VzLW9INlU/preview";
        }
        else
        {
            $url = null;
        }
        $file = File::create([
            'assignment_id' => $assignment->id,
            'name' => $request->file_name,
            'type' => $request->file_type,
            'extension' => $request->file_extension,
            'url' => $url,
        ]);
        $user_file = UserFile::create([
            'user_id' => $user->id, 
            'file_id' => $file->id,
            'completed' => 0,
            'downloaded' => 0,
            'uploaded' => 1,
        ]);
        $user_assignment = UserAssignment::where('student_id', $user->id)
                                            ->where('assignment_id', $assignment->id)
                                            ->update([
                                                'staff_id' => 2,
                                                'submitted_at' => Carbon::now(),
                                                'grade' => rand(0, 100),
                                                'grade_comment' => $request->file_name . '_comment',
                                                'graded_at' => Carbon::now(),
                                            ]);
        $assignment = $this->getAssignment($user, $assignment);

        $data['unit'] = $unit;
        $data['assignment'] = $assignment;
        
        return view('unit_assignment', ['data' => $data]);
    }

    /**
     * Get unit assignment
     *
     * @return App\Assignment
     */
    public function getAssignment($user, $assignment)
    {
        
        $assignment->time_remaining = Carbon::parse($assignment->submit_by)->diffForHumans();
        $files = File::whereNotNull('user_id')
                    ->where('assignment_id', $assignment->id)
                    ->get();
        $assignment->files = $files;
        $user_assignment = UserAssignment::where('student_id', $user->id)
                                            ->where('assignment_id', $assignment->id)
                                            ->first();
        if ($user_assignment->graded_at != null)
        {
            $user_assignment->staff = User::find($user_assignment->staff_id);    
        }
        $file = File::where('user_id', $user->id)
                        ->where('assignment_id', $assignment->id)
                        ->first();
        if ($file != null)
        {
            $user_file = UserFile::where('user_id', $user->id)
                                        ->where('file_id', $file->id)
                                        ->first();   
            $user_file->name = $file->name;
            $user_file->type = $file->type;
            $user_file->extension = $file->extension;
        }
        else 
        {
            $user_file = null;
        }
        
        $assignment->user_assignment = $user_assignment;
        $assignment->user_file = $user_file;
        return $assignment;
    }

    /**
     * Show the assignments file.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignments_file(Request $request)
    {
        $unit = Unit::find($request->unit_id);
        $assignment = Assignment::find($request->assignment_id);
        $file = File::find($request->file_id);
        $data['unit'] = $unit;
        $data['assignment'] = $assignment;
        $data['file'] = $file;
        return view('assignments_file', ['data' => $data]);
    }

    /**
     * Show the assignment file.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignment_file(Request $request)
    {
        $unit = Unit::find($request->unit_id);
        $assignment = Assignment::find($request->assignment_id);
        $file = File::find($request->file_id);
        $data['unit'] = $unit;
        $data['assignment'] = $assignment;
        $data['file'] = $file;
        return view('assignment_file', ['data' => $data]);
    }
}
