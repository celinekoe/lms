@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">Course Dashboard</div>
    </div>
    @foreach ($data['units'] as $unit)
        <div>
            <a href="{{ url('unit/'.$unit->id) }}">
                <div class="unit bg-white flex-align-center margin-bottom-10 padding-left-20 padding-right-10 padding-top-bottom-10">
                    <div class="section-progress c100 {{ 'p' . $unit->progress }} font-size-171em green">
                      <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                      </div>
                    </div>
                    <div class="margin-left-10">
                        <div>{{ $unit->unit_code }} {{ $unit->name }}</div>
                        <div class="small">Due Date {{ $unit->submit_by_date }}</div>
                    </div>
                    <div class="margin-left-auto">
                        <!-- <div class="glyphicon glyphicon-chevron-down margin-right-10" aria-hidden="true"></div> -->
                        <div class="glyphicon glyphicon-chevron-right margin-right-10"></div>
                    </div>
                </div>
            </a>
            <div class="unit-tabs display-none">
                <div class="flex-align-center-justify-around margin-bottom-2">
                    <a href="{{ url('unit/'.$unit->id.'/unit_info') }}" class="unit-tab unit-info-tab bg-white flex-align-center-justify-center margin-right-2 width-25p" style="height: 86px;">
                        <div>
                            <div class="glyphicon glyphicon-exclamation-sign flex-justify-center margin-bottom-4" aria-hidden="true"></div>
                            <div>
                                Unit Info
                            </div>
                        </div>
                    </a>
                    <a href="{{ url('unit/'.$unit->id.'/announcement') }}" class="unit-tab announcements-tab bg-white flex-align-center-justify-center margin-right-2 width-25p" style="height: 86px;">
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
                    <a href="{{ url('unit/'.$unit->id.'/assignments') }}" class="unit-tab assignments-tab bg-white flex-align-center-justify-center margin-right-2 width-25p" style="height: 86px;">
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
                    <a href="{{ url('unit/'.$unit->id.'/grade') }}" class="unit-tab grades-tab bg-white flex-align-center-justify-center width-25p" style="height: 86px;">
                        <div>
                            <div class="glyphicon glyphicon-signal flex-justify-center margin-bottom-4" aria-hidden="true"></div>
                            <div class="flex-justify-center">
                                Grades
                            </div>
                        </div>
                    </a>
                </div>
                <a href="{{ url('unit/'.$unit->id.'/forum') }}" class="unit-tab forum-tab bg-white flex-align-center-justify-center margin-bottom-10 padding-10" style="height: 61px;">
                    <div class="flex-align-center">
                        <div class="glyphicon glyphicon glyphicon-comment margin-right-4" aria-hidden="true"></div>
                        <div>Forum</div>    
                    </div>
                </a>
            </div>   
        </div>
    @endforeach
</div>
@endsection

@section('script')
    <script src="{{ asset('js/home.js') }}"></script>
@endsection
