@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $data['unit']->name }}</div>
                <div>
                    @foreach ($data['assignments'] as $assignment)
                        <a href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$assignment->id) }}">
                        <div class="bg-blue-grey margin-20 padding-20">
                            <div>{{ $assignment->name }}</div>
                        </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
