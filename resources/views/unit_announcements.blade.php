@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white flex-align-center margin-bottom-10 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} Announcements</div>
    </div>
    @foreach ($data['announcements'] as $announcement)
        <div class="margin-bottom-10">
            <a href="{{ url('unit/'.$data['unit']->id.'/announcement/'.$announcement->id) }}">
                <div class="bg-white margin-bottom-2 padding-10">
                    <div class="font-size-19">{{ $announcement->title }}</div>
                    <div class="bg-white margin-bottom-2">
                        <span>{{ $announcement->user->name }}</span>
                        <span class="pull-right">{{ $announcement->created_by_date }}</span>
                    </div>
                </div>
                <div class="bg-white margin-bottom-2 padding-10">{{ $announcement->body }}</div>
            </a>
        </div>
    @endforeach
</div>
@endsection
