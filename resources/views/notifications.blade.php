@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-20 padding-10">
        <div class="font-size-32">Notifications</div>
    </div>
    @foreach ($data['notifications'] as $notification)
        <div class="margin-bottom-10">
            <div class="bg-white margin-bottom-2 padding-10">
                <div class="pull-right">{{ $notification->created_at_date }}</div>
                <div class="clear"></div>
            </div>
            <div class="bg-white margin-bottom-2 padding-10">{{ $notification->body }}</div>
        </div>
    @endforeach
</div>
@endsection
