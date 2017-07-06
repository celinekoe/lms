@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="margin-bottom-10">
        <div class="bg-white font-size-32 margin-bottom-10 padding-10">{{ $data['unit']->unit_code }} {{ $data['quiz']->name }}</div>
        <div class="timer bg-white margin-bottom-10 padding-10" time-limit-remaining="{{ $data['quiz']->time_limit_remaining }}">Time Limit Remaining</div>
        <div class="bg-white margin-bottom-2 padding-10">Review of Attempt</div>
        <div class="bg-white flex-align-center margin-bottom-2 padding-10">
            <div class="width-50p">Question No.</div>
            <div class="width-50p">Answered</div>    
        </div>
        <div class="margin-bottom-10">
            @foreach ($data['quiz']->questions as $question)
                <a href="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->quiz_id.'/question/'.$question->question_no) }}" class="question">
                    <div class="bg-white flex-align-center margin-bottom-2 padding-10">
                        <div class="width-50p">{{ $question->question_no }}</div>
                        <div class="width-50p">{{ $question->option_id != null ? "Yes" : "No" }}</div>
                        <div class="glyphicon glyphicon-chevron-right margin-left-auto margin-right-10 margin-bottom-4"></div>
                    </div>
                </a>
            @endforeach    
        </div>
    </div>
    <form action="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->quiz_id.'/save') }}" method="POST" class="save-form">
        <input type="hidden" name="attempt_no" value="{{ $data['quiz']->attempt_no }}">
        {{ csrf_field() }}   
    </form>
    <div class="flex-align-center">
        <form action="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->quiz_id.'/submit') }}" method="POST" class="submit-form margin-left-auto" href="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->quiz_id.'/summary/'.$data['quiz']->attempt_no) }}">
            <input type="hidden" name="attempt_no" value="{{ $data['quiz']->attempt_no }}">
            {{ csrf_field() }}
            <input type="submit" class="submit btn btn-primary" value="Submit">
        </form>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/quiz_review.js') }}"></script>
    <script src="{{ asset('js/quiz_timer.js') }}"></script>
    <script src="{{ asset('js/confirm.js') }}"></script>
@endsection