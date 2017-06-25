@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-20 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} {{ $data['quiz']->name }}</div>
        <div class="flex-align-center">
            <div class="font-size-32 margin-left-auto">{{ $data['quiz']->grade }}</div>    
        </div>
    </div>
    <div>
        @foreach ($data['questions'] as $question)
            <div class="bg-white flex-align-center margin-bottom-2 padding-10">
                <div>{{ $question->question }}</div>
                <div class="margin-left-auto">{{ $question->question_no }}/{{ $data['quiz']->total_questions }}</div>
            </div>
            @foreach ($question->options as $option)
                <div>
                    @if ($option->selected)
                        @if ($option->is_correct)
                            <div class="bg-success text-white margin-bottom-2 padding-10">
                                <div>{{ $option->option}}</div>
                                <div class="small">{{ $option->description}}</div>
                            </div>
                        @else
                            <div class="bg-failure text-white margin-bottom-2 padding-10">
                                <div>{{ $option->option}}</div>
                                <div class="small">{{ $option->description}}</div>
                            </div>
                        @endif
                    @else
                        <div class="bg-white margin-bottom-2 padding-10">{{ $option->option }}</div>
                    @endif    
                </div>
            @endforeach    
            <div class="margin-bottom-10"></div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
@endsection