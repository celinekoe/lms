@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="margin-bottom-10">
        <a href="{{ url('unit/'.$data['unit']->id.'/forum/'.$data['thread']->id.'/create') }}" class="btn btn-default pull-right">Create Post</a> 
        <div class="clear"></div>   
    </div>
    <div class="bg-white margin-bottom-2 padding-10">
        <div class="font-size-32">{{ $data['thread']->title }}</div>
        <div class="bg-white">
            <span>{{ $data['first_post']->user->name }}</span>
            <span class="pull-right">{{ $data['first_post']->created_by_date }}</span>
        </div>
    </div>
    <div class="bg-white margin-bottom-20 padding-10">{{ $data['first_post']->body }}</div>  
    @foreach ($data['posts'] as $post)
        <div class="margin-bottom-10">
            <div class="bg-white margin-bottom-2 padding-10">
                <div class="bg-white margin-bottom-2">
                    <span>{{ $post->user->name }}</span>
                    <span class="pull-right">{{ $post->created_by_date }}</span>
                </div>
            </div>
            <div class="bg-white margin-bottom-2 padding-10">{{ $post->body }}</div>
        </div>
    @endforeach
</div>
@endsection