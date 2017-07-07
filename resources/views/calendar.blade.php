@extends('layouts.app')

@section('content')

<div class="margin-10">
	<div class="margin-bottom-20">
        <a href="{{ url('calendar/create') }}" class="btn btn-default pull-right">Add Event</a> 
        <div class="clear"></div>   
    </div>
	<div class="bg-white padding-left-20 padding-right-10 padding-top-bottom-10">
	    {!! $data['calendar']->calendar() !!}
    </div>
</div>
@endsection

@section('script')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js'></script>
	{!! $data['calendar']->script() !!}
@endsection