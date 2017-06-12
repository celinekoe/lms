@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white flex-align-center margin-bottom-20 padding-10">
        <div class="font-size-32">Messages</div>
    </div>
    <div class="margin-bottom-10">
        <a href="{{ url('messages/create') }}" class="btn btn-default margin-bottom-10 pull-right">Send Message</a> 
        <div class="clear"></div>   
    </div>
    @foreach ($data['messages'] as $message)
        <div class="margin-bottom-10">
            <div class="bg-white margin-bottom-2 padding-10">
                <div class="bg-white margin-bottom-2">
                    <span>From: {{ $message->sender->name }}</span>
                </div>
                <div class="bg-white margin-bottom-2">
                    <span>To: {{ $message->receiver->name }}</span>
                    <span class="pull-right">{{ $message->created_at_date }}</span>
                </div>
            </div>
            <div class="bg-white margin-bottom-2 padding-10">{{ $message->body }}</div>
        </div>
    @endforeach
</div>
@endsection
