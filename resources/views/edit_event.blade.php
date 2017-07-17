@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">Edit Event</div>
    </div>
    <div class="bg-white margin-bottom-10 padding-10">
    	<form action="{{ url('calendar/'.$data['event']->id) }}" method="POST" class="submit-form" href="{{ url('calendar/'.$data['event']->id.'/edit') }}">
    		<div class="name form-group">
    			<label for="name">Name</label>
    			<input type="text" class="form-control" name="name" value="{{ $data['event']->name }}">
    		</div>
	    	<div class="description form-group">
	    		<label for="description">Description</label>
	    		<textarea type="text" class="form-control" name="description" rows="4">{{ $data['event']->description }}</textarea>
	    	</div>
	    	@if ($data['event']->all_day)
	    		<div class="form-group">
    				<label for="all_day">All Day?</label>
    				<input type="checkbox" name="all_day" checked class="all-day">	
    			</div>
    			<div class="date">
    				<div class="flex-align-center-justify-between">
			    		<div class="form-group width-49p padding-right-5">
				    		<label for="date_start">Date Start</label>
				    		<input type="date" class="date-start form-control" name="date_start" value="{{ $data['event']->date_start }}">	
				    	</div>
			    	</div>
			    	<div class="flex-align-center-justify-between">
				    	<div class="form-group width-49p padding-left-5">
				    		<label for="date_end">Date End</label>
				    		<input type="date" class="date-end form-control" name="date_end" value="{{ $data['event']->date_end }}"> 		
				    	</div>
			    	</div>
    			</div>
    		@else
    			<div class="form-group">
    				<label for="all_day">All Day?</label>
    				<input type="checkbox" name="all_day" class="all-day">	
    			</div>
    			<div class="date-time">
    				<div class="flex-align-center-justify-between">
			    		<div class="form-group width-49p padding-right-5">
				    		<label for="date_start">Date Start</label>
				    		<input type="date" class="date-start form-control" name="date_start" value="{{ $data['event']->date_start }}">	
				    	</div>
				    	<div class="form-group width-49p">
				    		<label for="time_start">Time Start</label>
				    		<select class="form-control" name="time_start">
				    			@for ($i = 0; $i < 24; $i++)
				    				@for ($j = 0; $j < 2; $j++)
					    				@if ($i < 10)
					    					@if ($j < 1)
					    						@if (strcmp($data['event']->formatted_time_start,  '0'.$i.':00') == 0)
					    							<option value="0{{ $i }}:00" selected>0{{ $i }}:00</option>
					    							}
					    						@else
					    							<option value="0{{ $i }}:00">0{{ $i }}:00</option>
					    						@endif
					    					@else
					    						@if (strcmp($data['event']->formatted_time_start, '0'.$i.':30') == 0)
					    							<option value="0{{ $i }}:30" selected>0{{ $i }}:30</option>
					    						@else
					    							<option value="0{{ $i }}:30">0{{ $i }}:30</option>
					    						@endif
					    					@endif
										@else
											@if ($j < 1)
												@if (strcmp($data['event']->formatted_time_start, $i.':00') == 0)
													<option value="{{ $i }}:00" selected>{{ $i }}:00</option>
												@else
													<option value="{{ $i }}:00">{{ $i }}:00</option>
												@endif
											@else
												@if (strcmp($data['event']->formatted_time_start, $i.':30') == 0)
													<option value="{{ $i }}:30" selected>{{ $i }}:30</option>
												@else
													<option value="{{ $i }}:30">{{ $i }}:30</option>
												@endif
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
				    		<input type="date" class="date-end form-control" name="date_end" value="{{ $data['event']->date_end }}"> 		
				    	</div>
				    	<div class="form-group width-49p">
				    		<label for="time_end">Time End</label>
				    		<select class="form-control" name="time_end">
				    			@for ($i = 0; $i < 24; $i++)
				    				@for ($j = 0; $j < 2; $j++)
					    				@if ($i < 10)
					    					@if ($j < 1)
					    						@if (strcmp($data['event']->formatted_time_end,  '0'.$i.':00') == 0)
					    							<option value="0{{ $i }}:00" selected>0{{ $i }}:00</option>
					    							}
					    						@else
					    							<option value="0{{ $i }}:00">0{{ $i }}:00</option>
					    						@endif
					    					@else
					    						@if (strcmp($data['event']->formatted_time_end, '0'.$i.':30') == 0)
					    							<option value="0{{ $i }}:30" selected>0{{ $i }}:30</option>
					    						@else
					    							<option value="0{{ $i }}:30">0{{ $i }}:30</option>
					    						@endif
					    					@endif
										@else
											@if ($j < 1)
												@if (strcmp($data['event']->formatted_time_end, $i.':00') == 0)
													<option value="{{ $i }}:00" selected>{{ $i }}:00</option>
												@else
													<option value="{{ $i }}:00">{{ $i }}:00</option>
												@endif
											@else
												@if (strcmp($data['event']->formatted_time_end, $i.':30') == 0)
													<option value="{{ $i }}:30" selected>{{ $i }}:30</option>
												@else
													<option value="{{ $i }}:30">{{ $i }}:30</option>
												@endif
											@endif
					    				@endif
				    				@endfor
							    @endfor
				    		</select>
				    	</div>
			    	</div>
    			</div>
	    	@endif
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
