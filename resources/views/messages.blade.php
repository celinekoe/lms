@extends('layouts.app')

@section('content')
<div class="">
    <div class="bg-white flex-align-center margin-bottom-2 padding-10">
        <div class="font-size-32">Messages</div>
    </div>
    <div class="message-threads">
        @foreach ($data['message_threads'] as $message_thread)
            <div class="message-thread bg-white margin-bottom-2 padding-10">
                <a href="{{ url('message/'.$message_thread->id) }}">
                    <div class="flex-align-center">
                        <div class="small">{{ $message_thread->other_user->name }}</div>
                        <div class="margin-left-auto small">{{ $message_thread->updated_at_date }}</div>
                    </div>
                    <div class="small">{{ $message_thread->preview }}</div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="bg-white flex-align-center messages-footer width-100p" style="height: 50px;">
        <div class="bg-primary flex-align-center-justify-center height-100p width-50p" href="">Messages</div>
        <a class="flex-align-center-justify-center height-100p width-50p" href="{{ url('/contacts') }}">Contacts</a>
    </div>
</div>
@endsection
