@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $data['unit']->name }}</div>
                <div>
                    @foreach ($data['assignments'] as $assignment)
                        <div class="bg-blue-grey margin-20 padding-20">
                            <span>{{ $assignment->name }}</span>
                            <span class="pull-right">{{ $assignment->grade }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection