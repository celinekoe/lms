@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="margin-bottom-10">
        <div class="bg-white font-size-32 margin-bottom-10 padding-10">{{ $data['unit']->unit_code }} {{ $data['quiz']->name }}</div>
        <div>
            <div class="bg-white margin-bottom-2 padding-10">Summary of Attempt No. {{ $data['quiz']->user_quiz->attempt_no }}</div>
            <div class="bg-white margin-bottom-2 padding-10">
                <div>Started On</div>
                <div class="small">{{ $data['quiz']->user_quiz->created_at }}</div>
            </div>
            <div class="bg-white margin-bottom-2 padding-10">
                <div>Submitted At</div>
                <div class="small">{{ $data['quiz']->user_quiz->submitted_at }}</div>
            </div>
            <div class="bg-white margin-bottom-2 padding-10">
                <div>Time Taken</div>
                <div class="small">{{ $data['quiz']->time_taken }}</div>
            </div>
            <div class="bg-white margin-bottom-2 padding-10">
                <div>Grade</div>
                <div class="small">{{ $data['quiz']->user_quiz->grade }}</div>
            </div>
        </div>
    </div>
    <div>
        @foreach ($data['quiz']->questions as $question)
            <div class="bg-white flex-align-center margin-bottom-2 padding-10">
                <div>{{ $question->question }}</div>
                <div class="margin-left-auto">{{ $question->question_no }}/{{ $data['quiz']->total_questions }}</div>
            </div>
            @foreach ($question->options as $option)
                <div>
                    @if ($question->user_question->option_id == $option->id)
                        @if ($option->is_correct)
                            <div class="bg-success text-white flex-align-center margin-bottom-2 padding-10">
                                <div>
                                    <div>{{ $option->option}}</div>
                                    <div class="small">{{ $option->description}}</div>
                                </div>
                                <div class="glyphicon glyphicon-ok margin-left-auto"></div>
                            </div>
                        @else
                            <div class="bg-failure text-white flex-align-center margin-bottom-2 padding-10">
                                <div>
                                    <div>{{ $option->option}}</div>
                                    <div class="small">{{ $option->description}}</div>
                                </div>
                                <div class="glyphicon glyphicon-remove margin-left-auto"></div>
                            </div>
                        @endif
                    @else
                        @if ($option->is_correct)
                            <div class="bg-success text-white margin-bottom-2 padding-10">
                                <div>{{ $option->option}}</div>
                                <div class="small">{{ $option->description}}</div>
                            </div>
                        @else
                            <div class="bg-white margin-bottom-2 padding-10">
                                <div>{{ $option->option}}</div>
                                <div class="small">{{ $option->description}}</div>
                            </div>
                        @endif
                    @endif    
                </div>
            @endforeach    
            <div class="margin-bottom-10"></div>
        @endforeach
    </div>
</div>
@endsection