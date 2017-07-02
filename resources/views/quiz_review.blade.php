@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="margin-bottom-10">
        <div class="bg-white font-size-19 margin-bottom-10 padding-10">Review of Attempt</div>
        <div class="bg-white flex-align-center margin-bottom-2 padding-10">
            <div class="width-50p">Question No.</div>
            <div class="width-50p">Answered</div>    
        </div>
        <div class="magin-bottom-10">
            @foreach ($data['quiz']->questions as $question)
                <a href="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->id.'/question/'.$question->question_no) }}">
                    <div class="question bg-white flex-align-center margin-bottom-2 padding-10">
                        <div class="width-50p">{{ $question->question_no }}</div>
                        <div class="width-50p">{{ $question->option_id != null ? "Yes" : "No" }}</div>
                        <div class="glyphicon glyphicon-chevron-right margin-left-auto margin-right-10 margin-bottom-4"></div>
                    </div>
                </a>
            @endforeach    
        </div>
    </div>
    <div class="flex-align-center">
        <form action="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->id.'/submit') }}" method="POST" class="submit-form margin-left-auto" href="{{ url('unit/'.$data['quiz']->unit_id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->id.'/summary') }}">
            <input type="hidden" name="current_attempt_no" value="{{ $data['quiz']->attempt_no }}">
            {{ csrf_field() }}
            <input type="submit" class="submit btn btn-default" value="Submit">
        </form>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/quiz_review.js') }}"></script>
    <script src="{{ asset('js/confirm.js') }}"></script>
@endsection