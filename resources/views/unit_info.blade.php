@extends('layouts.app')

@section('content')
<div class="margin-10">
    <div class="bg-white margin-bottom-10 padding-10">
        <div class="flex-align-center">
            <div class="font-size-32">{{ $data['unit']->unit_code }} Unit Info</div>
            <div class="margin-left-auto margin-right-10">
                @if (!$data['unit']->unit_info_is_downloaded)
                    <div class="unit-info-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/unit_info/download') }}"></div>
                    <div class="unit-info-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/unit_info/delete') }}" style="display: none;"></div>
                @else
                    <div class="unit-info-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/unit_info/file/download') }}" style="display: none;"></div>
                    <div class="unit-info-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/unit_info/file/delete') }}"></div>
                @endif
            </div>
        </div>
    </div>
    <div class="unit-info bg-white margin-bottom-10 padding-10">{{ $data['unit']->info }}</div>
    <div class="unit-info-files">
        @foreach ($data['unit']->unit_info_files as $unit_info_file)
            <div class="unit_info_file bg-white margin-top-bottom-2 padding-10 text-dark-grey">
                <a href="{{ url('unit/'.$data['unit']->id.'/unit_info/file/'.$unit_info_file->id) }}">
                    <div>
                        @if ($unit_info_file->type == 'video')
                            <span class="glyphicon glyphicon-facetime-video margin-left-10"></span>
                        @elseif ($unit_info_file->type == 'document')
                            <span class="glyphicon glyphicon-book margin-left-10"></span>
                        @endif
                        <span class="margin-left-10">{{ $unit_info_file->name }}</span>
                        <span class="pull-right margin-right-10">
                            @if (!$unit_info_file->is_downloaded)
                                <span class="file-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/unit_info/file/'.$unit_info_file->id.'/download') }}"></span>
                                <span class="file-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/unit_info/file/'.$unit_info_file->id.'/delete') }}" style="display: none;"></span>
                            @else
                                <span class="file-download glyphicon glyphicon-download margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/unit_info/file/'.$unit_info_file->id.'/download') }}" style="display: none;"></span>
                                <span class="file-delete glyphicon glyphicon-remove-circle margin-top-4" href="{{ url('unit/'.$data['unit']->id.'/unit_info/file/'.$unit_info_file->id.'/delete') }}"></span>
                            @endif
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/unit_info.js') }}"></script>
    <script src="{{ asset('js/confirm.js') }}"></script>
@endsection
