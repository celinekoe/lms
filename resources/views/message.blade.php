@extends('layouts.app')

@section('content')
<div class="">
    <div class="message-header bg-white flex-align-center-justify-between height-50 margin-bottom-10 padding-10">
        <div class="width-14"></div>
        <div>{{ $data['message_thread']->other_user->name }}</div>
        <div class="message-edit glyphicon glyphicon-edit" href="{{ url('message/'.$data['message_thread']->id.'/edit') }}"></div>
    </div>
    <div class="messages margin-bottom-60">
        @foreach ($data['message_thread']->messages_grouped_by_date as $date => $messages)
            <div class="message-group" date="{{ $date }}">
                <div class="flex-align-center-justify-center">
                    <div class="message-group-date bg-white border-radius-10 margin-bottom-10 padding-10">{{ $date }}</div>
                </div>
                @foreach ($messages as $message)
                    <div class="message flex margin-bottom-10">
                        @if($message->sender_id == $data['user']->id)
                            <div class="bg-white border-radius-10 margin-left-auto margin-right-10 max-width-80p padding-10">
                                <div class="message-delete-container display-none">
                                    <div class="flex margin-bottom-4">
                                        <div class="message-delete glyphicon glyphicon-remove margin-left-auto" href="{{ url('message/'.$message->id.'/delete') }}"></div>
                                    </div>
                                </div>
                                <div class="message-body">{{ $message->body }}</div>
                                <div class="flex">
                                    <div class="message-formatted-time margin-left-auto small">{{ $message->formatted_time }}</div>    
                                </div>
                            </div>
                        @else
                            <div class="bg-white border-radius-10 margin-left-10 max-width-80p padding-10">
                                <div class="message-delete-container display-none">
                                    <div class="flex margin-bottom-4">
                                        <div class="message-delete glyphicon glyphicon-remove margin-left-auto" href="{{ url('message/'.$message->id.'/delete') }}"></div>
                                    </div>
                                </div>
                                <div class="message-body">{{ $message->body }}</div>
                                <div class="flex">
                                    <div class="message-formatted-time margin-left-auto small">{{ $message->formatted_time }}</div>    
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <div class="message-footer bg-white flex-align-center height-50 width-100p">
        <form action="" method="POST" class="message-form width-100p">
            <div class="flex-align-center width-100p">
                <textarea name="message_body" id="" cols="30" rows="1" class="form-control margin-left-10 width-90p"></textarea>
                {{ csrf_field() }}
                <div class="flex-align-center-justify-center margin-left-auto width-10p">
                    <div class="message-send glyphicon glyphicon-circle-arrow-right font-size-19" href="{{ url('/message/'.$data['message_thread']->id.'/send') }}"></div>    
                </div>
            </div>
        </form>
    </div>
</div>
@endsection



@section('script')
    <script src="{{ asset('js/message.js') }}"></script>
@endsection