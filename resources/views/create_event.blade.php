@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-20 padding-10">
        <div class="font-size-32">Create Event</div>
    </div>
    <div class="bg-white padding-10">
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
	    		<label for="date_start">Date Start</label>
	    		<input type="date" class="form-control" name="date_start">	
	    	</div>
	    	<div class="form-group">
	    		<label for="date_end">Date End</label>
	    		<input type="date" class="form-control" name="date_end"> 		
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
