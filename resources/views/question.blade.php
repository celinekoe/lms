@extends('layouts.app')

@section('content')
<?php
    $url = url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/quiz/'.$data['quiz']->id.'/question');
    $submit_url = $url . '/' . $data['question']->question_no . '/submit';

    $has_prev = true;
    if ($data['question']->question_no == 1)
    {
        $has_prev = false;
    }
    else
    {
        $prev_question_no = $data['question']->question_no - 1;
        $prev_url = $url . '/' . $prev_question_no;
    }
    $has_next = true;

    if ($data['question']->question_no == $data['quiz']->total_question)
    {
        $has_next = false;
    }
    else
    {
        $next_question_no = $data['question']->question_no + 1;
        $next_url = $url . '/' . $next_question_no;
    }
?>
<div class="container margin-top-20">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="bg-blue-grey panel panel-default margin-0">
                <div class="panel-heading padding-10">
                    <div class="pull-right">
                        {{ $data['question']->question_no }}/{{ $data['quiz']->total_question }}
                    </div>
                    {{ $data['question']->question }}
                </div>
                @foreach ($data['options'] as $option)
                    @if ($data['user_question']->option_id == $option->id)
                        <div class="radio bg-white margin-0 padding-10">
                            <label><input type="radio" name="option" value="{{ $option->id }}" class="option">{{ $option->option }}</label>
                        </div>
                    @else
                        <div class="radio bg-light-grey margin-0 padding-10">
                            <label><input type="radio" name="option" value="{{ $option->id }}" class="option">{{ $option->option }}</label>
                        </div>
                    @endif
                @endforeach
                <input type="hidden" name="_token" value="{{ csrf_token() }}" class="token">
            </div>
            <div class="margin-top-20">
                @if ($has_prev)
                    <form action="{{ $prev_url }}" method="POST" class="display-inline">
                        <input type="hidden" name="current_question_no" value="{{ $data['question']->question_no }}">
                        <input type="hidden" name="option" class="hidden_option">
                        <input type="submit" class="btn btn-default" value="Prev">
                        {{ csrf_field() }}  
                    </form>
                @endif
                @if ($has_next)
                    <form action="{{ $next_url }}" method="POST" class="display-inline">
                        <input type="hidden" name="current_question_no" value="{{ $data['question']->question_no }}">
                        <input type="hidden" name="option" class="hidden_option">
                        <input type="submit" class="btn btn-default pull-right" value="Next">
                        {{ csrf_field() }}   
                    </form>
                @else
                    <form action="{{ $submit_url }}" method="POST" class="display-inline">
                        <input type="hidden" name="current_question_no" value="{{ $data['question']->question_no }}">
                        <input type="hidden" name="option" class="hidden_option">
                        <input type="submit" class="btn btn-default pull-right" value="Submit">
                        {{ csrf_field() }}   
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/question.js') }}"></script>
@endsection