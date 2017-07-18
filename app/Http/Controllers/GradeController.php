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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
     * Show the course grades page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$user = Auth::user();
    	$course = Course::find($user->course_id);
        $units = $this->get_units($course);

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
    	$gradeables = $this->get_gradeables($user, $unit);
        $unit = $this->set_unit($unit, $gradeables);

        return $gradeables;
    }

    private function get_units($course)
    {
        $units = Unit::where('course_id', $course->id)
            ->get();

        return $units;
    }

    private function get_gradeables($user, $unit)
    {
        $gradeables = [];

        $assignments = $this->get_assignments($unit);
        $assignments = $this->set_assignments($user, $assignments);
        foreach ($assignments as $assignment)
        {
            array_push($gradeables, $assignment);
        }

        $quizzes = $this->get_quizzes($unit);
        $quizzes = $this->set_quizzes($user, $quizzes);
        foreach ($quizzes as $quiz)
        {
            array_push($gradeables, $quiz);
        }

        $gradeable = new stdClass();

        $gradeable->name = 'Final Exam';
        $gradeable->weight = 40;
        $gradeable->grade = 100;
        $gradeable->weighted_grade = $gradeable->weight * $gradeable->grade/100;
        $gradeable->alphabet_grade = $this->alphabet_grade($gradeable->weighted_grade);
        array_push($gradeables, $gradeable);

        $gradeable2 = new stdClass();

        $gradeable2->name = 'Participation';
        $gradeable2->weight = 10;
        $gradeable2->grade = 100;
        $gradeable2->weighted_grade = $gradeable2->weight * $gradeable2->grade/100;
        $gradeable2->alphabet_grade = $this->alphabet_grade($gradeable2->weighted_grade);
        array_push($gradeables, $gradeable2);

        return $gradeables;
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
        $user_assignment = $this->get_user_assignment($user, $assignment);

        $assignment->grade = 0;
        if ($user_assignment != NULL )
        {
            if ($user_assignment->grade != NULL)
            {
                $assignment->grade = $user_assignment->grade;
            }
        }
        $assignment->weighted_grade = $assignment->grade * $assignment->weight/100;

        $alphabet_grade = $this->alphabet_grade($assignment->grade);
        $assignment = $this->set_assignment_alphabet_grade($assignment, $alphabet_grade);

        return $assignment;
    }

    private function get_user_assignment($user, $assignment)
    {
        $user_assignment = UserAssignment::where('student_id', $user->id)
            ->where('assignment_id', $assignment->id)
            ->first();

        return $user_assignment;
    }

    private function alphabet_grade($grade)
    {
        if ($grade >= 80)
        {
            $alphabet_grade = 'HD';
        }
        else if ($grade >= 70)
        {
            $alphabet_grade = 'D';
        }
        else if ($grade >= 60)
        {
            $alphabet_grade = 'C';
        }
        else if ($grade >= 50)
        {
            $alphabet_grade = 'P';
        }
        else
        {
            $alphabet_grade = 'N';
        }

        return $alphabet_grade;
    }

    private function set_assignment_alphabet_grade($assignment, $alphabet_grade)
    {
        $assignment->alphabet_grade = $alphabet_grade;

        return $assignment;
    }

    private function get_quizzes($unit)
    {
        $quizzes = Quiz::where('unit_id', $unit->id)->get();

        return $quizzes;
    }

    private function set_quizzes($user, $quizzes)
    {
        foreach ($quizzes as $quiz)
        {
            $quiz = $this->set_quiz($user, $quiz);
        }

        return $quizzes;
    }

    private function set_quiz($user, $quiz)
    {
        $user_quiz = $this->get_user_quiz($user, $quiz);
        $quiz->grade = 0;
        if ($user_quiz != NULL )
        {
            if ($user_quiz->grade != NULL)
            {
                $quiz->grade = $user_quiz->grade;
            }
        }
        $quiz->weighted_grade = $quiz->grade * $quiz->weight/100;

        $alphabet_grade = $this->alphabet_grade($quiz->grade);
        $quiz = $this->set_quiz_alphabet_grade($quiz, $alphabet_grade);

        return $quiz;
    }

    private function get_user_quiz($user, $quiz)
    {
        $user_quiz = UserQuiz::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->first();

        return $user_quiz;
    }

    private function set_quiz_alphabet_grade($quiz, $alphabet_grade)
    {
        $quiz->alphabet_grade = $alphabet_grade;

        return $quiz;
    }

    private function set_unit($unit, $gradeables)
    {
        $unit->grade = 0;
        foreach($gradeables as $gradeable)
        {
            $unit->grade += $gradeable->weighted_grade;
        }

        $alphabet_grade = $this->alphabet_grade($unit->grade);
        $unit = $this->set_unit_alphabet_grade($unit, $alphabet_grade);
    }

    private function set_unit_alphabet_grade($unit, $alphabet_grade)
    {
        $unit->alphabet_grade = $alphabet_grade;

        return $unit;
    }
}
