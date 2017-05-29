@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Unit Announcements</div>
                <div>
                    @foreach ($data['announcements'] as $announcement)
                        <div class="margin-20 padding-20">
                            <div class="bg-blue-grey padding-top-10 padding-left-right-10">{{ $announcement->title }}</div>
                            <div class="bg-blue-grey padding_top-10 padding-left-right-10">{{ $announcement->user->name }}</div>
                            <div class="bg-blue-grey padding-bottom-10 padding-left-right-10">{{ $announcement->created_at }}</div>
                            <div>{{ $announcement->body }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
