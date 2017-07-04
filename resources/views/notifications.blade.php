@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">Notifications</div>
    </div>
    <div class="notifications-delete btn btn-default margin-bottom-10 pull-right" href="{{ url('notifications/delete') }}">Clear Notifications</div>
    <div class="clear"></div>
    <div class="notifications">
        @foreach ($data['notifications'] as $notification)
            <a href="{{ $notification->href }}">
                <div class="margin-bottom-10">
                    <div class="bg-white margin-bottom-2 padding-10">
                        <div class="flex">
                            <div class="notification-delete glyphicon glyphicon-remove margin-left-auto margin-bottom-4" href="{{ url('notification/'.$notification->id.'/delete') }}"></div>
                        </div>
                        <div class="flex">
                            <div class="margin-left-auto">{{ $notification->created_at_date }}</div>
                        </div>
                    </div>
                    <div class="bg-white padding-10">{{ $notification->body }}</div>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/notifications.js') }}"></script>
@endsection