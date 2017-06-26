@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
	<div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} Assignments</div>
    </div>
    @foreach ($data['assignments'] as $assignment)
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
                @foreach ($assignment->files as $file)
                    <div class="asssignment_file">
                        <a href="{{ url('unit/'.$data['unit']->id.'/assignments/'.$assignment->id.'/file/'.$file->id) }}">
                            <div class="bg-white margin-bottom-2 padding-10">
                                <div class="bg-white flex-align-center">
                                    <div>{{ $file->name }}</div>
                                    <span class="icons margin-left-auto margin-right-10">
                                        <span class="download glyphicon glyphicon-download margin-top-4" href=""></span>
                                    </span>
                                </div>
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
@endsection