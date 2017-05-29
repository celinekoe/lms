@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $data['assignment']->name }}</div>
                <div>
                    <div class="margin-10 padding-10">
                        <div class="bg-blue-grey padding-10">
                            <table>
                                <tr>
                                    <td>Submitted</td>
                                    <td>
                                        @if ($data['user_assignment']->submitted_at == NULL)
                                            No
                                        @else
                                            Yes
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Graded</td>
                                    <td>
                                        @if ($data['user_assignment']->graded_at == NULL)
                                            No
                                        @else
                                            Yes
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Submit By</td>
                                    <td>{{ $data['assignment']->submit_by }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="bg-light-grey padding-10">
                            <div>{{ $data['assignment']->name }}</div>
                            @foreach ($data['assignment']->files as $file)
                                <span>{{ $file->name }}</span>
                                <a href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$data['assignment']->id.'/file/'.$file->id) }}" target="_blank">
                                    <span class="pull-right glyphicon glyphicon-download margin-right-10"></span>     
                                </a>
                            @endforeach
                            <div>Submit</div>    
                        </div>
                        <div class="bg-blue-grey padding-10">
                            <table>
                                <tr>
                                    <td>Grade</td>
                                    <td>{{ $data['user_assignment']->grade }}</td>
                                </tr>
                                <tr>
                                    <td>Grade Comment</td>
                                    <td>{{ $data['user_assignment']->grade_comment }}</td>
                                </tr>
                                <tr>
                                    <td>Graded By</td>
                                    <td>{{ $data['user_assignment']->staff_id }}</td>
                                </tr>
                                <tr>
                                    <td>Graded At</td>
                                    <td>{{ $data['user_assignment']->graded_at }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
