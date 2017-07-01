@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="timer bg-white margin-bottom-10 padding-10" time-limit="{{ $data['quiz']->time_limit }}">
        Time Limit {{ $data['quiz']->time_limit_formatted }}
    </div>
    <div class="margin-bottom-10">
        <div class="bg-white margin-bottom-2 padding-10">
            <div class="flex">
                <div class="margin-left-auto">
                    <span class="current-question-no">{{ $data['question']->question_no }}</span>
                    <span>/{{ $data['quiz']->total_questions }}</span>
                </div>
            </div>
            <div class="question-question">{{ $data['question']->question }}</div>
        </div>
        <div class="options">
            @foreach ($data['options'] as $option)
                @if ($data['question']->option_id == $option->id)
                    <div class="option radio bg-white margin-top-0 margin-bottom-7 padding-10">
                        <label class="option-option"><input type="radio" name="option_id" value="{{ $option->id }}" checked class="option-option">{{ $option->option }}</label>
                    </div>
                @else
                    <div class="option radio bg-white margin-top-0 margin-bottom-7 padding-10">
                        <label class="option-option"><input type="radio" name="option_id" value="{{ $option->id }}" class="option-option">{{ $option->option }}</label>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="flex-align-center margin-bottom-10">
        <form action="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/quiz/'.$data['quiz']->id.'/previous') }}" method="POST" class="previous-form display-none">
            <input type="hidden" name="current_question_no" value="{{ $data['question']->current_question_no }}">
            <input type="hidden" name="hidden_option_id">
            <input type="submit" class="previous btn btn-default" value="Prev">
            {{ csrf_field() }}
        </form>
        <form action="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/quiz/'.$data['quiz']->id.'/next') }}" method="POST" class="next-form margin-left-auto">
            <input type="hidden" name="current_question_no" value="{{ $data['question']->question_no }}">
            <input type="hidden" name="hidden_option_id">
            <input type="submit" class="next btn btn-default pull-right" value="Next">
            {{ csrf_field() }}   
        </form>
        <form action="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section'].'/quiz/'.$data['quiz']->id.'/submit') }}" method="POST" class="submit-form display-none margin-left-auto">
            <input type="hidden" name="current_question_no" value="{{ $data['question']->question_no }}">
            <input type="hidden" name="hidden_option_id">
            <input type="submit" class="submit btn btn-default pull-right" value="Submit">
            {{ csrf_field() }}   
        </form>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/question.js') }}"></script>
    <script src="{{ asset('js/confirm.js') }}"></script>
@endsection