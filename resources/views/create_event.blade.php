@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-20 padding-10">
        <div class="font-size-32">Add Event</div>
    </div>
    <div class="bg-white margin-bottom-20 padding-10">
    	<form action="{{ url('calendar') }}" method="POST">
    		<div class="row">
    			<div class="col-xs-9">
    				<div class="form-group">
		    			<label for="name">Name</label>
		    			<input type="text" class="form-control" name="name">
		    		</div>	
    			</div>
    			<div class="col-xs-3">
    				<div class="form-group">
		    			<label for="full_day">Full Day?</label>
		    			<div class="flex-align-start">
		    				<input type="checkbox" style="margin: 0px;" name="full_day">	
		    			</div>
		    		</div>
    			</div>
	    	</div>
	    	<div class="form-group">
	    		<label for="description">Description</label>
	    		<textarea type="text" class="form-control" name="description"></textarea>
	    	</div>
	    	
	    	<div class="form-group">
	    		<label for="date_start">Date Start</label>
	    		<input type="date" class="form-control" name="date_start">	
	    	</div>
	    	<div class="form-group">
	    		<label for="date_end">Date End</label>
	    		<input type="date" class="form-control" name="date_end"> 		
	    	</div>
	    	<div class="form-group">
	    		<label for="time_start">Time Start</label>
	    		<select class="form-control" name="time_start">
	    			@for ($i = 0; $i <= 23; $i++)
	    				@if ($i < 10)
							<option value="0{{ $i }}:00">0{{ $i }}:00</option>
							<option value="0{{ $i }}:30">0{{ $i }}:30</option>
						@else
							<option value="{{ $i }}:00">0{{ $i }}:00</option>
							<option value="{{ $i }}:30">0{{ $i }}:30</option>
	    				@endif
				    @endfor
	    		</select>
	    	</div>
	    	<div class="form-group">
	    		<label for="time_end">Time End</label>
	    		<select class="form-control" name="time_end">
	    			@for ($i = 0; $i < 24; $i++)
	    				@if ($i < 10)
							<option value="0{{ $i }}:00">0{{ $i }}:00</option>
							<option value="0{{ $i }}:30">0{{ $i }}:30</option>
						@else
							<option value="{{ $i }}:00">0{{ $i }}:00</option>
							<option value="{{ $i }}:30">0{{ $i }}:30</option>
	    				@endif
				    @endfor
	    		</select>
	    	</div>
	    	<div>
	    		<input type="submit" class="btn btn-default pull-right" value="Submit">	
	    		<div class="clear"></div>
	    	</div>
		    {{ csrf_field() }}	
	    </form>	
    </div>
</div>
@endsection
