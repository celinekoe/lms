@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div>Progress Bar</div>
                <div class="panel-heading">{{ $data['section']['name'] }}</div>
                <div>
                    @foreach ($data['subsections'] as $subsection)
                        <div class="bg-blue-grey margin-20 padding-10">
                            <span>{{ $subsection->name }}</span>
                            <span>Progress Bar</span>
                        </div>
                        @foreach ($subsection->files as $file)
                            <div class="bg-light-grey margin-20 padding-10">
                                <span class="margin-left-10">{{ $file->name }}</span>
                                <span class="pull-right glyphicon glyphicon-download margin-right-10"></span>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
