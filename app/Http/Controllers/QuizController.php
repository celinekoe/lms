<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Unit;
use App\Section;
use App\Subsection;
use App\Quiz;
use App\Question;
use App\UserQuiz;
use App\Option;
use App\UserQuestion;
use Carbon\Carbon;

class QuizController extends Controller
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
     * Show the quiz start page.
     *
     * @return \Illuminate\Http\Response
     */
    public function quiz_start(Request $request)
    {
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);

        $quiz = Quiz::find($request->quiz_id);
        $user_quizzes = UserQuiz::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->orderBy('attempt_no', 'asc')
            ->get();
        $quiz->user_quizzes = $user_quizzes;
        $quiz->last_attempt_no = $this->get_last_attempt_no($user, $quiz);
        $quiz->time_limit_string = $this->seconds_to_time_string($quiz->time_limit);
        $quiz->time_remaining = Carbon::parse($quiz->submit_by_date)
            ->diffForHumans();
        
        $data['unit'] = $unit;
        $data['quiz'] = $quiz;

        return view('quiz_start', ['data' => $data]);
    }

    /**
     * Show the question page.
     *
     @ @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function question(Request $request)
    {
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);
        $quiz = $this->get_quiz($user, $request);

        $question = $this->get_question($user, $quiz, $request);
        $question = $this->set_previous_next_question($quiz, $question);
        $question = $this->set_options($question);

        $data['unit'] = $unit;
        $data['quiz'] = $quiz;
        $data['question'] = $question;

        return view('question', ['data' => $data]);
    }

    /**
     * Show the quiz review page.
     *
     @ @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function quiz_review(Request $request)
    {
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);
        $quiz = $this->get_quiz($user, $request);
        $quiz = $this->set_questions($user, $quiz);

        $data['unit'] = $unit;
        $data['quiz'] = $quiz;

        return view('quiz_review', ['data' => $data]);
    }

    /**
     * Show the quiz summary page.
     *
     @ @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function quiz_summary(Request $request)
    {
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);

        $quiz = $this->get_quiz($user, $request);
        $quiz = $this->set_quiz_time_taken($quiz);
        $quiz = $this->set_questions_with_options($user, $quiz);

        $data['unit'] = $unit;
        $data['quiz'] = $quiz;

        return view('quiz_summary', ['data' => $data]);
    }

    public function start(Request $request)
    {
        $user = Auth::user();
        $quiz = Quiz::find($request->quiz_id);
        $user_quiz = $this->create_user_quiz($user, $quiz);
        $this->create_user_questions($user_quiz);
    }

    public function save(Request $request)
    {
        $user = Auth::user();
        $quiz = Quiz::find($request->quiz_id);
        $this->update_user_quiz_time_limit_remaining($user, $quiz, $request);
        $this->update_user_question($user, $quiz, $request);
    }

    /**
     * Store option, calculate grade, and show quiz end page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
        // Submit quiz
        
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);
        $quiz = $this->get_quiz($user, $request);
        $quiz = $this->set_questions($user, $quiz);

        $this->update_user_quiz_submitted_at_grade($user, $quiz);        

        $data['unit'] = $unit;
        $data['quiz'] = $quiz;
    }

    private function seconds_to_time_string($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = floor($seconds % 60);    
        
        $time_string = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
        
        return $time_string;
    }

    private function create_user_quiz($user, $quiz)
    {
        $last_attempt_no = $this->get_last_attempt_no($user, $quiz);
        $user_quiz = UserQuiz::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'attempt_no' => $last_attempt_no + 1,
            'time_limit_remaining' => $quiz->time_limit,
        ]);
        return $user_quiz;
    }

    private function get_last_attempt_no($user, $quiz)
    {
        $latest_user_quiz = $this->latest_user_quiz($user, $quiz);

        if ($latest_user_quiz != null)
        {
            $last_attempt_no = $latest_user_quiz->attempt_no;
        }
        else
        {
            $last_attempt_no = 0;
        }
        return $last_attempt_no;
    }

    private function latest_user_quiz($user, $quiz)
    {
        $latest_user_quiz = UserQuiz::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->orderBy('attempt_no', 'desc')
            ->first();
        return $latest_user_quiz;
    }

    private function create_user_questions($user_quiz)
    {
        $questions = Question::where('quiz_id', $user_quiz->quiz_id)
            ->get();
        $user_questions_raw = [];
        foreach ($questions as $question)
        {
            $user_question_raw = [
                'user_id' => $user_quiz->user_id,
                'user_quiz_id' => $user_quiz->id,
                'question_id' => $question->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            array_push($user_questions_raw, $user_question_raw);
        }
        UserQuestion::insert($user_questions_raw);
    }

    private function get_quiz($user, $request)
    {
        $quiz = DB::table('quizzes')
            ->join('user_quizzes', 'quizzes.id', '=', 'user_quizzes.id')
            ->where('user_quizzes.user_id', $user->id)
            ->where('quizzes.id', $request->quiz_id)
            ->orderBy('user_quizzes.attempt_no', 'desc')
            ->first();
        return $quiz;
    }

    private function get_question($user, $quiz, $request)
    {
        $question = DB::table('questions')
            ->join('user_questions', 'questions.id', '=', 'user_questions.question_id')
            ->where('user_questions.user_id', $user->id)
            ->where('questions.quiz_id', $quiz->id)
            ->where('questions.question_no', $request->question_no)
            ->first();
        return $question;
    }

    private function update_user_quiz_time_limit_remaining($user, $quiz, $request) 
    {
        $user_quiz = UserQuiz::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->orderBy('created_at', 'desc')
            ->first();
        $user_quiz->time_limit_remaining = $request->time_limit_remaining;
        $user_quiz->save();
    }

    private function update_user_question($user, $quiz, $request) 
    {
        $current_question = Question::where('quiz_id', $quiz->id)
            ->where('question_no', $request->current_question_no)
            ->first();
        $option = Option::find($request->hidden_option_id);
        if ($option != null) 
        {
            $user_question = UserQuestion::updateOrCreate(
                ['user_id' => $user->id, 'question_id' => $current_question->id],
                ['option_id' => $option->id]
            );
        }
    }

    private function set_previous_next_question($quiz, $question)
    {
        $question->has_previous = $this->has_previous($quiz, $question);
        if ($question->has_previous)
        {
            $question->previous_question_no = $question->question_no - 1;
        }
        $question->has_next = $this->has_next($quiz, $question);
        if ($question->has_next)
        {
            $question->next_question_no = $question->question_no + 1;
        }
        return $question;
    }

    private function has_previous($quiz, $question)
    {
        if ($question->question_no == 1)
        {
            return false;
        }
        return true;
    }

    private function has_next($quiz, $question)
    {
        if (($question->question_no + 1) <= $quiz->total_questions)
        {
            return true;
        }
        return false;
    }

    private function set_options($question)
    {
        $options = Option::where('question_id', $question->question_id)
            ->get();
        $question->options = $options;
        return $question;
    }

    // Quiz Review Helper Functions

    private function set_questions($user, $quiz)
    {
        $quiz->questions = $this->get_questions($user, $quiz);
        return $quiz;
    }

    private function get_questions($user, $quiz)
    {
        $last_attempt_no = $this->get_last_attempt_no($user, $quiz);

        $questions = DB::table('questions')
            ->join('user_questions', 'questions.id', '=', 'user_questions.question_id')
            ->join('user_quizzes', 'user_questions.user_quiz_id', '=', 'user_quizzes.id')
            ->where('user_questions.user_id', $user->id)
            ->where('user_quizzes.quiz_id', $quiz->id)
            ->where('user_quizzes.attempt_no', $last_attempt_no)
            ->get();
        return $questions;
    }

    private function update_user_quiz_submitted_at_grade($user, $quiz) 
    {
        $selected_options = $quiz->questions->pluck('option_id');
        $correct_questions = Option::whereIn('id', $selected_options)
            ->where('is_correct', true)
            ->count();
        $user_quiz = UserQuiz::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->first();
        $user_quiz->grade = $correct_questions/$quiz->total_questions * 100;
        $user_quiz->submitted_at = Carbon::now()->format('Y-m-d H:i:s');
        $user_quiz->save();
    }

    // Quiz Summary Helper Functions

    private function set_quiz_time_taken($quiz)
    {
        $time_taken = $quiz->time_limit - $quiz->time_limit_remaining;

        $quiz->time_taken = $this->seconds_to_time_string($time_taken);

        return $quiz;
    }

    private function set_questions_with_options($user, $quiz)
    {
        $quiz->questions = $this->get_questions($user, $quiz);

        foreach ($quiz->questions as $question)
        {
            $question = $this->set_options($question);   
        }
        
        return $quiz;
    }
}
