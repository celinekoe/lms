@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white flex-align-center padding-left-20 padding-right-10 padding-top-bottom-10">
        <div class="section-progress c100 {{ 'p' . $data['section']->progress }} font-size-228em green">
          <div class="slice">
            <div class="bar"></div>
            <div class="fill"></div>
          </div>
        </div>
        <div class="font-size-32 margin-left-10">{{ $data['section']->name }}</div>
        <span class="icons margin-left-auto margin-right-10">
            <span class="download glyphicon glyphicon-download margin-top-4" href=""></span>
        </span>
    </div>
    @foreach ($data['subsections'] as $subsection)
        <div class="bg-white margin-top-10 margin-bottom-2 padding-10">
            <div class="bg-white flex-align-center margin-left-10">
                <div class="section-progress c100 {{ 'p' . $subsection->progress }} font-size-171em green">
                  <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                  </div>
                </div>
                <div class="font-size-19 margin-left-10">{{ $subsection->name }}</div>
                <span class="icons margin-left-auto margin-right-10">
                    <span class="download glyphicon glyphicon-download margin-top-4" href=""></span>
                </span>
            </div>
        </div>
        @foreach ($subsection->files as $file)
            <div class="bg-white margin-top-bottom-2 padding-10 text-dark-grey">
                <a href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/file/'.$file->id) }}" target="_blank">
                    <div>
                        @if ($file->type == 'video')
                            <span class="glyphicon glyphicon-facetime-video margin-left-10"></span>
                        @elseif ($file->type == 'document')
                            <span class="glyphicon glyphicon-book margin-left-10"></span>
                        @endif
                        <span class="margin-left-10">{{ $file->name }}</span>
                        <span class="icons pull-right margin-right-10">
                            @if ($file->completed == false)
                                <span class="complete glyphicon glyphicon-unchecked margin-right-10" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/file/'.$file->id.'/complete') }}"></span>
                            @else
                                <span class="incomplete glyphicon glyphicon-check margin-right-10" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/file/'.$file->id.'/incomplete') }}"></span>
                            @endif
                            @if ($file->downloaded == false)
                                <span class="download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/file/'.$file->id.'/download') }}"></span>
                            @else
                                <span class="download glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/file/'.$file->id.'/delete') }}"></span>
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
                    <span class="margin-left-10">{{ $quiz->name }}</span>
                </a>
                <span class="icons pull-right">
                    <span class="complete glyphicon glyphicon-unchecked margin-right-10" href=""></span>
                </span>
            </div>
        @endforeach
    @endforeach
</div>
@endsection

@section('script')
    <script src="{{ asset('js/section.js') }}"></script>
@endsection