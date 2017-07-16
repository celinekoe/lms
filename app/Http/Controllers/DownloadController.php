<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Course;
use App\Unit;
use App\Section;
use App\Subsection;
use App\Assignment;
use App\File;
use App\UserFile;

class DownloadController extends Controller
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
     * Show the download page.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloads(Request $request)
    {
        $user = Auth::user();
        $course = $this->get_course($user);
        $units = $this->get_units($course);
        $units = $this->set_units($user, $units);
        
        $data['units'] = $units;
        return view('downloads', ['data' => $data]);
    }

    private function get_course($user)
    {
        $course = Course::find($user->course_id);

        return $course;
    }

    private function get_units($course)
    {
        $units = Unit::where('course_id', $course->id)
            ->get();
        
        return $units;   
    }

    private function set_units($user, $units)
    {
        foreach ($units as $unit)
        {
            $unit = $this->set_unit($user, $unit);
        }

        return $units;
    }

    private function set_unit($user, $unit)
    {
        $unit_is_downloaded = $this->get_unit_is_downloaded($user, $unit);
        $unit = $this->set_unit_is_downloaded($unit, $unit_is_downloaded);

        $unit_is_downloaded = $this->get_unit_is_deleted($user, $unit);
        $unit = $this->set_unit_is_deleted($unit, $unit_is_downloaded);

        $unit_has_files = $this->get_unit_has_files($unit);
        $unit = $this->set_unit_has_files($unit, $unit_has_files);

        $unit_info_has_files = $this->get_unit_info_has_files($unit);
        $unit = $this->set_unit_info_has_files($unit, $unit_info_has_files);

        $unit_info_is_downloaded = $this->get_unit_info_is_downloaded($user, $unit);
        $unit = $this->set_unit_info_is_downloaded($unit, $unit_info_is_downloaded);

        $unit_info_is_deleted = $this->get_unit_info_is_deleted($user, $unit);
        $unit = $this->set_unit_info_is_deleted($unit, $unit_info_is_deleted);

        $assignments_has_files = $this->get_assignments_has_files($user, $unit);
        $assignment = $this->set_assignments_has_files($unit, $assignments_has_files);

        $assignments_is_downloaded = $this->get_assignments_is_downloaded($user, $unit);
        $unit = $this->set_assignments_is_downloaded($unit, $assignments_is_downloaded);

        $assignments_is_deleted = $this->get_assignments_is_deleted($user, $unit);
        $unit = $this->set_assignments_is_deleted($unit, $assignments_is_deleted);

        $sections_has_files = $this->get_sections_has_files($unit);
        $unit = $this->set_sections_has_files($unit, $sections_has_files);

        $sections_is_downloaded = $this->get_sections_is_downloaded($user, $unit);
        $unit = $this->set_sections_is_downloaded($unit, $sections_is_downloaded);

        $sections_is_deleted = $this->get_sections_is_deleted($user, $unit);
        $unit = $this->set_sections_is_deleted($unit, $sections_is_deleted);

        $assignments = $this->get_assignments($unit);
        $unit = $this->set_assignments($user, $unit, $assignments);

        $sections = $this->get_sections($unit);
        $unit = $this->set_sections($user, $unit, $sections);

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

    private function get_unit_is_deleted($user, $unit)
    {
        $deleted_unit_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', false)
            ->count();
        $total_unit_files_count = File::where('unit_id', $unit->id)
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('user_files.user_id', $user->id)
            ->count();
        $unit_is_deleted = ($deleted_unit_files_count == $total_unit_files_count) ? true : false;
        return $unit_is_deleted;
    }

    private function set_unit_is_deleted($unit, $unit_is_deleted)
    {
        $unit->is_deleted = $unit_is_deleted;

        return $unit;
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

    private function get_unit_info_is_deleted($user, $unit)
    {
        $deleted_unit_info_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNull('files.subsection_id')
            ->whereNull('files.assignment_id')
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', false)
            ->count();

        $total_unit_info_files_count = DB::table('files')
            ->where('files.unit_id', $unit->id)
            ->whereNull('files.subsection_id')
            ->whereNull('files.assignment_id')
            ->count();

        $unit_info_is_deleted = ($deleted_unit_info_files_count == $total_unit_info_files_count) ? true : false;

        return $unit_info_is_deleted;
    }

    private function set_unit_info_is_deleted($unit, $unit_info_is_deleted)
    {
        $unit->unit_info_is_deleted = $unit_info_is_deleted;

        return $unit;
    }

    private function get_assignments_has_files($user, $unit)
    {
        $total_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNotNull('files.assignment_id')
            ->where('user_files.user_id', $user->id)
            ->count();
        $assignments_has_files = ($total_files_count > 0) ? true : false;

        return $assignments_has_files;
    }

    private function set_assignments_has_files($unit, $assignments_has_files)
    {
        $unit->assignments_has_files = $assignments_has_files;

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
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNotNull('files.assignment_id')
            ->where('user_files.user_id', $user->id)
            ->count();
        $assignments_is_downloaded = ($downloaded_assignments_files_count == $total_assignments_files_count) ? true : false;

        return $assignments_is_downloaded;
    }

    private function set_assignments_is_downloaded($unit, $assignments_is_downloaded)
    {
        $unit->assignments_is_downloaded = $assignments_is_downloaded;

        return $unit;
    }

    private function get_assignments_is_deleted($user, $unit)
    {
        $deleted_assignments_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNotNull('files.assignment_id')
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', false)
            ->count();
        $total_assignments_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNotNull('files.assignment_id')
            ->where('user_files.user_id', $user->id)
            ->count();
        $assignments_is_deleted = ($deleted_assignments_files_count == $total_assignments_files_count) ? true : false;

        return $assignments_is_deleted;
    }

    private function set_assignments_is_deleted($unit, $assignments_is_deleted)
    {
        $unit->assignments_is_deleted = $assignments_is_deleted;

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

    private function set_sections_is_downloaded($unit, $sections_is_downloaded)
    {
        $unit->sections_is_downloaded = $sections_is_downloaded;

        return $unit;
    }

    private function get_sections_is_deleted($user, $unit)
    {
        $deleted_sections_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNotNull('files.subsection_id')
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', false)
            ->count();
        $total_sections_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $unit->id)
            ->whereNotNull('files.subsection_id')
            ->where('user_files.user_id', $user->id)
            ->count();
        $sections_is_deleted = ($deleted_sections_files_count == $total_sections_files_count) ? true : false;
        return $sections_is_deleted;
    }

    private function set_sections_is_deleted($unit, $sections_is_deleted)
    {
        $unit->sections_is_deleted = $sections_is_deleted;

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
        $section_has_files = $this->get_section_has_files($user, $section);
        $section = $this->set_section_has_files($section, $section_has_files);

        $section_is_downloaded = $this->get_section_is_downloaded($user, $section);
        $section = $this->set_section_is_downloaded($section, $section_is_downloaded);

        $section_is_deleted = $this->get_section_is_deleted($user, $section);
        $section = $this->set_section_is_deleted($section, $section_is_deleted);

        $subsections = $this->get_subsections($section);
        $section = $this->set_subsections($section, $subsections);

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

    private function get_section_is_deleted($user, $section)
    {
        $deleted_section_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.section_id', $section->id)
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', false)
            ->count();
        $total_section_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.section_id', $section->id)
            ->where('user_files.user_id', $user->id)
            ->count();
        $section_is_deleted = ($deleted_section_files_count == $total_section_files_count) ? true : false;

        return $section_is_deleted;
    }

    private function set_section_is_deleted($section, $section_is_deleted)
    {
        $section->is_deleted = $section_is_deleted;

        return $section;
    }


    private function get_subsections($section)
    {
        $subsections = Subsection::where('section_id', $section->id)
            ->get();
        
        return $subsections;
    }

    private function set_subsections($section, $subsections)
    {
        $section->subsections = $subsections;

        return $section;
    }

    private function get_assignments($unit)
    {
        $assignments = Assignment::where('unit_id', $unit->id)
            ->get();

        return $assignments;
    }

    private function set_assignments($user, $unit, $assignments)
    {
        $assignments_is_downloaded = $this->get_assignments_is_downloaded($user, $unit);
        $unit = $this->set_assignments_is_downloaded($unit, $assignments_is_downloaded);
        
        foreach ($assignments as $assignment)
        {
            $assignment = $this->set_assignment($user, $assignment);
        }
        $unit->assignments = $assignments;

        return $unit;
    }

    private function set_assignment($user, $assignment)
    {
        $assignment_has_files = $this->get_assignment_has_files($user, $assignment);
        $assignment = $this->set_assignment_has_files($assignment, $assignment_has_files);

        $assignment_is_downloaded = $this->get_assignment_is_downloaded($user, $assignment);
        $assignment = $this->set_assignment_is_downloaded($assignment, $assignment_is_downloaded);

        $assignment_is_deleted = $this->get_assignment_is_deleted($user, $assignment);
        $assignment = $this->set_assignment_is_deleted($assignment, $assignment_is_deleted);

        return $assignment;
    }

    private function get_assignment_has_files($user, $assignment)
    {
        $total_assignment_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $assignment->unit_id)
            ->where('files.assignment_id', $assignment->id)
            ->where('user_files.user_id', $user->id)
            ->count();

        $assignment_has_files = ($total_assignment_files_count > 0) ? true : false;

        return $assignment_has_files;
    }

    private function set_assignment_has_files($assignment, $assignment_has_files)
    {
        $assignment->has_files = $assignment_has_files;

        return $assignment;
    }

    private function get_assignment_is_downloaded($user, $assignment)
    {
        $downloaded_assignment_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $assignment->unit_id)
            ->where('files.assignment_id', $assignment->id)
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', true)
            ->count();
        $total_assignment_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $assignment->unit_id)
            ->where('files.assignment_id', $assignment->id)
            ->where('user_files.user_id', $user->id)
            ->count();

        $assignment_is_downloaded = ($downloaded_assignment_files_count == $total_assignment_files_count) ? true : false;

        return $assignment_is_downloaded;
    }

    private function set_assignment_is_downloaded($assignment, $assignment_is_downloaded)
    {
        $assignment->is_downloaded = $assignment_is_downloaded;

        return $assignment;
    }

    private function get_assignment_is_deleted($user, $assignment)
    {
        $deleted_assignment_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $assignment->unit_id)
            ->where('files.assignment_id', $assignment->id)
            ->where('user_files.user_id', $user->id)
            ->where('user_files.downloaded', false)
            ->count();
        $total_assignment_files_count = DB::table('files')
            ->join('user_files', 'files.id', '=', 'user_files.file_id')
            ->where('files.unit_id', $assignment->unit_id)
            ->where('files.assignment_id', $assignment->id)
            ->where('user_files.user_id', $user->id)
            ->count();

        $assignment_is_deleted = ($deleted_assignment_files_count == $total_assignment_files_count) ? true : false;

        return $assignment_is_deleted;
    }

    private function set_assignment_is_deleted($assignment, $assignment_is_deleted)
    {
        $assignment->is_deleted = $assignment_is_deleted;

        return $assignment;
    }
}
