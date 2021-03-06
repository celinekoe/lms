@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} Create Thread</div>
    </div>
    <div class="bg-white padding-10">
    	<form action="{{ url('unit/'.$data['unit']->id.'/forum') }}" method="POST">
	    	<div class="form-group">
	    		<label for="title">Title</label>
	    		<input type="text" class="form-control" name="title">		
	    	</div>
	    	<div class="form-group">
	    		<label for="body">Body</label>
	    		<textarea type="text" class="form-control" name="body"></textarea>		
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
