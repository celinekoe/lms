@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $data['quiz']->name }}</div>
                <div>
                    <div class="margin-10 padding-10">
                        <div class="bg-blue-grey">
                            <table class="width-100p">
                                <tr class="row">
                                    <td class="col-xs-6 padding-top-10 padding-left-right-10">Current Question</td>
                                    <td class="col-xs-6 padding-top-10 padding-left-right-10">{{ $data['user_quiz']->question_no }}</td>
                                </tr>
                                <tr class="row">
                                    <td class="col-xs-6 padding-top-10 padding-left-right-10">Total No. Of Questions</td>
                                    <td class="col-xs-6 padding-top-10 padding-left-right-10">{{ $data['quiz']->total_question }}</td>
                                </tr>
                                <tr class="row">
                                    <td class="col-xs-6 padding-top-10 padding-left-right-10">Submit By</td>
                                    <td class="col-xs-6 padding-top-10 padding-left-right-10">{{ $data['quiz']->submit_by }}</td>
                                </tr>
                                <tr class="row">
                                    <td class="col-xs-6 padding-10">Submitted At</td>
                                    <td class="col-xs-6 padding-10">{{ $data['user_quiz']->submitted_at }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="bg-white-grey">
                            <table class="width-100p">
                                <tr class="row">
                                    <td class="col-xs-6 padding-10 padding-left-right-10">Last Grade</td>
                                    <td class="col-xs-6 padding-10">{{ $data['user_quiz']->grade }}</td>
                                </tr>
                            </table>
                        </div>
                        <a href="{{ url('unit/'.$data['section']->unit_id.'/section/'.$data['section']->id.'/quiz/'.$data['quiz']->id.'/question/1') }}">
                            <div class="bg-blue-grey padding-10">
                                Start
                            </div>    
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
