<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * Show the quiz start page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $quiz = Quiz::find($request->quiz_id);
        $quiz->time_remaining = Carbon::parse($quiz->submit_by)->diffForHumans();
        $subsection = Subsection::find($quiz->subsection_id);
        $section = Section::find($subsection->section_id);
        $unit = Unit::find($section->unit_id);
        $user_quiz = UserQuiz::find($quiz->id);
        $questions = Question::where('quiz_id', $quiz->id)->get();

        $data['unit'] = $unit;
        $data['section'] = $section;
        $data['quiz'] = $quiz;
        $data['questions'] = $questions;
        $data['user_quiz'] = $user_quiz;
        return view('quiz_start', ['data' => $data]);
    }

    /**
     * Store option and show next/prev question page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function next(Request $request)
    {
        // Store option

        $user = Auth::user();
        $section = Section::find($request->section_id);
        $quiz = Quiz::find($request->quiz_id);
        $current_question = Question::where('quiz_id', $quiz->id)
                                ->where('question_no', $request->current_question_no)
                                ->first();
        $option = Option::find($request->option);
        if ($option != null) 
        {
            $user_question = UserQuestion::updateOrCreate(
                ['user_id' => $user->id, 'question_id' => $current_question->id],
                ['option_id' => $option->id]
            );
        }

        // Show next question
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
     * Store option, calculate grade, and show quiz end page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
        // Store option
        
        $user = Auth::user();
        $quiz = Quiz::find($request->quiz_id);
        $current_question = Question::where('quiz_id', $quiz->id)
                                ->where('question_no', $request->current_question_no)
                                ->first();
        $option = Option::find($request->option);
        if ($option != null) 
        {
            $user_question = UserQuestion::updateOrCreate(
                ['user_id' => $user->id, 'question_id' => $current_question->id],
                ['option_id' => $option->id]
            );
        }

        // Show quiz review page
        $section = Section::find($request->section_id);
        $unit = Unit::find($section->unit_id);
        $user_quiz = UserQuiz::where('user_id', $user->id)
                                ->where('quiz_id', $quiz->id)
                                ->first();
        $question = Question::where('quiz_id', $quiz->id)
                                ->where('question_no', $request->question_no)
                                ->first();
        $questions = Question::where('quiz_id', $quiz->id)->get();
        $user_quiz_score = 0;
        foreach ($questions as $question)
        {
            $question->options = Option::where('question_id', $question->id)->get();
            $user_question = UserQuestion::where('user_id', $user->id)
                                        ->where('question_id', $question->id)
                                        ->first();
            foreach($question->options as $option)
            {
                if ($option->id == $user_question->option_id)
                {
                    $option->selected = true;
                    if ($option->is_correct)
                    {
                        $user_quiz_score++;
                    }
                }
                else
                {
                    $option->selected = false;
                }
            }
        }
        $user_quiz->grade = $user_quiz_score/$quiz->total_questions * 100;
        $user_quiz->submitted_at = Carbon::now()->format('Y-m-d H:i:s');
        $user_quiz->save();

        $data['unit'] = $unit;
        $data['section'] = $section;
        $data['quiz'] = $quiz;
        $data['user_quiz'] = $user_quiz;
        $data['question'] = $question;
        $data['questions'] = $questions;

        return view('quiz_end', ['data' => $data]);
    }
}
