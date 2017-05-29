@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div>Progress Bar</div>
                <div class="panel-heading">{{ $data['unit']->name }}</div>
                <div class="container unit-tabs">
                    <div class="row">
                        <div class="col-xs-3 unit-tab">
                            <a href="{{ url('unit/'.$data['unit']->id.'/info') }}">
                                <div class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></div>
                                <br>
                                <span class="unit-tab-text">
                                    Unit Info
                                </span>
                            </a>
                        </div>
                        <div class="col-xs-3 unit-tab">
                            <a href="{{ url('unit/'.$data['unit']->id.'/announcement') }}">
                                <div class="glyphicon glyphicon-bullhorn" aria-hidden="true"></div>
                                <br>
                                <span class="unit-tab-text">
                                    Announce-
                                </span>
                                <br>
                                <span class="unit-tab-text">
                                    ments
                                </span>
                            </a>
                        </div>
                        <div class="col-xs-3 unit-tab">
                            <a href="{{ url('unit/'.$data['unit']->id.'/assignment') }}">
                                <div class="glyphicon glyphicon-star" aria-hidden="true"></div>
                                <br>
                                <span class="unit-tab-text">
                                    Assign-
                                </span>
                                <br>
                                <span class="unit-tab-text">
                                    ments
                                </span>
                            </a>
                        </div>
                        <div class="col-xs-3 unit-tab">
                            <a href="{{ url('unit/'.$data['unit']->id.'/grade') }}">
                                <div class="glyphicon glyphicon-signal" aria-hidden="true"></div>
                                <br>
                                <span class="unit-tab-text">
                                    Grades
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    @foreach ($data['sections'] as $section)
                        <a href="{{ url('unit/'.$data['unit']->id.'/section/'.$section->id) }}">
                        <div class="bg-blue-grey margin-20 padding-20">
                            <div>Progress Bar</div>
                            <div>{{ $section->name }}</div>
                        </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
