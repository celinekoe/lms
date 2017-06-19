@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-20 padding-10">
        <h1>{{ $data['unit']->unit_code }} {{ $data['assignment']->name }}</h1>
    </div>
    <div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div>Submission Status</div>
            @if ($data['assignment']->user_assignment->submitted_at == null)
                <span class="label label-danger">Not Submitted</span>
            @else
                <span class="label label-success">Submitted</span>
            @endif
            @if ($data['assignment']->user_assignment->graded_at == null)
                <span class="label label-danger">Not Graded</span>
            @else
                <span class="label label-success">Graded</span>
            @endif
        </div>
        <div class="bg-white margin-top-bottom-2 padding-10">
            <div>Submission Comments</div>
            <div class="small">Comments (0)</div>
        </div>
        <div class="bg-white margin-top-bottom-2 padding-10">
            <div>Time Remaining</div>
            <div class="small">{{ $data['assignment']->time_remaining }}</div>
        </div>
        <div class="bg-white margin-top-bottom-2 padding-10">
            <div>Due Date</div>
            <div class="small">{{ $data['assignment']->submit_by_date }}</div>
        </div>
    </div>

    <div>
        <div class="bg-white margin-top-10 margin-bottom-2 padding-10">
            <form action="">
                <div>Add Submission</div>
                <input type="file" class="user_file small">
                {{ csrf_field() }}   
            </form>
        </div>
        @if ($data['assignment']->user_file != null)
            <div class="bg-white margin-top-bottom-2 padding-10">
                <div>{{ $data['assignment']->user_file->name }}</div><span class="glyphicon glyphicon-download margin-top-2 margin-right-10"></span><span class="glyphicon glyphicon-remove margin-top-2 margin-right-10"></span>
                <div class="small">{{ $data['assignment']->user_file->created_at }}</div> 
            </div>
        @endif
    </div>

    @if ($data['assignment']->user_assignment->grade == null)
        <div class="margin-top-20">
            <form action="{{ url('unit/'.$data['unit']->id.'/assignment/'.$data['assignment']->id ) }}" method="POST">
                <input type="hidden" name="file_name" value="" class="file_name">
                <input type="hidden" name="file_type" value="" class="file_type">
                <input type="hidden" name="file_extension" value="" class="file_extension">
                <input type="submit" class="btn btn-default pull-right" value="Submit">
                {{ csrf_field() }}   
            </form>
        </div>
    @else
        <div>
            <div class="bg-white margin-top-10 margin-bottom-2 padding-10">
                <div>Grade</div>
                <div class="small">{{ $data['assignment']->user_assignment->grade }}</div> 
            </div>
            <div class="bg-white margin-top-bottom-2 padding-10">
                <div>Feedback Comments</div>
                <div class="small">{{ $data['assignment']->user_assignment->grade_comment }}</div>
            </div>
            <div class="bg-white margin-top-2 margin-bottom-10 padding-10">
                <div>Graded By</div>
                <div class="small">{{ $data['assignment']->user_assignment->staff->name }}</div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('script')
    <script src="{{ asset('js/assignment.js') }}"></script>
@endsection
