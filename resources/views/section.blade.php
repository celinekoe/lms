@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="section bg-white flex-align-center margin-bottom-2 padding-left-20 padding-right-10 padding-top-bottom-10">
        <div class="section-progress c100 {{ 'p' . $data['section']->progress }} font-size-228em green">
          <div class="slice">
            <div class="bar"></div>
            <div class="fill"></div>
          </div>
        </div>
        <div class="font-size-32 margin-left-10">{{ $data['section']->name }}</div>
        <span class="icons margin-left-auto margin-right-10">
            @if ($data['section']->downloaded == false)
                <span class="section-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/download') }}"></span>
                <span class="section-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/delete') }}" style="display: none;"></span>
            @else
                <span class="section-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/download') }}" style="display: none;"></span>
                <span class="section-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/delete') }}"></span>
            @endif
        </span>
    </div>
    <div class="section-tabs">
        <div class="flex-align-center-justify-around margin-bottom-2">
            <div class="introduction-tab-header bg-white flex-align-center-justify-center margin-right-2 width-25p" style="height: 86px;">
                <div>
                    <div class="flex-justify-center glyphicon glyphicon-exclamation-sign margin-bottom-4" aria-hidden="true"></div>
                    <div>
                        Introduction
                    </div>    
                </div>
            </div>
            <div class="guidelines-tab-header bg-white flex-align-center-justify-center margin-right-2 width-25p" style="height: 86px;">
                <div>
                    <div class="flex-justify-center glyphicon glyphicon-tasks margin-bottom-4" aria-hidden="true"></div>
                    <div>
                        Guidelines
                    </div>
                </div>
            </div>
            <div class="learning-outcomes-tab-header bg-white flex-align-center-justify-center margin-right-2 width-25p" style="height: 86px;">
                <div>
                    <div class="flex-justify-center glyphicon glyphicon-list margin-bottom-4" aria-hidden="true"></div>
                    <div class="flex-justify-center">
                        Learning
                    </div>
                    <div>
                        Outcomes
                    </div>
                </div>
            </div>
            <div class="resources-tab-header bg-white flex-align-center-justify-center width-25p" style="height: 86px;">
                <div>
                    <div class="flex-justify-center glyphicon glyphicon-link margin-bottom-4" aria-hidden="true"></div>
                    <div>
                        Resources
                    </div>
                </div>
            </div>
        </div>
        <div class="introduction-tab-body bg-white padding-10" style="display: none;">
            {{ $data['section']->introduction }}
        </div>
        <div class="guidelines-tab-body bg-white padding-10" style="display: none;">
            {{ $data['section']->guidelines }}
        </div>
        <div class="learning-outcomes-tab-body bg-white padding-10" style="display: none;">
            {{ $data['section']->introduction }}
        </div>
        <div class="resources-tab-body bg-white padding-10" style="display: none;">
            {{ $data['section']->introduction }}
        </div>
    </div>
    @foreach ($data['subsections'] as $subsection)
        <div class="margin-top-10">
            <div class="bg-white margin-bottom-2 padding-10">
                <div class="bg-white flex-align-center margin-left-10">
                    <div class="subsection-progress c100 {{ 'p' . $subsection->progress }} font-size-171em green">
                      <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                      </div>
                    </div>
                    <div class="font-size-19 margin-left-10">{{ $subsection->name }}</div>
                    @if ($subsection->files->count() > 0)
                        @if ($subsection->downloaded == false)
                            <span class="margin-left-auto margin-right-10">
                                <span class="subsection-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/download') }}"></span>
                                <span class="subsection-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/delete') }}" style="display: none"></span>
                            </span>
                        @else
                            <span class="margin-left-auto margin-right-10">
                                <span class="subsection-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/download') }}" style="display: none"></span>
                                <span class="subsection-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/delete') }}"></span>
                            </span>
                        @endif
                    @endif
                </div>
            </div>
            @foreach ($subsection->files as $file)
                <div class="file bg-white margin-top-bottom-2 padding-10 text-dark-grey">
                    <a href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/file/'.$file->id) }}" target="_blank">
                        <div>
                            @if ($file->type == 'video')
                                <span class="glyphicon glyphicon-facetime-video margin-left-10"></span>
                            @elseif ($file->type == 'document')
                                <span class="glyphicon glyphicon-book margin-left-10"></span>
                            @endif
                            <span class="margin-left-10">{{ $file->name }}</span>
                            <span class="pull-right margin-right-10">
                                @if ($file->completed == false)
                                    <span class="complete glyphicon glyphicon-unchecked margin-right-10" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/file/'.$file->id.'/complete') }}"></span>
                                    <span class="incomplete glyphicon glyphicon-check margin-right-10" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/file/'.$file->id.'/incomplete') }}" style="display: none;"></span>
                                @else
                                    <span class="complete glyphicon glyphicon-unchecked margin-right-10" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/file/'.$file->id.'/complete') }}" style="display: none;"></span>
                                    <span class="incomplete glyphicon glyphicon-check margin-right-10" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/file/'.$file->id.'/incomplete') }}"></span>
                                @endif
                                @if ($file->downloaded == false)
                                    <span class="individual-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/file/'.$file->id.'/download') }}"></span>
                                    <span class="individual-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/file/'.$file->id.'/delete') }}" style="display: none;"></span>
                                @else
                                    <span class="individual-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/file/'.$file->id.'/download') }}" style="display: none;"></span>
                                    <span class="individual-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/subsection/'.$subsection->id.'/file/'.$file->id.'/delete') }}"></span>
                                @endif
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach
            @foreach ($subsection->quizzes as $quiz)
                <div class="quiz bg-white margin-top-bottom-2 padding-10">
                    <span class="glyphicon glyphicon-star margin-left-10"></span>
                    <a href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/quiz/'.$quiz->id) }}">
                        <span class="margin-left-10">{{ $quiz->name }}</span>
                    </a>
                    <span class="icons pull-right">
                        <span class="complete glyphicon glyphicon-unchecked margin-right-10" href=""></span>
                    </span>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection

@section('script')
    <script src="{{ asset('js/section.js') }}"></script>
@endsection