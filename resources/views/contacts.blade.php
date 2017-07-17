@extends('layouts.app')

@section('content')
<div class="">
    <div class="bg-white flex-align-center margin-bottom-2 padding-10">
        <div class="font-size-32">Contacts</div>
    </div>
    <div class="bg-white flex-align-center height-50 margin-bottom-2 padding-10">
        <div class="flex-align-center width-100p">
            <input type="text" placeholder="Search contacts" class="search form-control">
        </div>
    </div>
    <div class="contacts">
        @foreach ($data['contacts'] as $contact)
            <div class="contact bg-white margin-bottom-2 padding-10">
                <a href="{{ url('message/'.$contact->message_thread->id) }}">
                    <div class="contact-name">{{ $contact->name }}</div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="bg-white flex-align-center messages-footer width-100p" style="height: 50px;">
        <a class="flex-align-center-justify-center height-100p width-50p" href="{{ url('/messages') }}">Messages</a>
        <a class="bg-primary flex-align-center-justify-center height-100p text-white width-50p" href="{{ url('/contacts') }}">Contacts</a>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/contacts.js') }}"></script>
@endsection