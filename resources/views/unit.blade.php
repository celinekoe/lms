@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white flex-align-center margin-bottom-2 padding-left-20 padding-right-10 padding-top-bottom-10">
        <div class="section-progress c100 {{ 'p' . $data['unit']->progress }} font-size-228em green">
          <div class="slice">
            <div class="bar"></div>
            <div class="fill"></div>
          </div>
        </div>
        <div class="font-size-32 margin-left-10">{{ $data['unit']->unit_code }} {{ $data['unit']->name }}</div>
        <div class="flex-align-center margin-left-auto">
            @if ($data['unit']->is_downloaded == false)
                <div class="unit-download glyphicon glyphicon-download margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/download') }}"></div>
                <div class="unit-delete glyphicon glyphicon-remove-circle margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/delete') }}" style="display: none"></div>
            @else
                <div class="unit-download glyphicon glyphicon-download margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/download') }}" style="display: none"></div>
                <div class="unit-delete glyphicon glyphicon-remove-circle margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/delete') }}"></div>
            @endif
        </div>
    </div>
    <div class="unit-tabs flex-align-center-justify-around margin-bottom-2">
        <a href="{{ url('unit/'.$data['unit']->id.'/unit_info') }}" class="unit-tab unit-info-tab bg-white flex-align-center-justify-center margin-right-2 width-25p" style="height: 86px;">
            <div>
                <div class="glyphicon glyphicon-exclamation-sign flex-justify-center margin-bottom-4" aria-hidden="true"></div>
                <div>
                    Unit Info
                </div>
            </div>
        </a>
        <a href="{{ url('unit/'.$data['unit']->id.'/announcement') }}" class="unit-tab announcements-tab bg-white flex-align-center-justify-center margin-right-2 width-25p" style="height: 86px;">
            <div>
                <div class="glyphicon glyphicon-bullhorn flex-justify-center margin-bottom-4" aria-hidden="true"></div>
                <div class="flex-justify-center">
                    Announce-
                </div>
                <div class="flex-justify-center">
                    ments
                </div>
            </div>
        </a>
        <a href="{{ url('unit/'.$data['unit']->id.'/assignments') }}" class="unit-tab assignments-tab bg-white flex-align-center-justify-center margin-right-2 width-25p" style="height: 86px;">
            <div>
                <div class="glyphicon glyphicon-star flex-justify-center margin-bottom-4" aria-hidden="true"></div>
                <div class="flex-justify-center">
                    Assign-
                </div>
                <div class="flex-justify-center">
                    ments
                </div>
            </div>
        </a>
        <a href="{{ url('unit/'.$data['unit']->id.'/grade') }}" class="unit-tab grades-tab bg-white flex-align-center-justify-center width-25p" style="height: 86px;">
            <div>
                <div class="glyphicon glyphicon-signal flex-justify-center margin-bottom-4" aria-hidden="true"></div>
                <div class="flex-justify-center">
                    Grades
                </div>
            </div>
        </a>
    </div>    
    <a href="{{ url('unit/'.$data['unit']->id.'/forum') }}" class="unit-tab forum-tab bg-white flex-align-center-justify-center margin-bottom-10 padding-10" style="height: 71px;">
        <div class="flex-align-center">
            <div class="glyphicon glyphicon glyphicon-comment margin-right-4" aria-hidden="true"></div>
            <div>Forum</div>
        </div>
    </a>
    <div class="bg-white flex-align-center margin-bottom-2 padding-left-20 padding-right-10 padding-top-bottom-10">
        <div class="section-progress margin-right-10">
            <div class="c100 {{ 'p' . $data['unit']->sections_progress }} font-size-171em green">
              <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
              </div>
            </div>
        </div>
        @if ($data['unit']->unit_info_is_downloaded)
            <div class="unit-info-is-downloaded"></div>
        @endif
        @if ($data['unit']->assignments_is_downloaded)
            <div class="assignments-is-downloaded"></div>
        @endif
        <div class="font-size-19">Sections</div>
        <div class="margin-left-auto">
            @if ($data['unit']->sections_is_downloaded == false)
                <div class="sections-download glyphicon glyphicon-download margin-right-10 margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/sections/download') }}"></div>
                <div class="sections-delete glyphicon glyphicon-remove-circle margin-right-10 margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/sections/delete') }}" style="display: none"></div>
            @else
                <div class="sections-download glyphicon glyphicon-download margin-right-10 margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/sections/download') }}" style="display: none"></div>
                <div class="sections-delete glyphicon glyphicon-remove-circle margin-right-10 margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/sections/delete') }}"></div>
            @endif
        </div>
    </div>
    @foreach ($data['unit']->sections as $section)
        <a href="{{ url('unit/'.$data['unit']->id.'/section/'.$section->id) }}">
            <div class="bg-white margin-bottom-2 padding-10">
                <div class="bg-white flex-align-center margin-left-10">
                    <div class="section-progress c100 {{ 'p' . $section->progress }} font-size-171em green">
                      <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                      </div>
                    </div>
                    <div class="margin-left-10">{{ $section->name }}</div>
                    <div class="margin-left-auto">
                        @if ($section->has_files)
                            @if ($section->is_downloaded == false)
                                <div class="section-download glyphicon glyphicon-download margin-right-10 margin-top-4" href="{{ url('unit/'.$section->unit_id.'/section/'.$section->id.'/download') }}"></div>
                                <div class="section-delete glyphicon glyphicon-remove-circle margin-right-10 margin-top-4" href="{{ url('unit/'.$section->unit_id.'/section/'.$section->id.'/delete') }}" style="display: none"></div>
                            @else
                                <div class="section-download glyphicon glyphicon-download margin-right-10 margin-top-4" href="{{ url('unit/'.$section->unit_id.'/section/'.$section->id.'/download') }}" style="display: none"></div>
                                <div class="section-delete glyphicon glyphicon-remove-circle margin-right-10 margin-top-4" href="{{ url('unit/'.$section->unit_id.'/section/'.$section->id.'/delete') }}"></div>
                            @endif
                        @endif
                        <div class="glyphicon glyphicon-chevron-right margin-right-10"></div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>
@endsection

@section('script')
    <script src="{{ asset('js/unit.js') }}"></script>
    <script src="{{ asset('js/confirm.js') }}"></script>
@endsection