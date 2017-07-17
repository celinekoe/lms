@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">Edit Event</div>
    </div>
    <div class="bg-white margin-bottom-10 padding-10">
    	<form action="{{ url('calendar') }}" method="POST">
    		<div class="form-group">
    			<label for="name">Name</label>
    			<input type="text" class="form-control" name="name" value="{{ $data['event']->name }}">
    		</div>
	    	<div class="form-group">
	    		<label for="description">Description</label>
	    		<textarea type="text" class="form-control" name="description" rows="4">{{ $data['event']->description }}</textarea>
	    	</div>
	    	<div class="flex-align-center-justify-between">
	    		<div class="form-group width-50p padding-right-5" style="width: 48.65%">
		    		<label for="date_start">Date Start</label>
		    		<input type="date" class="form-control" name="date_start" value="{{ $data['event']->date_start }}">	
		    	</div>
		    	<div class="form-group width-50p padding-left-5" style="width: 48.65%">
		    		<label for="date_end">Date End</label>
		    		<input type="date" class="form-control" name="date_end" value="{{ $data['event']->date_end }}"> 		
		    	</div>
	    	</div>
			<div class="form-group">
    			@if ($data['event']->full_day)
	    			<div class="form-group">
	    				<label for="full_day">Full Day?</label>
	    				<input type="checkbox" name="full_day" checked class="all-day">	
	    			</div>
	    			<div class="time display-none">
	    				<div class="flex-align-center-justify-between">
			    			<div class="form-group" style="width: 48.65%">
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
					    	<div class="form-group" style="width: 48.65%">
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
	    				</div>	
	    			</div>
    			@else
    				<div class="form-group">
	    				<label for="full_day">Full Day?</label>
	    				<input type="checkbox" name="full_day" checked class="all-day">	
	    			</div>
	    			<div class="time">
	    				<div class="flex-align-center-justify-between">
			    			<div class="form-group" style="width: 48.65%">
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
					    	<div class="form-group" style="width: 48.65%">
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
	    				</div>	
	    			</div>
    			@endif
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

@section('script')
	<script src="{{ asset('js/event.js') }}"></script>
@endsection
