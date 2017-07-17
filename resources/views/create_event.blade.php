@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">Add Event</div>
    </div>
    <div class="bg-white margin-bottom-10 padding-10">
    	<form action="{{ url('calendar') }}" method="POST" class="submit-form" href="{{ url('calendar') }}">
    		<div class="form-group">
    			<label for="name">Name</label>
    			<input type="text" class="form-control" name="name">
    		</div>
	    	<div class="form-group">
	    		<label for="description">Description</label>
	    		<textarea type="text" class="form-control" name="description"></textarea>
	    	</div>
			<div class="form-group">
				<label for="all_day">All Day?</label>
				<input type="checkbox" name="all_day" class="all-day">	
			</div>
			<div class="date-time">
				<div class="flex-align-center-justify-between">
		    		<div class="form-group width-49p padding-right-5">
			    		<label for="date_start">Date Start</label>
			    		<input type="date" class="date-start form-control" name="date_start">	
			    	</div>
			    	<div class="form-group width-49p">
			    		<label for="time_start">Time Start</label>
			    		<select class="form-control" name="time_start">
			    			@for ($i = 0; $i < 24; $i++)
			    				@for ($j = 0; $j < 2; $j++)
				    				@if ($i < 10)
				    					@if ($j < 1)
				    						<option value="0{{ $i }}:00">0{{ $i }}:00</option>
				    					@else
				    						<option value="0{{ $i }}:30">0{{ $i }}:30</option>
				    					@endif
									@else
										@if ($j < 1)
											<option value="{{ $i }}:00">{{ $i }}:00</option>
										@else
											<option value="{{ $i }}:30">{{ $i }}:30</option>
										@endif
				    				@endif
			    				@endfor
						    @endfor
			    		</select>
			    	</div>
			    </div>
			    <div class="flex-align-center-justify-between">
			    	<div class="form-group width-49p padding-left-5">
			    		<label for="date_end">Date End</label>
			    		<input type="date" class="date-end form-control" name="date_end"> 		
			    	</div>
			    	<div class="form-group width-49p">
			    		<label for="time_end">Time End</label>
			    		<select class="form-control" name="time_end">
			    			@for ($i = 0; $i < 24; $i++)
			    				@for ($j = 0; $j < 2; $j++)
				    				@if ($i < 10)
				    					@if ($j < 1)
				    						<option value="0{{ $i }}:00">0{{ $i }}:00</option>
				    					@else
				    						<option value="0{{ $i }}:30">0{{ $i }}:30</option>
				    					@endif
									@else
										@if ($j < 1)
											<option value="{{ $i }}:00">{{ $i }}:00</option>
										@else
											<option value="{{ $i }}:30">{{ $i }}:30</option>
										@endif
				    				@endif
			    				@endfor
						    @endfor
			    		</select>
			    	</div>
		    	</div>
			</div>
	    	<div class="flex">
	    		{{ csrf_field() }}
	    		<input type="submit" class="submit btn btn-default margin-left-auto" value="Submit">
	    	</div>
	    </form>	
    </div>
</div>
@endsection

@section('script')
	<script src="{{ asset('js/event.js') }}"></script>
@endsection