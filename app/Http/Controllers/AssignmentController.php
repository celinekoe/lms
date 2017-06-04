<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Unit;
use App\Assignment;
use App\AssignmentFile;
use App\UserAssignment;
use App\UserAssignmentUploadFile;
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
        $data['unit'] = $unit;
        $data['assignments'] = $assignments;
        return view('unit_assignments', ['data' => $data]);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);
        $assignment = Assignment::find($request->assignment_id);
        $assignment->time_remaining = Carbon::parse($assignment->submit_by)->diffForHumans();
        $files = AssignmentFile::where('assignment_id', $assignment->id)->get();
        $assignment->files = $files;
        $user_assignment = UserAssignment::where('student_id', $user->id)
                                            ->where('assignment_id', $assignment->id)
                                            ->first();
        if ($user_assignment->graded_at != null)
        {
            $user_assignment->staff = User::find($user_assignment->staff_id);    
        }
        $user_upload_files = UserAssignmentUploadFile::where('user_id', $user->id)
                                                ->where('assignment_id', $assignment->id)
                                                ->first();
        $data['unit'] = $unit;
        $data['assignment'] = $assignment;
        $data['user_assignment'] = $user_assignment;
        $data['user_upload_files'] = $user_upload_files;
        return view('unit_assignment', ['data' => $data]);
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        $assignment = Assignment::find($request->assignment_id);
        if ($request->file_type == "document")
        {
            $url = "https://drive.google.com/subsection_file/d/0B4OsqsghY0urbFlsX1VzLW9INlU/preview";
        }
        else
        {
            $url = null;
        }
        $user_assignment_upload_file = UserAssignmentUploadFile::create([
            'user_id' => $user->id, 
            'assignment_id' => $assignment->id,
            'name' => $request->file_name,
            'type' => $request->file_type,
            'extension' => $request->file_extension,
            'url' => $url,
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

        $unit = Unit::find($request->unit_id);
        $assignment->time_remaining = Carbon::parse($assignment->submit_by)->diffForHumans();
        $files = AssignmentFile::where('assignment_id', $assignment->id)->get();
        $assignment->files = $files;
        $user_assignment = UserAssignment::where('student_id', $user->id)
                                            ->where('assignment_id', $assignment->id)
                                            ->first();
        if ($user_assignment->graded_at != null)
        {
            $user_assignment->staff = User::find($user_assignment->staff_id);    
        }
        $user_upload_files = UserAssignmentUploadFile::where('user_id', $user->id)
                                                ->where('assignment_id', $assignment->id)
                                                ->first();
        $data['unit'] = $unit;
        $data['assignment'] = $assignment;
        $data['user_assignment'] = $user_assignment;
        $data['user_upload_files'] = $user_upload_files;
        return view('unit_assignment', ['data' => $data]);
    }
}
