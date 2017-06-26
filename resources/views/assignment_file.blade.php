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
	<nav class="navbar navbar-default navbar-static-top margin-bottom-0">
	    <div class="container">
	        <div class="navbar-header">
	            <!-- Collapsed Hamburger -->
	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
	                <span class="sr-only">Toggle Navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <!-- Back -->
	            <a class="navbar-brand" href="{{ url('unit/'.$data['unit']->id.'/assignments') }}">
	                <span class="glyphicon glyphicon-chevron-left"></span>
	            </a>
	        </div>
	        <div class="collapse navbar-collapse" id="app-navbar-collapse">
	            <!-- Left Side Of Navbar -->
	            <ul class="nav navbar-nav">
	                &nbsp;
	            </ul>

	            <!-- Right Side Of Navbar -->
	            <ul class="nav navbar-nav navbar-right">
	                <!-- Authentication Links -->
	                @if (Auth::guest())
	                    <li><a href="{{ route('login') }}">Login</a></li>
	                    <li><a href="{{ route('register') }}">Register</a></li>
	                @else
	                    <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
	                            {{ Auth::user()->name }} <span class="caret"></span>
	                        </a>

	                        <ul class="dropdown-menu" role="menu">
	                            <li>
	                                <a href="{{ route('logout') }}"
	                                    onclick="event.preventDefault();
	                                             document.getElementById('logout-form').submit();">
	                                    Logout
	                                </a>

	                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                                    {{ csrf_field() }}
	                                </form>
	                            </li>
	                        </ul>
	                    </li>
	                @endif
	            </ul>
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
	<!-- <iframe src="{{ url('storage/'.$data['file']->name.$data['file']->extension) }}" frameborder="0" class="height-100p width-100p"></iframe> -->
	<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>