@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">{{ $data['thread']->title }}</div>
    </div>
    <div class="post">
        <div class="post-header bg-white margin-bottom-2 padding-10">
            <div class="flex margin-bottom-4">
                <div class="flex margin-left-auto">
                    <div class="post-edit glyphicon glyphicon-edit margin-left-auto margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/forum/'.$data['thread']->id.'/post/'.$data['thread']->posts->first()->id.'/edit') }}"></div>
                    <div class="thread-delete glyphicon glyphicon-remove margin-left-auto" href="{{ url('unit/'.$data['unit']->id.'/forum/'.$data['thread']->id.'/delete') }}"></div>
                </div>   
            </div>
            <div class="flex">
                <div>{{ $data['thread']->title }}</div>
                <div class="margin-left-auto">{{ $data['thread']->posts->first()->created_by_date }}</div>
            </div>
        </div>
        <div class="post-body bg-white margin-bottom-20 padding-10">{{ $data['thread']->posts->first()->body }}</div>
    </div>
    <div class="margin-bottom-20">
        <form action="{{ url('unit/'.$data['unit']->id.'/forum/'.$data['thread']->id) }}" method="POST" class="post-form">
            <div class="form-group">
                <textarea type="text" class="form-control" name="body"></textarea>
                <div class="help-block display-none"></div>   
            </div>
            <div>
                <input type="submit" class="submit btn btn-default pull-right" value="Submit"> 
                <div class="clear"></div>
            </div>
            {{ csrf_field() }}  
        </form> 
    </div>
    @if ($data['thread']->posts->count() > 1)
        @foreach ($data['thread']->posts->slice(1) as $post)
            <div class="post margin-bottom-10">
                <div class="post-header bg-white margin-bottom-2 padding-10">
                    <div class="flex margin-bottom-4">
                        <div class="flex-align-center margin-left-auto">
                            <div class="post-edit glyphicon glyphicon-edit margin-left-auto margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/forum/'.$data['thread']->id.'/post/'.$post->id.'/edit') }}"></div>
                            <div class="post-delete glyphicon glyphicon-remove margin-left-auto" href="{{ url('unit/'.$data['unit']->id.'/forum/'.$data['thread']->id.'/post/'.$post->id.'/delete') }}"></div>
                        </div>   
                    </div>
                    <div class="bg-white margin-bottom-2">
                        <span>{{ $post->user->name }}</span>
                        <span class="pull-right">{{ $post->created_by_date }}</span>
                    </div>
                </div>
                <div class="post-body bg-white margin-bottom-2 padding-10">{{ $post->body }}</div>
            </div>
        @endforeach
    @endif
</div>
@endsection

@section('script')
    <script src="{{ asset('js/thread.js') }}"></script>
    <script src="{{ asset('js/confirm.js') }}"></script>
@endsection