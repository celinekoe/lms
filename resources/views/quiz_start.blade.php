@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-20 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} {{ $data['quiz']->name }}</div>
    </div>
    <div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div>Grading Method</div>
            <div class="small">{{ $data['quiz']->grading_method }}</div>
        </div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div>Current Attempt</div>
            <div class="small">{{ $data['user_quiz']->attempt_no }}</div>
        </div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div>Current Question/Total Questions</div>
            <div class="small">{{ $data['user_quiz']->question_no }}/{{ $data['quiz']->total_questions }}</div>
        </div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div>Time Limit</div>
            <div class="small">{{ $data['quiz']->time_limit }} minutes</div>
        </div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div>Time Remaining</div>
            <div class="small">{{ $data['quiz']->time_remaining }}</div>
        </div>
        @if ($data['user_quiz']->grade == null)
            <div class="bg-white margin-bottom-20 padding-10">
                <div>Due Date</div>
                <div class="small">{{ $data['quiz']->submit_by_date }}</div>
            </div>
        @elseif ($data['user_quiz']->grade != null)
            <div class="bg-white margin-bottom-2 padding-10">
                <div>Due Date</div>
                <div class="small">{{ $data['quiz']->submit_by_date }}</div>
            </div>
            <div class="bg-white margin-bottom-2 padding-10">
                <div>Submitted At</div>
                <div class="small">{{ $data['user_quiz']->submitted_at }}</div>
            </div>
            <div class="bg-white margin-bottom-20 padding-10">
                <div>Highest Grade</div>
                <div class="small">{{ $data['user_quiz']->grade }}</div>
            </div>
        @endif
        @if ($data['user_quiz']->submitted_at == null)
            @if ($data['user_quiz']->question_no == 1)
                <div class="margin-bottom-20">
                    <a href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/quiz/'.$data['quiz']->id.'/question/1') }}" class="btn btn-default pull-right">Start Quiz
                </a>
                    <div class="clear"></div>   
                </div>
            @else
                <div class="margin-bottom-20">
                    <a href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/quiz/'.$data['quiz']->id.'/question/1') }}" class="btn btn-default pull-right">Continue Quiz
                </a>
                    <div class="clear"></div>   
                </div>
            @endif
        @else
            <div class="margin-bottom-20">
                <a href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/quiz/'.$data['quiz']->id.'/question/1') }}" class="btn btn-default pull-right">Retry Quiz
            </a>
                <div class="clear"></div>   
            </div>
        @endif
    </div>
</div>
</div>
@endsection
