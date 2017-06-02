<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Section;
use App\Subsection;
use App\Quiz;
use App\Question;
use App\UserQuiz;
use App\Option;
use App\UserQuestion;

class QuizController extends Controller
{
    /**
     * Show the quiz page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    	$quiz = Quiz::find($request->quiz_id);
        $subsection = Subsection::find($quiz->subsection_id);
        $section = Section::find($subsection->section_id);
        $questions = Question::where('quiz_id', $quiz->id)->get();
        $user_quiz = UserQuiz::find($quiz->id);
        $data['section'] = $section;
        $data['quiz'] = $quiz;
        $data['questions'] = $questions;
        $data['user_quiz'] = $user_quiz;
        return view('quiz', ['data' => $data]);
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
        $question = Question::where('quiz_id', $quiz->id)
                                ->where('question_no', $request->question_no)
                                ->first();
        $option = Option::find($request->option);
        if ($option != null) 
        {
            $user_question = UserQuestion::updateOrCreate([
                'user_id' => $user->id,
                'question_id' => $question->id,
                'option_id' => $option->id
            ]);
            $user_question->save();
        }

        // Show next question

        $options = Option::where('question_id', $question->id)->get();
        $data['section'] = $section;
        $data['quiz'] = $quiz;
        $data['question'] = $question;
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
        $section = Section::find($request->section_id);
        $quiz = Quiz::find($request->quiz_id);
        $question = Question::where('quiz_id', $quiz->id)
                                ->where('question_no', $request->question_no)
                                ->first();
        $option = Option::find($request->option);
        if ($option != null) 
        {
            $user_question = UserQuestion::updateOrCreate([
                'user_id' => $user->id,
                'question_id' => $question->id,
                'option_id' => $option->id
            ]);
            $user_question->save();
        }

        // Show quiz review page
        $user_quiz = UserQuiz::where('user_id', $user->id)
                                ->where('quiz_id', $quiz->id)
                                ->first();
        $questions = Question::where('quiz_id', $quiz->id)->get();
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
                }
                else
                {
                    $option->selected = false;
                }
            }
        }
        $data['section'] = $section;
        $data['quiz'] = $quiz;
        $data['user_quiz'] = $user_quiz;
        $data['question'] = $question;
        $data['questions'] = $questions;
        
        return view('quiz_review', ['data' => $data]);
    }
}
