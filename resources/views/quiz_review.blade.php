@extends('layouts.app')

@section('content')
<div class="border-blue-grey margin-10">
    <div class="bg-dark-grey height-100">
        <table>
    		<tr class="row">
        		<td class="col-xs-6">Quiz Name</td>
        		<td class="col-xs-6">{{ $data['quiz']->name }}</td>
        	</tr>
        	<tr class="row">
        		<td class="col-xs-6">Quiz Grade</td>
        		<td class="col-xs-6">{{ $data['user_quiz']->grade }}
        	</tr>	
        </table>
    </div>
    <div>
        @foreach ($data['questions'] as $question)
        	<div class="bg-blue-grey padding-10">
                {{ $question->question }}
            </div>
            @foreach ($question->options as $option)
                @if ($option->selected)
                    <div class="bg-white padding-10">{{ $option->option }}</div>    
                @else
                    <div class="bg-white-grey padding-10">{{ $option->option }}</div>
                @endif
            @endforeach
        @endforeach
    </div>
</div>
@endsection

@section('script')
@endsection