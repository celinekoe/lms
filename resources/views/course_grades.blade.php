@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">Grades</div>
    </div>
    @foreach ($data['units'] as $unit)
    	<div class="margin-bottom-10">
	        <div class="unit flex-align-center bg-white margin-bottom-2 padding-10">
	        	<div>{{ $unit->unit_code }} {{ $unit->name }}</div>
	        	<div class="margin-left-auto">
	        		<span class="margin-right-10">{{ $unit->grade }}</span>
	        		<div class="glyphicon glyphicon-chevron-down" aria-hidden="true"></div>
	        	</div>
	        </div>
	        <div class="unit-grades" style="display: none;">
		        @foreach ($unit->gradeables as $gradeable)
		        	<div class="unit-grades bg-white margin-bottom-2 padding-10">
			        	<span class="padding-left-10">{{ $gradeable->name }}</span>
			            <span class="pull-right">{{ $gradeable->weighted_grade }}</span>
			        </div>
		        @endforeach
	        </div>
	        
		    	
		   	
	    </div>
    @endforeach
</div>
@endsection

@section('script')
    <script src="{{ asset('js/course_grades.js') }}"></script>
@endsection