<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css' />
    <link href="{{ asset('css/circle.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-custom navbar-static-top margin-0">
            <div>
                <div class="navbar-header width-100p">
                    <!-- Back -->
                    <?php
                        $url = Request::url(); 
                        $start = strpos($url, '/unit/') + 6;
                        $length = strpos(substr($url, $start), '/') + 1;
                        $unit_id = substr($url, $start, $length);
                        if (strpos($url, 'section') == true) 
                        {
                            $start = strpos($url, '/section/') + 9;
                            $length = strpos(substr($url, $start), '/') + 1;
                            $section_id = substr($url, $start, $length);
                            if (strpos($url, 'quiz') == true) 
                            {
                                $start = strpos($url, '/quiz/') + 6;
                                $length = strpos(substr($url, $start), '/') + 1;
                                $quiz_id = substr($url, $start, $length);                            }
                        }
                    ?>
                    @if (strpos($url, 'home') == true) <!-- Dashboard -->
                    @elseif (strpos($url, 'grades') == true) <!-- Messages page -->
                        <a class="navbar-brand" href="{{ url('home') }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @elseif (strpos($url, 'calendar') == true) <!-- Calendar page -->
                        @if (strpos($url, 'create') == true)
                            <a class="navbar-brand" href="{{ url('calendar') }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                        @else
                            <a class="navbar-brand" href="{{ url('home') }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                        @endif
                    @elseif (strpos($url, 'messages') == true) <!-- Messages page -->
                        <a class="navbar-brand" href="{{ url('home') }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @elseif (strpos($url, 'notifications') == true) <!-- Notifications page -->
                        <a class="navbar-brand" href="{{ url('home') }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @elseif (strpos($url, 'downloads') == true) <!-- Notifications page -->
                        <a class="navbar-brand" href="{{ url('home') }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @elseif (strpos($url, 'unit') == true)
                        @if (strpos($url, 'info') == true) <!-- Info page -->
                            <a class="navbar-brand" href="{{ url('unit/'.$unit_id) }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                        @elseif (strpos($url, 'announcement') == true) <!-- Announcement page -->
                            <a class="navbar-brand" href="{{ url('unit/'.$unit_id) }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                        @elseif (strpos($url, 'assignment/') == true) <!-- Unit assignment page -->
                            <a class="navbar-brand" href="{{ url('unit/'.$unit_id.'assignments') }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                        @elseif (strpos($url, 'assignment') == true) <!-- Unit assignments page -->
                            <a class="navbar-brand" href="{{ url('unit/'.$unit_id) }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                        @elseif (strpos($url, 'grade') == true) <!-- Grade page -->
                            <a class="navbar-brand" href="{{ url('unit/'.$unit_id) }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                        @elseif (strpos($url, 'forum/') == true) <!-- Thread page -->
                            <a class="navbar-brand" href="{{ url('unit/'.$unit_id.'forum') }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                        @elseif (strpos($url, 'forum') == true) <!-- Forum page -->
                            <a class="navbar-brand" href="{{ url('unit/'.$unit_id) }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                        @elseif (strpos($url, 'section') == true) 
                            @if (strpos($url, 'quiz') == true) <!-- Quiz page -->
                                @if (strpos($url, 'question') == true)
                                    <a class="navbar-brand" href="{{ url('unit/'.$unit_id.'section/'.$section_id.'quiz/'.$quiz_id) }}">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                @else
                                    <a class="navbar-brand" href="{{ url('unit/'.$unit_id.'section/'.$section_id) }}">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                @endif
                            @else <!-- Section page -->
                            <a class="navbar-brand" href="{{ url('unit/'.$unit_id) }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            @endif
                        @else <!-- Unit page -->
                            <a class="navbar-brand" href="{{ url('home') }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                        @endif
                    @endif                    <!-- Sidebar open -->
                    <span class="sidebar-open navbar-brand glyphicon glyphicon-menu-hamburger pull-right"></span>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->
        <div class="sidebar-container">
            @include('sidebar')    
        </div>
        <div class="content margin-top-bottom-20">
            @yield('content')    
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('script')
</body>
</html>
