@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white font-size-32 margin-bottom-10 padding-10">{{ $data['unit']->unit_code }} {{ $data['quiz']->name }}</div>
    <div class="timer bg-white margin-bottom-10 padding-10" time-limit-remaining="{{ $data['quiz']->time_limit_remaining }}">Time Limit Remaining</div>
    <div class="margin-bottom-10">
        <div class="bg-white margin-bottom-2 padding-10">
            <div class="flex">
                <div class="margin-left-auto">
                    <span class="current-question-no">{{ $data['question']->question_no }}/{{ $data['quiz']->total_questions }}</span>
                </div>
            </div>
            <div class="question-question">{{ $data['question']->question }}</div>
        </div>
        <div class="options">
            @foreach ($data['question']->options as $option)
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
        @if ($data['question']->has_previous)
            <form action="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->quiz_id.'/save') }}" method="POST" class="previous-form" href="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->quiz_id.'/question/'.$data['question']->previous_question_no) }}">
                <input type="hidden" name="attempt_no" value="{{ $data['quiz']->attempt_no }}">
                <input type="hidden" name="current_question_no" value="{{ $data['question']->question_no }}">
                <input type="hidden" name="hidden_option_id">
                <input type="submit" class="previous btn btn-default" value="Prev">
                {{ csrf_field() }}
            </form>
        @endif
        @if ($data['question']->has_next)
            <form action="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->quiz_id.'/save') }}" method="POST" class="next-form margin-left-auto" href="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->quiz_id.'/question/'.$data['question']->next_question_no) }}">
                <input type="hidden" name="attempt_no" value="{{ $data['quiz']->attempt_no }}">
                <input type="hidden" name="current_question_no" value="{{ $data['question']->question_no }}">
                <input type="hidden" name="hidden_option_id">
                <input type="submit" class="next btn btn-default pull-right" value="Next">
                {{ csrf_field() }}   
            </form>
        @else
            <form action="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->quiz_id.'/save') }}" method="POST" class="review-form margin-left-auto" href="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->quiz_id.'/review') }}">
                <input type="hidden" name="attempt_no" value="{{ $data['quiz']->attempt_no }}">
                <input type="hidden" name="current_question_no" value="{{ $data['question']->question_no }}">
                <input type="hidden" name="hidden_option_id">
                <input type="submit" class="review btn btn-default pull-right" value="Review">
                {{ csrf_field() }}   
            </form>
        @endif
        <form action="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->quiz_id.'/submit') }}" method="POST" class="submit-form display-none margin-left-auto" href="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->quiz_id.'/summary/'.$data['quiz']->attempt_no) }}">
            <input type="hidden" name="current_attempt_no" value="{{ $data['quiz']->attempt_no }}">
            {{ csrf_field() }}
            <div class="flex">
                <input type="submit" class="submit btn btn-default" value="Submit">
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/question.js') }}"></script>
    <script src="{{ asset('js/quiz_timer.js') }}"></script>
    <script src="{{ asset('js/confirm.js') }}"></script>
@endsection