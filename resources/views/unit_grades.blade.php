@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} Grades</div>
    </div>
    <div class="unit-header flex-align-center bg-white padding-10">
        <div class="font-size-19">Unit Grade</div>
        <div class="flex-align-center font-size-19 margin-left-auto">
        	<div class="margin-right-10">{{ $data['unit']->alphabet_grade }}</div>
        	<div class="glyphicon glyphicon-chevron-down unit-chevron margin-right-10"></div>
        </div>
    </div>
    <div class="unit-body display-none">
    	<div class="bg-white flex margin-top-2 padding-10">
	    	<span class="padding-left-10">Weighted Score</span>
	        <span class="margin-left-auto margin-right-10">{{ $data['unit']->grade }}</span>
	    </div>
    </div>
    <div class="gradeables margin-top-10">
	    @foreach ($data['gradeables'] as $gradeable)
	    	<div>
		        <div class="gradeable-header flex-align-center bg-white margin-bottom-2 padding-10">
		            <div>{{ $gradeable->name }}</div>
		            <div class="flex-align-center margin-left-auto">
		            	<div class="margin-right-10">{{ $gradeable->alphabet_grade }}</div>
		            	<div class="glyphicon glyphicon-chevron-down gradeable-chevron margin-right-10"></div>	
		            </div>
		        </div>
		        <div class="gradeable-body" style="display: none;">
			        <div class="bg-white flex margin-bottom-2 padding-10">
			        	<span class="padding-left-10">Score</span>
			            <span class="margin-left-auto margin-right-10">{{ $gradeable->grade }}</span>
			        </div>
			        <div class="bg-white flex margin-bottom-2 padding-10">
			        	<span class="padding-left-10">Weight</span>
			            <span class="margin-left-auto margin-right-10">{{ $gradeable->weight }}%</span>
			        </div>
			        <div class="bg-white flex margin-bottom-2 padding-10">
			        	<span class="padding-left-10">Weighted Score</span>
			            <span class="margin-left-auto margin-right-10">{{ $gradeable->weighted_grade }}</span>
			        </div>
		        </div>
		    </div>
	    @endforeach
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/unit_grades.js') }}"></script>
@endsection