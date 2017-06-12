@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-20 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} {{ $data['unit']->name }} Grades</div>
    </div>
    @foreach ($data['gradeables'] as $gradeable)
    	<div class="margin-bottom-10">
	        <div class="bg-white margin-bottom-2 padding-10">
	            <span>{{ $gradeable->name }}</span>
	            <span class="pull-right">{{ $gradeable->weighted_grade }}</span>
	        </div>
	        <div class="bg-white margin-bottom-2 padding-10">
	        	<span class="padding-left-10 small">Weight</span>
	            <span class="pull-right small">{{ $gradeable->weight }}%</span>
	        </div>
	        <div class="bg-white margin-bottom-2 padding-10">
	        	<span class="padding-left-10 small">Grade</span>
	            <span class="pull-right small">{{ $gradeable->grade }}</span>
	        </div>
	        <div class="bg-white margin-bottom-2 padding-10">	
	        	<span class="padding-left-10 small">Weighted Grade</span>
	            <span class="pull-right small">{{ $gradeable->weighted_grade }}</span>
	        </div>
	    </div>
    @endforeach
    <div class="bg-white margin-bottom-20 padding-10">
        <span>Total Grade</span>
        <span class="pull-right">{{ $data['unit']->total_grade }}</span>
    </div>
</div>
@endsection