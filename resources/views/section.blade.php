@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white padding-10">
        <div>Progress Bar</div>
        <h1>{{ $data['section']->name }}</h1>
    </div>
    @foreach ($data['subsections'] as $subsection)
        <div class="bg-white margin-top-10 margin-bottom-2 padding-10">
            <div>Progress Bar</div>
            <div>{{ $subsection->name }}</div>
        </div>
        @foreach ($subsection->files as $file)
            <div class="bg-white margin-top-bottom-2 padding-10 text-dark-grey">
                <a href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/file/'.$file->id) }}" target="_blank">
                    <div>
                        @if ($file->type == 'video')
                            <span class="glyphicon glyphicon-facetime-video margin-left-10"></span>
                        @elseif ($file->type == 'reading')
                            <span class="glyphicon glyphicon-book margin-left-10"></span>
                        @endif
                        <span class="margin-left-20">{{ $file->name }}</span>
                        <span class="pull-right margin-right-10">
                        @if ($file->downloaded == null)
                            <span class="download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/file/'.$file->id.'/download') }}"></span>
                        @else
                            <span class="download glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/file/'.$file->id.'/delete') }}"></span>
                        @endif
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
        @foreach ($subsection->quizzes as $quiz)
            <div class="bg-white margin-top-bottom-2 padding-10">
                <span class="glyphicon glyphicon-star margin-left-10"></span>
                <a href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/quiz/'.$quiz->id) }}">
                    <span class="margin-left-20">{{ $quiz->name }}</span>
                </a>
            </div>
        @endforeach
        <div class="margin-bottom-20"></div>
    @endforeach
</div>
@endsection

@section('script')
    <script src="{{ asset('js/section.js') }}"></script>
@endsection