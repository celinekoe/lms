<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Course;
use App\Unit;
use App\Assignment;
use App\UserAssignment;
use App\Quiz;
use App\UserQuiz;
use StdClass;

class GradeController extends Controller
{
	/**
     * Show the course grades page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$user = Auth::user();
    	$course = Course::find($user->course_id);
        $units = Unit::where('course_id', $course->id)->get();

        foreach ($units as $unit)
        {
        	$unit->gradeables = $this->calculateGrades($user, $unit);
        	$unit->grade = 0;
        	foreach ($unit->gradeables as $gradeable)
        	{
        		$unit->grade += $gradeable->weighted_grade;
        	}
        }
        
        $data['units'] = $units;

        return view('course_grades', ['data' => $data]);
    }

    /**
     * Show the unit grades page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    	$user = Auth::user();
        $unit = Unit::find($request->unit_id);
        $gradeables = $this->calculateGrades($user, $unit);
        
        $data['unit'] = $unit;
        $data['gradeables'] = $gradeables;

        return view('unit_grades', ['data' => $data]);
    }

    /**
     * Calculate Grades
     *
     * @return Array
     */
    public function calculateGrades($user, $unit)
    {
    	$gradeables = [];

        $assignments = Assignment::where('unit_id', $unit->id)->get();
        foreach ($assignments as $assignment)
        {
            $user_assignment = UserAssignment::where('student_id', $user->id)
            									->where('assignment_id', $assignment->id)
            									->first();
            $assignment->grade = 0;
            if ($user_assignment != NULL )
            {
                if ($user_assignment->grade != NULL)
                {
                    $assignment->grade = $user_assignment->grade;
                }
            }
            $assignment->weighted_grade = $assignment->grade * $assignment->weight/100;
            array_push($gradeables, $assignment);
        }

        $quizzes = Quiz::where('unit_id', $unit->id)->get();
        foreach ($quizzes as $quiz)
        {
        	$user_quiz = UserQuiz::where('user_id', $user->id)
            						->where('quiz_id', $quiz->id)
            						->first();
        	$quiz->grade = 0;
        	if ($user_quiz != NULL )
            {
                if ($user_quiz->grade != NULL)
                {
                    $quiz->grade = $user_quiz->grade;
                }
            }
            $quiz->weighted_grade = $quiz->grade * $quiz->weight/100;
            array_push($gradeables, $quiz);
        }

        $gradeable = new stdClass();

        $gradeable->name = 'Final Exam';
        $gradeable->weight = 40;
        $gradeable->grade = 0;
        $gradeable->weighted_grade = $gradeable->weight * $gradeable->grade/100;
        array_push($gradeables, $gradeable);

        $gradeable2 = new stdClass();

        $gradeable2->name = 'Participation';
        $gradeable2->weight = 10;
        $gradeable2->grade = 0;
        $gradeable2->weighted_grade = $gradeable2->weight * $gradeable2->grade/100;
        array_push($gradeables, $gradeable2);

        $unit->grade = 0;
        foreach($gradeables as $gradeable)
        {
        	$unit->grade += $gradeable->weighted_grade;
        }

        return $gradeables;
    }
}
