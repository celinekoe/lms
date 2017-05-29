<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Unit;
use App\Assignment;
use App\AssignmentFile;
use App\UserAssignment;

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
        return view('user_assignments', ['data' => $data]);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);
        $assignment = Assignment::find($request->assignment_id);
        $files = AssignmentFile::where('assignment_id', $assignment->id)->get();
        $assignment->files = $files;
        $user_assignment = UserAssignment::where('student_id', $user->id)
                                            ->where('assignment_id', $assignment->id)
                                            ->first();
        $data['unit'] = $unit;
        $data['assignment'] = $assignment;
        $data['user_assignment'] = $user_assignment;
        return view('unit_assignment', ['data' => $data]);
    }
}
