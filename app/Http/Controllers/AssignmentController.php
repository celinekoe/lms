<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the assignments page.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignments(Request $request)
    {
        $user = Auth::user();
        $unit = $this->get_unit($request);
        $unit = $this->set_unit($unit);

        $data['unit'] = $unit;
        return view('unit_assignments', ['data' => $data]);
    }

    // Assignments Page Helper Function

    private function get_unit($request)
    {
        $unit = Unit::find($request->unit_id);

        return $unit;
    }

    private function set_unit($user, $unit)
    {
        $assignments = $this->get_assignments($unit);
        $assignments = $this->set_assignments($user, $assignments);
           
        $unit->assignments = $assignments;

        return $unit;
    }

    private function get_assignments($unit)
    {
        $assignments = Assignment::where('unit_id', $unit->id)->get();

        return $assignments;
    }

    private function set_assignments($user, $assignments)
    {
        foreach ($assignments as $assignment)
        {
            $assignment = $this->set_assignment($user, $assignment);
        }

        return $assignments;
    }

    private function set_assignment($user, $assignment)
    {
        $formatted_submit_by_date = $this->format_date($assignment)
        $assignment = $this->set_submit_by_date($assignment, $formatted_submit_by_date);
        
        $assignment_files = $this->get_assignment_files($assignment);
        $assignment = $this->set_assignment_files($user, $assignment, $assignment_files);

        return $assignment;
    }

    private function format_submit_by_date($assignment)
    {
        $formatted_submit_by_date = Carbon::parse($assignment->submit_by_date)->toDateString();

        return $formatted_submit_by_date;
    }

    private function set_submit_by_date($assignment, $formatted_submit_by_date)
    {
        $assignment->formatted_submit_by_date = $formatted_submit_by_date;        

        return $assignment;
    }

    private function get_assignment_files($assignment)
    {
        $assignment_files = Files::whereNull('user_id')
            ->where('files.assignment_id', $assignment->id)
            ->get();

        return $assignment_files;
    }

    private function set_assignment_files($user, $assignment, $assignment_files)
    {
        foreach ($assignment_files as $assignment_file)
        {
            $assignment_file = $this->set_assignment_file($user, $assignment_file);
        }
        $assignment->files = $assignment_files;

        return $assignment;
    }

    private function set_assignment_file($user, $assignment_file)
    {
        $assignment_file_is_downloaded = $this->get_assignment_file_is_downloaded($user, $assignment_file);
        $assignment = $this->set_assignment_file_is_downloaded($assignment, $assignment_file_is_downloaded)

        return $assignment;
        
    }

    private function get_assignment_file_is_downloaded($user, $assignment_file)
    {
        $user_file = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.user_id')
            ->where('files.id', $assignment_file->id)
            ->where('user_files.user_id', $user->id)
            ->first();
        $assignment_file_is_downloaded = $user_file->downloaded;

        return $assignment_file_is_downloaded;
    }

    private function set_assignment_file_is_downloaded($assignment_file, $assignment_file_is_downloaded)
    {
        $assignment_file->is_downloaded = $assignment_file_is_downloaded;

        return $assignment_file;
    }

    /**
     * Show the assignment page.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Submit assignment.
     *
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);
        $assignment = Assignment::find($request->assignment_id);
        $this->submit_update($request, $user, $assignment);
        $assignment = $this->getAssignment($user, $assignment);

        $data['unit'] = $unit;
        $data['assignment'] = $assignment;
        
        // return view('unit_assignment', ['data' => $data]);
    }

    /**
     * Cancel submit assignment
     *
     * @return void
     */
    public function cancel_submit(Request $request)
    {
        $user = Auth::user();
        $user_file = UserFile::where('user_id', $user->id)
            ->where('file_id', $request->file_id)
            ->delete();
        $file = File::find($request->file_id)
            ->delete();
        $user_assignment = UserAssignment::where('student_id', $user->id)
            ->where('assignment_id', $request->assignment_id)
            ->update(['submitted_at' => null]);
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

    /**
     * Download the assignment file.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignment_download(Request $request)
    {
        $user = Auth::user();
        $user_subsection_file = UserFile::where('user_id', $user->id)
            ->where('file_id', $request->file_id)
            ->first();
        $user_subsection_file->downloaded = true;
        $user_subsection_file->save();
    }

    /**
     * Delete the assignment file.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignment_delete(Request $request)
    {
        $user = Auth::user();
        $user_subsection_file = UserFile::where('user_id', $user->id)
            ->where('file_id', $request->file_id)
            ->first();
        $user_subsection_file->downloaded = false;
        $user_subsection_file->save();
    }

    /**
     * Get dummy url
     *
     * @return string
     */
    private function url($file_type)
    {
        if ($file_type == "video")
        {
            $url = "https://drive.google.com/subsection_file/d/0B4OsqsghY0urbFlsX1VzLW9INlU/preview";
        }
        else if ($file_type == "document")
        {
            $url = "https://drive.google.com/subsection_file/d/0B4OsqsghY0urbFlsX1VzLW9INlU/preview";
        }
        else
        {
            $url = null;
        }
        return $url;
    }

    private function submit_update($request, $user, $assignment)
    {
        $url = $this->url($request->file_type);
        
        $file = File::create([
            'user_id' => $user->id,
            'assignment_id' => $assignment->id,
            'name' => $request->file_name,
            'extension' => $request->file_extension,
            'type' => $request->file_type,
            'size' => $request->file_size,
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
            ->update(['submitted_at' => Carbon::now()]);
    }
}
