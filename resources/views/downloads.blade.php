@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-20 padding-10">
        <div class="font-size-32">Downloads</div>
    </div>
    @foreach ($data['units'] as $unit)
        <div class="bg-white flex-align-center margin-bottom-2 padding-10">
            <div class="font-size-19 margin-left-10">{{ $unit->name }}</div>
            <span class="margin-left-auto margin-right-10">
                <span class="download glyphicon glyphicon-download margin-top-4" href=""></span>
            </span>
        </div>
        @foreach ($unit->sections as $section)
            <div class="bg-white flex-align-center margin-bottom-2 padding-10">
                <div class="margin-left-10">{{ $section->name }}</div>
                <span class="margin-left-auto margin-right-10">
                    <span class="download glyphicon glyphicon-download margin-top-4" href=""></span>
                </span>
            </div>
            @foreach ($section->subsections as $subsection)
            <div class="bg-white flex-align-center margin-bottom-2 padding-left-20 padding-right-10 padding-top-bottom-10">
                <div class="margin-left-10">{{ $subsection->name }}</div>
                <span class="margin-left-auto margin-right-10">
                    <span class="download glyphicon glyphicon-download margin-top-4" href=""></span>
                </span>
            </div>
        @endforeach
        @endforeach
        <div class="margin-bottom-10"></div>
    @endforeach
</div>
@endsection
