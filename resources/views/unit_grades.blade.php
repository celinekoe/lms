@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} Grades</div>
    </div>
    <div class="flex-align-center bg-white margin-bottom-10 padding-10">
        <div class="font-size-19">Unit Grade</div>
        <div class="font-size-19 margin-left-auto">{{ $data['unit']->grade }}</div>
    </div>
    <div class="unit-grades">
	    @foreach ($data['gradeables'] as $gradeable)
	    	<div class="margin-bottom-10">
		        <div class="unit-grade flex-align-center bg-white margin-bottom-2 padding-10">
		            <div>{{ $gradeable->name }}</div>
		            <div class="flex-align-center margin-left-auto">
		            	<div class="margin-right-10">{{ $gradeable->weighted_grade }}</div>
		            	<div class="glyphicon glyphicon-chevron-down" aria-hidden="true"></div>	
		            </div>
		        </div>
		        <div class="unit-gradeable-components" style="display: none;">
		        	<div class="bg-white margin-bottom-2 padding-10">
			        	<span class="padding-left-10">Weight</span>
			            <span class="pull-right">{{ $gradeable->weight }}%</span>
			        </div>
			        <div class="bg-white margin-bottom-2 padding-10">
			        	<span class="padding-left-10">Grade</span>
			            <span class="pull-right">{{ $gradeable->grade }}</span>
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