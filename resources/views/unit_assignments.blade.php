@extends('layouts.app')

@section('content')
<div class="unit-assignments margin-10">
	<div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} Assignments</div>
    </div>
    @foreach ($data['unit']->assignments as $assignment)
        <div class="margin-bottom-10">
            <div class="assignment">
                <a href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id) }}">
                    <div class="flex-align-center bg-white margin-bottom-2 padding-10">
                        <div>
                            <div>{{ $data['unit']->unit_code }} {{ $assignment->name }}</div>
                            <div class="small">Due Date {{ $assignment->submit_by_date_format }}</div>    
                        </div>
                        <div class="glyphicon glyphicon-chevron-down margin-left-auto margin-right-10" aria-hidden="true"></div>
                    </div>
                </a>
            </div>
            <div class="assignment-files" style="display:none">
                @foreach ($assignment->files as $assignment_file)
                    <div class="asssignment_assignment_file">
                        <a href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id.'/file/'.$assignment_file->id) }}" class="bg-white flex-align-center margin-bottom-2 padding-10">
                            <div class="flex-align-center">
                                @if ($assignment_file->type == 'video')
                                    <div class="glyphicon glyphicon-facetime-video margin-left-right-10"></div>
                                @elseif ($assignment_file->type == 'document')
                                    <div class="glyphicon glyphicon-book margin-left-right-10"></div>
                                @endif    
                                <div>{{ $assignment_file->name }}</div>
                            </div>
                            <div class="download-container bg-white margin-left-auto margin-right-10">
                                @if (!$assignment_file->downloaded)
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