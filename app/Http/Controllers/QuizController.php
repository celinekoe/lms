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

        $quiz = $this->get_quiz($request);
        $quiz = $this->set_quiz_where_all_attempts($user, $quiz);
        $quiz = $this->complete_exited_quiz_attempts($user, $quiz);
        
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
        
        $quiz = $this->get_quiz($request);
        $quiz = $this->set_quiz($user, $quiz);

        $question = $this->get_question($quiz, $request);
        $question = $this->set_question($user, $quiz, $question);
        $question = $this->set_previous_next_question($quiz, $question);

        $data['unit'] = $unit;
        $data['quiz'] = $quiz;
        $data['question'] = $question;

        return view('question', ['data' => $data]);
    }

    /**
     * Save the user quiz option.
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function save(Request $request)
    {
        $user = Auth::user();
        $quiz = $this->get_quiz($request);

        $this->update_user_quiz_time_limit_remaining($user, $quiz, $request);
        $this->update_user_question($user, $quiz, $request);
    }

    /**
     * Show the quiz review page.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function quiz_review(Request $request)
    {
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);
        $quiz = $this->get_quiz($request);
        $quiz = $this->set_quiz($user, $quiz);

        $data['unit'] = $unit;
        $data['quiz'] = $quiz;

        return view('quiz_review', ['data' => $data]);
    }

    /**
     * Store option, calculate grade, and show quiz summary page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
        // Submit quiz
        
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);
        $quiz = $this->get_quiz($request);
        $quiz = $this->set_quiz($user, $quiz);
        
        $questions = $this->get_questions($quiz);
        $quiz = $this->set_questions($user, $quiz, $questions);

        $this->update_user_quiz_submitted_at_grade($user, $quiz);
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

        $quiz = $this->get_quiz($request);
        $quiz = $this->set_quiz_where_attempt_no($user, $quiz, $request);

        $data['unit'] = $unit;
        $data['quiz'] = $quiz;

        return view('quiz_summary', ['data' => $data]);
    }

    private function set_quiz_where_all_attempts($user, $quiz)
    {
        $user_quizzes = $this->get_user_quizzes($user, $quiz);
        $quiz = $this->set_user_quizzes($quiz, $user_quizzes);

        $quiz->last_attempt_no = $this->get_last_attempt_no($user, $quiz);
        $quiz->time_limit_string = $this->seconds_to_time_string($quiz->time_limit);
        $quiz->time_remaining = Carbon::parse($quiz->submit_by_date)
            ->diffForHumans();

        return $quiz;
    }

    private function get_user_quizzes($user, $quiz)
    {
        $user_quizzes = UserQuiz::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->orderBy('attempt_no', 'asc')
            ->get();

        return $user_quizzes;
    }

    private function set_user_quizzes($quiz, $user_quizzes)
    {
        foreach ($user_quizzes as $user_quiz)
        {
            $questions = $this->get_questions($quiz);
            $user_quiz = $this->set_questions_where_all_attempts($user_quiz, $questions);
        }
        $quiz->user_quizzes = $user_quizzes;

        return $quiz;
    }

    private function set_questions_where_all_attempts($user_quiz, $questions)
    {
        foreach ($questions as $question)
        {
            $question = $this->set_question_where_all_attempts($user_quiz, $question);
        }
        $user_quiz->questions = $questions;

        return $user_quiz;
    }

    private function set_question_where_all_attempts($user_quiz, $question)
    {
        $user_question = $this->get_user_question_where_all_attempts($user_quiz, $question);
        $question = $this->set_user_question($question, $user_question);

        $options = $this->get_options($question);
        $question = $this->set_options($question, $options);
    }

    private function get_user_question_where_all_attempts($user_quiz, $question)
    {
        $user_question = UserQuestion::where('user_quiz_id', $user_quiz->id)
            ->where('question_id', $question->id)
            ->first();

        return $user_question;
    }

    private function complete_exited_quiz_attempts($user, $quiz)
    {

        $original_user_quizzes = $this->get_user_quizzes($user, $quiz);
        foreach ($quiz->user_quizzes as $user_quiz)
        {
            $original_user_quiz = $original_user_quizzes->where('id', $user_quiz->id)
                ->first();
            $quiz_attempt_submitted_at = $this->get_exited_quiz_attempt_submitted_at($user_quiz);
            $user_quiz->submitted_at = $quiz_attempt_submitted_at;
            $quiz_attempt_grade = $this->get_exited_quiz_attempt_grade($quiz, $user_quiz);
            $user_quiz->grade = $quiz_attempt_grade;

            $original_user_quiz->submitted_at = $quiz_attempt_submitted_at;
            $original_user_quiz->grade = $quiz_attempt_grade;
            $original_user_quiz->save();
        }

        return $quiz;
    }

    private function get_exited_quiz_attempt_submitted_at($user_quiz)
    {
        $quiz_attempt_created_at = Carbon::parse($user_quiz->created_at);
        $quiz_attempt_submitted_at = $quiz_attempt_created_at->addSeconds($user_quiz->time_limit_remaining);
        return $quiz_attempt_submitted_at;
    }

    private function get_exited_quiz_attempt_grade($quiz, $user_quiz)
    {
        $selected_options = [];
        foreach ($user_quiz->questions as $question)
        {
            array_push($selected_options, $question->user_question->option_id);
        }
        $correct_questions = Option::whereIn('id', $selected_options)
            ->where('is_correct', true)
            ->count();
        $grade = round($correct_questions/$quiz->total_questions * 100);
        return $grade;
    }

    

    public function start(Request $request)
    {
        $user = Auth::user();
        $quiz = Quiz::find($request->quiz_id);
        $user_quiz = $this->create_user_quiz($user, $quiz);
        $this->create_user_questions($user_quiz);
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
        $latest_user_quiz = $this->get_latest_user_quiz($user, $quiz);

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

    private function get_latest_user_quiz($user, $quiz)
    {
        if ($quiz->quiz_id != null) {
            $latest_user_quiz = UserQuiz::where('user_id', $user->id)
                ->where('quiz_id', $quiz->quiz_id)
                ->orderBy('attempt_no', 'desc')
                ->first();
            return $latest_user_quiz;    
        } else {
            $latest_user_quiz = UserQuiz::where('user_id', $user->id)
                ->where('quiz_id', $quiz->id)
                ->orderBy('attempt_no', 'desc')
                ->first();
            return $latest_user_quiz;
        }
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

    private function get_quiz($request)
    {
        $quiz = Quiz::where('id', $request->quiz_id)
            ->first();

        return $quiz;
    }

    private function set_quiz($user, $quiz)
    {
        $user_quiz = $this->get_user_quiz($user, $quiz);
        $quiz = $this->set_user_quiz($quiz, $user_quiz);

        $time_limit_remainining = $this->get_time_limit_remaining($quiz);
        $quiz = $this->set_time_limit_remaining($quiz, $time_limit_remainining);

        $questions = $this->get_questions($quiz);
        $quiz = $this->set_questions($user, $quiz, $questions);

        return $quiz;
    }

    private function get_time_limit_remaining($quiz)
    {
        $time_limit_remaining = $quiz->user_quiz->time_limit_remaining;

        return $time_limit_remaining;
    }

    private function set_time_limit_remaining($quiz, $time_limit_remaining)
    {
        $quiz->time_limit_remaining = $time_limit_remaining;

        return $quiz;
    }

    private function get_user_quiz($user, $quiz)
    {
        $user_quiz = UserQuiz::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->orderBy('attempt_no', 'desc')
            ->first();

        return $user_quiz;
    }

    private function set_user_quiz($quiz, $user_quiz)
    {
        $quiz->user_quiz = $user_quiz;

        return $quiz;
    }

    private function get_questions($quiz)
    {
        $questions = Question::where('quiz_id', $quiz->id)
            ->get();

        return $questions;
    }

    private function set_questions($user, $quiz, $questions)
    {
        foreach($questions as $question)
        {
            $question = $this->set_question($user, $quiz, $question);
        }
        $quiz->questions = $questions;

        return $quiz;
    }

    private function get_question($quiz, $request)
    {   
        $question = Question::where('quiz_id', $request->quiz_id)
            ->where('question_no', $request->question_no)
            ->first();

        return $question;
    }

    private function set_question($user, $quiz, $question)
    {
        $user_question = $this->get_user_question($user, $quiz, $question);
        $question = $this->set_user_question($question, $user_question);

        $options = $this->get_options($question);
        $question = $this->set_options($question, $options);

        return $question;
    }

    private function get_user_question($user, $quiz, $question)
    {
        $user_quiz = $this->get_user_quiz($user, $quiz);

        $user_question = UserQuestion::where('user_quiz_id', $user_quiz->id)
            ->where('question_id', $question->id)
            ->first();

        return $user_question;
    }

    private function set_user_question($question, $user_question)
    {
        $question->user_question = $user_question;

        return $question;
    }

    private function update_user_quiz_time_limit_remaining($user, $quiz, $request) 
    {
        $user_quiz = $this->get_user_quiz($user, $quiz);
        $user_quiz->time_limit_remaining = round($request->time_limit_remaining);
        $user_quiz->save();
    }

    private function update_user_question($user, $quiz, $request) 
    {
        $user_quiz = $this->get_user_quiz($user, $quiz);
        $question = $this->get_question($quiz, $request);
        $option = Option::find($request->hidden_option_id);

        if ($option != null) 
        {
            $user_question = UserQuestion::updateOrCreate(
                ['user_id' => $user->id, 'user_quiz_id' => $user_quiz->id, 'question_id' => $question->id],
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

    private function get_options($question)
    {
        $options = Option::where('question_id', $question->id)
            ->get();

        return $options;
    }

    private function set_options($question, $options)
    {
        $question->options = $options;

        return $question;
    }

    // Quiz Review Helper Functions

    private function update_user_quiz_submitted_at_grade($user, $quiz) 
    {
        $user_quiz = UserQuiz::find($quiz->user_quiz->id);
        $user_quiz->time_limit_remaining = $quiz->time_limit_remaining;
        $user_quiz->grade = $this->get_user_quiz_grade($quiz);
        $user_quiz->submitted_at = $this->get_user_quiz_submitted_at();
        $user_quiz->save();
    }

    private function get_user_quiz_grade($quiz)
    {
        $selected_options = [];
        foreach ($quiz->questions as $question)
        {
            array_push($selected_options, $question->user_question->option_id);
        }
        $correct_questions = Option::whereIn('id', $selected_options)
            ->where('is_correct', true)
            ->count();
        $grade = $correct_questions/$quiz->total_questions * 100;

        return $grade;
    }

    private function get_user_quiz_submitted_at()
    {
        $user_quiz_submitted_at = Carbon::now()->format('Y-m-d H:i:s');

        return $user_quiz_submitted_at;
    }

    // Quiz Summary Helper Functions

    private function set_quiz_where_attempt_no($user, $quiz, $request)
    {
        $user_quiz = $this->get_user_quiz_where_attempt_no($user, $quiz, $request);
        $quiz = $this->set_user_quiz($quiz, $user_quiz);

        $quiz_time_taken = $this->get_quiz_time_taken($quiz);
        $quiz = $this->set_quiz_time_taken($quiz, $quiz_time_taken);
        
        $questions = $this->get_questions($quiz);
        $quiz = $this->set_questions_where_attempt_no($quiz, $questions);

        return $quiz;
    }

    private function get_user_quiz_where_attempt_no($user, $quiz, $request)
    {
        $user_quiz = UserQuiz::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->where('attempt_no', $request->attempt_no)
            ->first();
        return $user_quiz;
    }

    private function get_quiz_time_taken($quiz)
    {
        $quiz_time_taken = $quiz->time_limit - $quiz->user_quiz->time_limit_remaining;

        $quiz_time_taken = $this->seconds_to_time_string($quiz_time_taken);

        return $quiz_time_taken;
    }

    private function set_quiz_time_taken($quiz, $quiz_time_taken)
    {
        $quiz->time_taken = $quiz_time_taken;

        return $quiz;
    }

    private function set_questions_where_attempt_no($quiz, $questions)
    {
        foreach ($questions as $question)
        {
            $question = $this->set_question_where_attempt_no($quiz, $question);
        }
        $quiz->questions = $questions;

        return $quiz;
    }

    private function set_question_where_attempt_no($quiz, $question)
    {
        $user_question = $this->get_user_question_where_attempt_no($quiz, $question);
        $question = $this->set_user_question($question, $user_question);

        $options = $this->get_options($question);
        $question = $this->set_options($question, $options);

        return $question;
    }

    private function get_user_question_where_attempt_no($quiz, $question)
    {
        $user_question = UserQuestion::where('user_quiz_id', $quiz->user_quiz->id)
            ->where('question_id', $question->id)
            ->first();

        return $user_question;
    }

}
