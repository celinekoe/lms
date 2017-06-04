@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="font-size-32">Course Dashboard</div>
    </div>
    @foreach ($data['units'] as $unit)
        <a href="{{ url('unit/'.$unit->id) }}">
            <div class="bg-white flex-align-center margin-bottom-10 padding-left-20 padding-right-10 padding-top-bottom-10">
                <div class="section-progress c100 {{ 'p' . $unit->progress }} font-size-171em green">
                  <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                  </div>
                </div>
                <div class="margin-left-10">
                    <div>{{ $unit->unit_code }} {{ $unit->name }}</div>
                    <div class="small">Due Date {{ $unit->submit_by_date }}</div>
                </div>
            </div>
        </a>
    @endforeach
</div>
@endsection
