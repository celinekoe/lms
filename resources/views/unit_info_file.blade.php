<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'lms') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="bg-light-grey height-100p margin-0">
	<nav class="navbar navbar-custom navbar-fixed-top margin-0">
        <div>
            <div class="navbar-header flex width-100p">
                <!-- Back -->
                <a class="back navbar-brand" href="{{ url('unit/'.$data['unit']->id.'/unit_info') }}">
	                <span class="glyphicon glyphicon-chevron-left"></span>
	            </a>
                <div class="margin-left-auto">
                    <span class="reset navbar-brand glyphicon glyphicon-refresh" href="/reset"></span> <!-- Reset test user -->
                    <span class="sidebar-open navbar-brand glyphicon glyphicon-menu-hamburger"></span> <!-- Sidebar open -->
                </div>
            </div>
        </div>
    </nav>
	@if ($data['file']->type == 'video')
		<div class="container">
		<div class="video-container">
		    <iframe width="560" height="315" src="{{ $data['file']->url }}" frameborder="0" allowfullscreen></iframe>
		</div>
	@else
		<iframe src="{{ $data['file']->url }}" frameborder="0" class="height-100p width-100p"></iframe>
	@endif
	<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>