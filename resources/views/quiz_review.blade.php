@extends('layouts.app')

@section('content')
<div class="border-blue-grey">
    <div class="bg-dark-grey height-100" style="margin: auto;">
        <div class="text-light-grey">{{ $data['quiz']->name }}</div>
        <div class="text-light-grey">{{ $data['user_quiz']->grade }}</div>
    </div>
    <div>
        @foreach ($data['questions'] as $question)
            <div class="padding-20">
                <div class="bg-blue-grey padding-10">
                    {{ $question->question }}
                </div>
                @foreach ($question->options as $option)
                    @if ($option->selected)
                        @if ($option->is_correct)
                            <div class="bg-success padding-10">{{ $option->option }}</div>
                        @else
                            <div class="bg-failure padding-10">{{ $option->option }}</div>
                        @endif
                    @else
                        <div class="bg-light-grey padding-10">{{ $option->option }}</div>
                    @endif
                @endforeach    
            </div>
        @endforeach
    </div>
    <div class="bg-dark-grey height-100 align-center-justify-end">
        <a href="{{ url('unit/'. $data['section']->unit_id . '/section/' . $data['section']->id . '/quiz/' . $data['quiz']->id) }}" class="btn btn-default margin-right-20">Return</a>
    </div>
</div>
@endsection

@section('script')
@endsection