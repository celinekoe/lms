@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-20 padding-10">
        <div class="font-size-32">Downloads</div>
    </div>
    <div>
        @foreach ($data['units'] as $unit)
            <div>
                <div class="unit bg-white flex-align-center margin-bottom-2 padding-10">
                    <div class="font-size-19 margin-left-10">{{ $unit->unit_code }} {{ $unit->name }}</div>
                    <span class="margin-left-auto margin-right-10">
                        @if (!$unit->is_downloaded)
                            <div class="unit-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/download') }}"></div>
                            <div class="unit-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/delete') }}" style="display: none;"></div>
                        @else
                            <div class="unit-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/download') }}" style="display: none;"></div>
                            <div class="unit-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/delete') }}"></div>
                        @endif
                        <span class="glyphicon glyphicon-chevron-down" href=""></span>
                    </span>
                </div>
                <div class="unit-files display-none">
                    <div class="bg-white flex-align-center margin-bottom-2 padding-10">
                        <div class="margin-left-10">Unit Info</div>
                        <span class="margin-left-auto margin-right-10">
                            @if (!$unit->unit_info_is_downloaded)
                                <div class="unit-info-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$unit->id.'/unit_info/download') }}"></div>
                                <div class="unit-info-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$unit->id.'/unit_info/delete') }}" style="display: none;"></div>
                            @else
                                <div class="unit-info-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$unit->id.'/unit_info/download') }}" style="display: none;"></div>
                                <div class="unit-info-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$unit->id.'/unit_info/delete') }}"></div>
                            @endif
                        </span>
                    </div>
                    <div class="bg-white flex-align-center margin-bottom-2 padding-10">
                        <div class="margin-left-10">Assignments</div>
                        <span class="margin-left-auto margin-right-10">
                            @if (!$unit->assignments_is_downloaded)
                                <div class="assignments-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$unit->id.'/assignments/download') }}"></div>
                                <div class="assignments-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$unit->id.'/assignments/delete') }}" style="display: none;"></div>
                            @else
                                <div class="assignments-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$unit->id.'/assignments/download') }}" style="display: none;"></div>
                                <div class="assignments-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$unit->id.'/assignments/delete') }}"></div>
                            @endif
                        </span>
                    </div>
        <!--             <div class="bg-white flex-align-center margin-bottom-2 padding-10">
                        <div class="margin-left-10">Sections</div>
                        <span class="margin-left-auto margin-right-10">
                            @if (!$unit->sections_is_downloaded)
                                <div class="assignments-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$unit->id.'/sections/download') }}"></div>
                                <div class="assignments-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$unit->id.'/sections/delete') }}" style="display: none;"></div>
                            @else
                                <div class="assignments-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$unit->id.'/sections/download') }}" style="display: none;"></div>
                                <div class="assignments-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$unit->id.'/sections/delete') }}"></div>
                            @endif
                        </span>
                    </div>
         -->        
                    <div>
                        @foreach ($unit->sections as $section)
                            <div class="bg-white flex-align-center margin-bottom-2 padding-10">
                                <div class="margin-left-10">{{ $section->name }}</div>
                                <span class="margin-left-auto margin-right-10">
                                    @if (!$section->is_downloaded)
                                        <div class="section-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$unit->id.'/section/'.$section->id.'/download') }}"></div>
                                        <div class="section-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$unit->id.'/section/'.$section->id.'/delete') }}" style="display: none;"></div>
                                    @else
                                        <div class="section-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$unit->id.'/section/'.$section->id.'/download') }}" style="display: none;"></div>
                                        <div class="section-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$unit->id.'/section/'.$section->id.'/delete') }}"></div>
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="margin-bottom-10"></div>    
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/downloads.js') }}"></script>
    <script src="{{ asset('js/confirm.js') }}"></script>
@endsection
