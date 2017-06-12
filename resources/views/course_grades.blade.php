@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-20 padding-10">
        <div class="font-size-32">Grades</div>
    </div>
    @foreach ($data['units'] as $unit)
    	<div class="margin-bottom-10">
	        <div class="bg-white margin-bottom-2 padding-10">
	            <span>{{ $unit->name }}</span>
	            <span class="pull-right">{{ $unit->total_grade }}</span>
	        </div>
	        @foreach ($unit->gradeables as $gradeable)
		    	<div class="bg-white margin-bottom-2 padding-10">
		        	<span class="padding-left-10 small">{{ $gradeable->name }}</span>
		            <span class="pull-right small">{{ $gradeable->weighted_grade }}</span>
		        </div>
		    @endforeach
	    </div>
    @endforeach
</div>
@endsection