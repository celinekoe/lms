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
    @foreach ($data['threads'] as $thread)
        <a href="{{ url('unit/'.$data['unit']->id.'/forum/'.$thread->id) }}">
            <div class="bg-white margin-bottom-2 padding-10">
                <div>{{ $thread->title }}</div>
                <div class="bg-white margin-bottom-2">
                    <span>{{ $thread->user->name }}</span>
                    <span class="pull-right">{{ $thread->created_by_date }}</span>
                </div>
            </div>
        </a>
    @endforeach
</div>
@endsection