@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading bg-blue-grey">{{ $data['quiz']->name }}</div>
                <div>
                    @foreach ($data['options'] as $option)
                    <div class="bg-light-grey padding-10">
                        option
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
