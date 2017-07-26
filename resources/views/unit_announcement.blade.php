@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white flex-align-center margin-bottom-10 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} Announcement</div>
    </div>
    <div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div class="font-size-19">{{ $data['announcement']->title }}</div>
            <div class="bg-white margin-bottom-2">
                <span>{{ $data['announcement']->user->name }}</span>
                <span class="pull-right">{{ $data['announcement']->created_by_date }}</span>
            </div>
        </div>
        <div class="bg-white margin-bottom-2 padding-10">{{ $data['announcement']->body }}</div>
    </div>
</div>
@endsection