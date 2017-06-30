@extends('layouts.app')

@section('content')
<div class="assignment margin-10">
    <div class="assignment-header bg-white margin-bottom-10 padding-10">
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

    @if ($data['assignment']->user_file == null)
        <div class="bg-white margin-top-10 margin-bottom-10 padding-10">
            <div>Submit Assignment</div>
            <input type="file" class="file-input small">
        </div>
    @else
        <div class="flex-align-center bg-white margin-top-10 margin-bottom-10 padding-10">
            <div>
                <div>{{ $data['assignment']->user_file->name }}</div>
                <div class="small">{{ $data['assignment']->user_file->created_at }}</div>     
            </div>
            <div class="flex-align-center margin-left-auto">
                @if (!$data['assignment']->user_file->downloaded)
                    <div class="file-download glyphicon glyphicon-download margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$data['assignment']->id.'/file/'.$data['assignment']->user_file->id.'/download') }}"></div>
                    <div class="file-delete glyphicon glyphicon-remove-circle margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$data['assignment']->id.'/file/'.$data['assignment']->user_file->id.'/delete') }}" style="display: none;"></div>
                @else
                    <div class="file-download glyphicon glyphicon-download margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$data['assignment']->id.'/file/'.$data['assignment']->user_file->id.'/download') }}" style="display: none;"></div>
                    <div class="file-delete glyphicon glyphicon-remove-circle margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$data['assignment']->id.'/file/'.$data['assignment']->user_file->id.'/delete') }}"></div>
                @endif
                @if ($data['assignment']->user_assignment->graded_at == null)
                    <div class="cancel-submit glyphicon glyphicon-remove margin-right-10" href="{{ url('unit/'.$data['unit']->id.'/assignment/'.$data['assignment']->id.'/file/'.$data['assignment']->user_file->id.'/cancel-submit') }}"></div>
                @endif
            </div>      
        </div>
    @endif


    @if ($data['assignment']->user_file == null)
        <form action="{{ url('/unit/'.$data['unit']->id.'/assignment/'.$data['assignment']->id) }}" method="POST" class="submit-form display-none">
            <input type="hidden" name="file_name" class="file-name">
            <input type="hidden" name="file_extension" class="file-extension">
            <input type="hidden" name="file_type" class="file-type">
            <input type="hidden" name="file_size" class="file-size">
            <div class="flex">
                <input type="submit" class="submit btn btn-primary margin-left-auto">
            </div>
            {{ csrf_field() }}
        </form>
    @endif

    @if ($data['assignment']->user_assignment->graded_at != null)
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
    <script src="{{ asset('js/confirm.js') }}"></script>
@endsection
