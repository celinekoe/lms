@extends('layouts.app')

@section('content')
<div class="unit-assignments margin-10">
	<div class="bg-white flex-align-center margin-bottom-10 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} Assignments</div>
        <div class="margin-left-auto margin-right-10">
            @if ($data['unit']->assignments_has_files)
                @if (!$data['unit']->assignments_is_downloaded)
                    <div class="assignments-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/assignments/download') }}"></div>
                    <div class="assignments-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/assignments/delete') }}" style="display: none;"></div>
                @else
                    <div class="assignments-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/assignments/download') }}" style="display: none;"></div>
                    <div class="assignments-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/assignments/delete') }}"></div>
                @endif
            @endif
        </div>
    </div>
    @foreach ($data['unit']->assignments as $assignment)
        <div class="margin-bottom-10">
            <div class="assignment">
                <a href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id) }}" class="flex-align-center bg-white margin-bottom-2 padding-10">
                    <div>
                        <div>{{ $assignment->name }}</div>
                        <div class="small">Due Date {{ $assignment->formatted_submit_by_date }}</div> 
                    </div>
                    <div class="margin-left-auto margin-right-10">
                        @if ($assignment->has_files) <!-- includes uploaded assignment files -->
                            @if ($assignment->files->count() > 0) <!-- excludes uploaded assignment files -->
                                @if (!$assignment->is_downloaded)
                                    <div class="assignment-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/download') }}"></div>
                                    <div class="assignment-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/delete') }}" style="display: none;"></div>
                                @else
                                    <div class="assignment-download glyphicon glyphicon-download margin-top-4 margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/download') }}" style="display: none;"></div>
                                    <div class="assignment-delete glyphicon glyphicon-remove-circle margin-top-4 margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/delete') }}"></div>
                                @endif   
                                <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                            @else
                                @if (!$assignment->is_downloaded)
                                    <div class="assignment-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/download') }}"></div>
                                    <div class="assignment-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/delete') }}" style="display: none;"></div>
                                @else
                                    <div class="assignment-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/download') }}" style="display: none;"></div>
                                    <div class="assignment-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/delete') }}"></div>
                                @endif  
                            @endif 
                        @endif
                    </div>
                </a>   
            </div>
            <div class="assignments-files">
                @foreach ($assignment->files as $assignment_file)
                    <div class="assignment-files display-none">
                        <a href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/file/'.$assignment_file->id) }}" class="bg-white flex-align-center margin-bottom-2 padding-10">
                            <div class="flex-align-center">
                                @if ($assignment_file->type == 'video')
                                    <div class="glyphicon glyphicon-facetime-video margin-left-10"></div>
                                    <div class="margin-left-10">[{{ $assignment_file->formatted_file_size}}, {{ $assignment_file->length }}]&nbsp;</div>
                                @elseif ($assignment_file->type == 'document')
                                    <div class="glyphicon glyphicon-book margin-left-right-10"></div>
                                @endif    
                                <div>{{ $assignment_file->name }}</div>
                            </div>
                            <div class="download-container bg-white margin-left-auto margin-right-10">
                                @if (!$assignment_file->is_downloaded)
                                    <div class="file-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/file/'.$assignment_file->id.'/download') }}"></div>
                                    <div class="file-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/file/'.$assignment_file->id.'/delete') }}" style="display: none;"></div>
                                @else
                                    <div class="file-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/file/'.$assignment_file->id.'/download') }}" style="display: none;"></div>
                                    <div class="file-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/file/'.$assignment_file->id.'/delete') }}"></div>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('script')
    <script src="{{ asset('js/assignments.js') }}"></script>
    <script src="{{ asset('js/confirm.js') }}"></script>
@endsection