@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div>Progress Bar</div>
                <div class="panel-heading">{{ $data['section']->name }}</div>
                <div>
                    @foreach ($data['subsections'] as $subsection)
                        <div class="bg-blue-grey margin-top-20 margin-left-right-20 padding-10">
                            <span>{{ $subsection->name }}</span>
                            <span>Progress Bar</span>
                        </div>
                        @foreach ($subsection->files as $file)
                            <div class="bg-light-grey margin-left-right-20 padding-10">
                                @if ($file->type == 'video')
                                    <span class="glyphicon glyphicon-facetime-video margin-left-10"></span>
                                @elseif ($file->type == 'reading')
                                    <span class="glyphicon glyphicon-book margin-left-10"></span>
                                @endif
                                <span class="margin-left-20">{{ $file->name }}</span>
                                <a href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/file/'.$file->id) }}" target="_blank">
                                    <span class="pull-right glyphicon glyphicon-download margin-right-10"></span>
                                </a>
                            </div>
                        @endforeach
                        @foreach ($subsection->quizzes as $quiz)
                            <div class="bg-light-grey margin-left-right-20 padding-10">
                                <span class="glyphicon glyphicon-star margin-left-10"></span>
                                <a href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/quiz/'.$quiz->id) }}">
                                    <span class="margin-left-20">{{ $quiz->name }}</span>
                                </a>
                            </div>
                        @endforeach
                        <div class="margin-bottom-20"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
