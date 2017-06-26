@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white flex-align-center margin-bottom-10 padding-left-20 padding-right-10 padding-top-bottom-10">
        <div class="section-progress c100 {{ 'p' . $data['unit']->progress }} font-size-228em green">
          <div class="slice">
            <div class="bar"></div>
            <div class="fill"></div>
          </div>
        </div>
        <div class="font-size-32 margin-left-10">{{ $data['unit']->unit_code }} {{ $data['unit']->name }}</div>
        <span class="icons margin-left-auto margin-right-10">
            <span class="download glyphicon glyphicon-download margin-top-4" href=""></span>
        </span>
    </div>
    <div class="flex-align-center-justify-around margin-bottom-10">
        <div class="unit-tab bg-white flex-align-center-justify-center margin-right-2 width-25p" style="height: 86px;">
            <a href="{{ url('unit/'.$data['unit']->id.'/info') }}">
                <div class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></div>
                <br>
                <span class="unit-tab-text">
                    Unit Info
                </span>
            </a>
        </div>
        <div class="unit-tab bg-white margin-right-2 width-25p" style="height: 86px;">
            <a href="{{ url('unit/'.$data['unit']->id.'/announcement') }}">
                <div class="glyphicon glyphicon-bullhorn" aria-hidden="true"></div>
                <br>
                <span class="unit-tab-text">
                    Announce-
                </span>
                <br>
                <span class="unit-tab-text">
                    ments
                </span>
            </a>
        </div>
        <div class="unit-tab bg-white margin-right-2 width-25p" style="height: 86px;">
            <a href="{{ url('unit/'.$data['unit']->id.'/assignments') }}">
                <div class="glyphicon glyphicon-star" aria-hidden="true"></div>
                <br>
                <span class="unit-tab-text">
                    Assign-
                </span>
                <br>
                <span class="unit-tab-text">
                    ments
                </span>
            </a>
        </div>
        <div class="unit-tab bg-white flex-align-center-justify-center width-25p" style="height: 86px;">
            <a href="{{ url('unit/'.$data['unit']->id.'/grade') }}">
                <div class="glyphicon glyphicon-signal" aria-hidden="true"></div>
                <br>
                <span class="unit-tab-text">
                    Grades
                </span>
            </a>
        </div>
    </div>    
    <div class="bg-white flex-align-center-justify-center margin-bottom-10 padding-10" style="height: 46px;">
        <a href="{{ url('unit/'.$data['unit']->id.'/forum') }}" class="flex-justify-center">
            <span class="glyphicon glyphicon glyphicon-comment margin-right-10" aria-hidden="true"></span>
            <span class="unit-tab-text">Forum</span>
        </a>
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
                    <span class="icons margin-left-auto margin-right-10">
                        <span class="download glyphicon glyphicon-download margin-top-4" href=""></span>
                    </span>
                </div>
            </div>
        </a>
    @endforeach
</div>
@endsection