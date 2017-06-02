<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Quiz;
use App\Question;
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
    	$section = Section::find($request->section_id);
    	$quiz = Quiz::find($request->quiz_id);
        $question = Question::where('quiz_id', $quiz->id)
                                ->where('question_no', $request->question_no)
                                ->first();
        $options = Option::where('question_id', $question->id)->get();
        $data['section'] = $section;
        $data['quiz'] = $quiz;
        $data['question'] = $question;
        $data['options'] = $options;
        return view('question', ['data' => $data]);
    }
}
