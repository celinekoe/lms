<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Section;
use App\Quiz;
use App\Question;
use App\UserQuestion;
use App\Option;

class QuestionController extends Controller
{
    /**
     * Show question page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = Auth::user();
    	$section = Section::find($request->section_id);
    	$quiz = Quiz::find($request->quiz_id);
        $quiz->time_limit_formatted = $this->format_time_limit($quiz->time_limit);
        $question = Question::where('quiz_id', $quiz->id)
            ->where('question_no', $request->question_no)
            ->first();
        $user_question = UserQuestion::where('user_id', $user->id)
            ->where('question_id', $question->id)
            ->first();
        $options = Option::where('question_id', $question->id)->get();
        $data['section'] = $section;
        $data['quiz'] = $quiz;
        $data['question'] = $question;
        $data['user_question'] = $user_question;
        $data['options'] = $options;
        return view('question', ['data' => $data]);
    }

     /**
     * Store option and show next question page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function next(Request $request)
    {
        // Store option

        $user = Auth::user();
        $quiz = Quiz::find($request->quiz_id);
        $this->store_option($user, $quiz, $request);

        // Show next question
        $next_question_no = $request->current_question_no + 1;
        $next_question = DB::table('users')
            ->join('user_questions', 'users.id', '=', 'user_questions.user_id')
            ->join('questions', 'user_questions.question_id', '=', 'questions.id')
            ->where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->where('question_no', $next_question_no)
            ->first();
        $options = Option::where('question_id', $next_question->id)->get();

        $next_question->has_next = $this->has_next($quiz, $next_question);
        $next_question->has_previous = $this->has_previous($quiz, $next_question);

        // Route variables
        $section = Section::find($request->section_id);
        
        $data['section'] = $section;
        $data['quiz'] = $quiz;
        $data['question'] = $next_question;
        $data['options'] = $options;
        return $data;
    }

     /**
     * Store option and show previous question page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function previous(Request $request)
    {
        // Store option
        $user = Auth::user();
        $quiz = Quiz::find($request->quiz_id);
        $this->store_option($user, $quiz, $request);

        // Show next question
        $previous_question_no = $request->current_question_no - 1;
        $previous_question = DB::table('users')
            ->join('user_questions', 'users.id', '=', 'user_questions.user_id')
            ->join('questions', 'user_questions.question_id', '=', 'questions.id')
            ->where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->where('question_no', $previous_question_no)
            ->first();
        $options = Option::where('question_id', $previous_question->id)->get();

        $previous_question->has_next = $this->has_next($quiz, $previous_question);
        $previous_question->has_previous = $this->has_previous($quiz, $previous_question);

        // Route variables
        $section = Section::find($request->section_id);
        
        $data['section'] = $section;
        $data['quiz'] = $quiz;
        $data['question'] = $previous_question;
        $data['options'] = $options;
        return $data;
    }

    private function store_option($user, $quiz, $request) 
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

    private function format_time_limit($time_limit) 
    {
        $hours = floor($time_limit/(60 * 60));
        $hours = str_pad($hours, 2, '0', STR_PAD_LEFT);
        $minutes = floor($time_limit % (60 * 60) / 60);
        $minutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);
        $seconds = floor($time_limit % 60);
        $seconds = str_pad($seconds, 2, '0', STR_PAD_LEFT);
        $time_limit_formatted = $hours . ":" . $minutes . ":" . $seconds;
        return $time_limit_formatted;
    }

    private function has_next($quiz, $question)
    {
        if (($question->question_no + 1) <= $quiz->total_questions)
        {
            return true;
        }
        return false;
    }

    private function has_previous($quiz, $question)
    {
        if (($question->question_no - 1) == 0)
        {
            return false;
        }
        return true;
    }
}
