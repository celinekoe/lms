@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-20 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} Forum</div>
    </div>
    <div class="margin-bottom-20">
        <a href="{{ url('unit/'.$data['unit']->id.'/forum/create') }}" class="btn btn-default pull-right">Create Thread</a> 
        <div class="clear"></div>   
    </div>
    @foreach ($data['forum']->threads as $thread)
        <a href="{{ url('unit/'.$data['unit']->id.'/forum/'.$thread->id) }}">
            <div class="margin-bottom-10">
                <div class="bg-white margin-bottom-2 padding-10">
                    <div class="flex margin-bottom-4">
                        <div class="margin-left-auto">Delete</div>
                    </div>
                    <div>{{ $thread->title }}</div>
                </div>
                <div class="bg-white padding-10">
                    <div class="flex-align-center small">
                        <div>Created by {{ $thread->user->name }}</div>
                        <div class="margin-left-auto">{{ $thread->created_by_date }}</div>
                    </div>
                    <div class="flex-align-center small">
                        <div>Replies {{ $thread->posts->count() }}</div>
                    </div>
                    <div class="flex-align-center small">
                        <div></div>
                        <div>Last posted by {{ $thread->user->name }}</div>
                        <div class="margin-left-auto">{{ $thread->created_by_date }}</div>
                    </div>    
                </div>
            </div>
        </a>
    @endforeach
</div>
@endsection