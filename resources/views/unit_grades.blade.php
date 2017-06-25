@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-20 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} Grades</div>
    </div>
    <div class="bg-white margin-bottom-20 padding-10">
        <span class="font-size-19">Unit Grade</span>
        <span class="font-size-19 pull-right">{{ $data['unit']->grade }}</span>
    </div>
    @foreach ($data['gradeables'] as $gradeable)
    	<div class="margin-bottom-10">
	        <div class="bg-white margin-bottom-2 padding-10">
	            <span>{{ $gradeable->name }}</span>
	            <span class="pull-right">{{ $gradeable->weighted_grade }}</span>
	        </div>
	        <div class="bg-white margin-bottom-2 padding-10">
	        	<span class="padding-left-10">Weight</span>
	            <span class="pull-right">{{ $gradeable->weight }}%</span>
	        </div>
	        <div class="bg-white margin-bottom-2 padding-10">
	        	<span class="padding-left-10">Grade</span>
	            <span class="pull-right">{{ $gradeable->grade }}</span>
	        </div>
	        <div class="bg-white margin-bottom-2 padding-10">	
	        	<span class="padding-left-10">Weighted Grade</span>
	            <span class="pull-right">{{ $gradeable->weighted_grade }}</span>
	        </div>
	    </div>
    @endforeach
</div>
@endsection