@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} {{ $data['quiz']->name }}</div>
    </div>
    <div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div>Graded</div>
            @if ($data['quiz']->graded)
                <div class="small">Yes</div>
            @else
                <div class="small">No</div>
            @endif
        </div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div>Grading Method</div>
            <div class="small">{{ $data['quiz']->grading_method }}</div>
        </div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div>Current Attempt No.</div>
            <div class="small">{{ $data['quiz']->user_quizzes->last()->attempt_no }}</div>
        </div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div>Total Attempts</div>
            <div class="small">{{ $data['quiz']->total_attempts}}</div>
        </div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div>Time Limit</div>
            <div class="small">{{ $data['quiz']->time_limit }} minutes</div>
        </div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div>Total Questions</div>
            <div class="small">{{ $data['quiz']->total_questions }}</div>
        </div>
        <div class="bg-white margin-bottom-2 padding-10">
            <div>Time Remaining</div>
            <div class="small">{{ $data['quiz']->time_remaining }}</div>
        </div>
        <div class="bg-white margin-bottom-10 padding-10">
            <div>Due Date</div>
            <div class="small">{{ $data['quiz']->submit_by_date }}</div>
        </div>
        <div class="margin-bottom-10">
        <div class="bg-white margin-bottom-2 padding-10">Previous Attempts</div>
            <div>
                @foreach ($data['quiz']->user_quizzes as $user_quiz)
                    @if ($user_quiz->submitted_at != null)
                        <a href="">
                            <div class="bg-white margin-bottom-2 padding-10">
                                <div class="flex">
                                    <div class="small">Attempt No. {{ $user_quiz->attempt_no }}</div>    
                                    <div class="small margin-left-auto">{{ $user_quiz->submitted_at }}</div>
                                </div>
                                <div class="small">Grade {{ $user_quiz->grade }}</div>
                            </div>
                        </a>
                    @endif
                @endforeach    
            </div>
        </div>
        <div class="flex margin-bottom-10">
            @if ($data['quiz']->user_quizzes->count() == 0)
                <form action="{{ url('unit/'.$data['unit']->id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->id.'/start') }}" method="POST" class="start-form margin-left-auto" href="{{ url('unit/'.$data['unit']->id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->id.'/question/1') }}">
                    {{ csrf_field() }}
                    <input type="submit" class="start btn btn-default" value="Start">
                </form>
            @else 
                <form action="{{ url('unit/'.$data['unit']->id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->id.'/start') }}" method="POST" class="retry-form margin-left-auto" href="{{ url('unit/'.$data['unit']->id.'/section/'.$data['quiz']->section_id.'/subsection/'.$data['quiz']->subsection_id.'/quiz/'.$data['quiz']->id.'/question/1') }}">
                    {{ csrf_field() }}
                    <input type="submit" class="retry btn btn-default" value="Retry">
                </form>
            @endif
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/quiz_start.js') }}"></script>
    <script src="{{ asset('js/confirm.js') }}"></script>
@endsection
