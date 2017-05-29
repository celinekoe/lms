@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div>
                    @foreach ($units as $unit)
                        <a href="{{ url('unit/'.$unit->id) }}">
                        <div class="bg-blue-grey margin-20 padding-20">
                            <div>Progress Bar</div>
                            <div>{{ $unit->name }}</div>
                        </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
