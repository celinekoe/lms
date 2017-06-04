@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} {{ $data['unit']->name }} Grades</div>
    </div>
    @foreach ($data['assignments'] as $assignment)
        <div class="bg-white margin-bottom-2 padding-10">
            <span>{{ $assignment->name }}</span>
            <span class="pull-right">{{ $assignment->grade }}</span>
        </div>
    @endforeach
</div>
@endsection