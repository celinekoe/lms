@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">Course Grades</div>
    </div>
    @foreach ($data['units'] as $unit)
    	<div class="margin-bottom-10">
	        <div class="unit bg-white flex-align-center margin-bottom-2 padding-10">
	        	<div>{{ $unit->unit_code }} {{ $unit->name }}</div>
	        	<div class="flex-align-center margin-left-auto">
	        		<div class="margin-right-10">{{ $unit->alphabet_grade }}</div>
	        		<div class="glyphicon glyphicon-chevron-down margin-right-10"></div>
	        	</div>
	        </div>
	        <div class="unit-grades" style="display: none;">
		        @foreach ($unit->gradeables as $gradeable)
		        	<div class="unit-grades bg-white flex margin-bottom-2 padding-10">
			        	<span class="padding-left-10">{{ $gradeable->name }}</span>
			            <span class="margin-left-auto margin-right-10">{{ $gradeable->alphabet_grade }}</span>
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