@extends('layouts.app')

@section('content')
<div class="margin-left-right-10">
    <div class="bg-white margin-bottom-20 padding-10">
        <div class="font-size-32">{{ $data['unit']->unit_code }} Unit Info</div>
    </div>
    <div class="bg-white padding-10">{{ $data['unit']->info }}</div>
</div>
@endsection
