@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white flex-align-center margin-bottom-10 padding-10">
        <div class="font-size-32">Downloads</div>
        <div class="margin-left-auto">
            @if ($data['course']->has_files)
                @if (!$data['course']->is_downloaded)
                    <div class="course-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('course/'.$data['course']->id.'/download') }}"></div>
                @else
                    <div class="course-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('course/'.$data['course']->id.'/download') }}" style="display: none"></div>
                @endif
                @if ($data['course']->is_deleted)
                    <div class="course-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('course/'.$data['course']->id.'/delete') }}" style="display: none"></div>
                @else
                    <div class="course-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('course/'.$data['course']->id.'/delete') }}"></div>
                @endif
            @endif
        </div>
    </div>
    <div>
        @foreach ($data['course']->units as $unit)
            <div>
                <div class="unit bg-white flex-align-center margin-bottom-2 padding-10">
                    <div class="font-size-19 margin-left-10">{{ $unit->unit_code }} {{ $unit->name }}</div>
                    <span class="margin-left-auto">
                        @if ($unit->has_files)
                            @if (!$unit->is_downloaded)
                                <div class="unit-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/download') }}"></div>
                            @else
                                <div class="unit-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/download') }}" style="display: none;"></div>
                            @endif
                            @if ($unit->is_deleted)
                                <div class="unit-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/delete') }}" style="display: none;"></div>
                            @else
                                <div class="unit-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/delete') }}"></div>
                            @endif
                            <span class="unit-open glyphicon glyphicon-chevron-down margin-right-10" href=""></span>
                        @endif
                    </span>
                </div>
                <div class="unit-files display-none">
                    <div class="bg-white flex-align-center margin-bottom-2 padding-10">
                        <div class="margin-left-10">Unit Info</div>
                        <span class="margin-left-auto">
                            @if ($unit->unit_info_has_files)
                                @if (!$unit->unit_info_is_downloaded)
                                    <div class="unit-info-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/unit_info/download') }}"></div>
                                @else
                                    <div class="unit-info-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/unit_info/download') }}" style="display: none;"></div>
                                @endif
                                @if ($unit->unit_info_is_deleted)
                                    <div class="unit-info-delete glyphicon glyphicon-remove-circle margin-right-10" href="{{ url('unit/'.$unit->id.'/unit_info/delete') }}" style="display: none;"></div>
                                @else
                                    <div class="unit-info-delete glyphicon glyphicon-remove-circle margin-right-10" href="{{ url('unit/'.$unit->id.'/unit_info/delete') }}"></div>
                                @endif
                            @endif
                        </span>
                    </div>
                    <div class="">
                        <div class="assignments bg-white flex-align-center margin-bottom-2 padding-10">
                            <div class="margin-left-10">Assignments</div>
                            <div class="margin-left-auto">
                                @if ($unit->assignments_has_files)
                                    @if (!$unit->assignments_is_downloaded)
                                        <div class="assignments-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/assignments/download') }}"></div>
                                    @else
                                        <div class="assignments-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/assignments/download') }}" style="display: none;"></div>
                                    @endif
                                    @if ($unit->assignments_is_deleted)
                                        <div class="assignments-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/assignments/delete') }}" style="display: none;"></div>
                                    @else
                                        <div class="assignments-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/assignments/delete') }}"></div>
                                    @endif
                                    <div class="assignments-open glyphicon glyphicon-chevron-down margin-right-10" href=""></div>
                                @endif
                            </div>
                        </div>
                        <div class="assignments-files display-none">
                            @foreach ($unit->assignments as $assignment)
                                <div class=" assignment bg-white flex-align-center margin-bottom-2 padding-10">
                                    <div class="margin-left-10">{{ $assignment->name }}</div>
                                    <span class="margin-left-auto">
                                        @if ($assignment->has_files)
                                            @if (!$assignment->is_downloaded)
                                                <div class="assignment-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/assignment/'.$assignment->id.'/download') }}"></div>
                                            @else
                                                <div class="assignment-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/assignment/'.$assignment->id.'/download') }}" style="display: none;"></div>
                                            @endif
                                            @if ($assignment->is_deleted)
                                                <div class="assignment-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/assignment/'.$assignment->id.'/delete') }}" style="display: none;"></div>
                                            @else
                                                <div class="assignment-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/assignment/'.$assignment->id.'/delete') }}"></div>
                                            @endif
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <div class="sections bg-white flex-align-center margin-bottom-2 padding-10">
                            <div class="margin-left-10">Sections</div>
                            <div class="margin-left-auto">
                                @if ($unit->sections_has_files)
                                    @if (!$unit->sections_is_downloaded)
                                        <div class="sections-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/sections/download') }}"></div>
                                    @else
                                        <div class="sections-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/sections/download') }}" style="display: none;"></div>
                                        
                                    @endif
                                    @if ($unit->sections_is_deleted)
                                        <div class="sections-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/sections/delete') }}" style="display: none;"></div>
                                    @else
                                        <div class="sections-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/sections/delete') }}"></div>
                                    @endif
                                    <div class="sections-open glyphicon glyphicon-chevron-down margin-right-10" href=""></div>
                                @endif
                            </div>
                        </div>
                        <div class="sections-files display-none">
                            @foreach ($unit->sections as $section)
                                <div class=" section bg-white flex-align-center margin-bottom-2 padding-10">
                                    <div class="margin-left-10">{{ $section->name }}</div>
                                    <span class="margin-left-auto">
                                        @if ($section->has_files)
                                            @if (!$section->is_downloaded)
                                                <div class="section-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/section/'.$section->id.'/download') }}"></div>
                                            @else
                                                <div class="section-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/section/'.$section->id.'/download') }}" style="display: none;"></div>
                                            @endif
                                            @if ($section->is_deleted)
                                                 <div class="section-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/section/'.$section->id.'/delete') }}" style="display: none;"></div>
                                            @else
                                                <div class="section-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$unit->id.'/section/'.$section->id.'/delete') }}"></div>
                                            @endif
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>
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
