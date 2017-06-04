@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
	<div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} {{ $data['unit']->name }} Assignments</div>
    </div>
    @foreach ($data['assignments'] as $assignment)
        <a href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id) }}">
            <div class="bg-white margin-bottom-10 padding-10">
                <div>{{ $data['unit']->unit_code }} {{ $assignment->name }}</div>
                <div class="small">Due Date {{ $assignment->submit_by_date_format }}</div>
            </div>
        </a>
    @endforeach
</div>
@endsection
