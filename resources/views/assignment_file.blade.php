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
                        if (strpos($url, 'subsection') == true) 
                        {
                            $start = strpos($url, '/subsection/') + 12;
                            $length = strpos(substr($url, $start), '/') + 1;
                            $subsection_id = substr($url, $start, $length);
                            if (strpos($url, 'quiz') == true) 
                            {
                                $start = strpos($url, '/quiz/') + 6;
                                $length = strpos(substr($url, $start), '/') + 1;
                                $quiz_id = substr($url, $start, $length);                         
                            }              
                        }
                    }
                ?>
                @if (strpos($url, 'home') == true) <!-- Dashboard -->
                @elseif (strpos($url, 'grades') == true) <!-- Messages page -->
                    <a class="back navbar-brand" href="{{ url('home') }}">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                @elseif (strpos($url, 'calendar') == true) <!-- Calendar page -->
                    @if (strpos($url, 'create') == true)
                        <a class="back navbar-brand" href="{{ url('calendar') }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @elseif (strpos($url, 'edit') == true)
                        <a class="back navbar-brand" href="{{ url('calendar') }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @else
                        <a class="back navbar-brand" href="{{ url('home') }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @endif
                @elseif (strpos($url, 'message') == true) 
                    @if (strpos($url, 'messages') == true) <!-- Messages page -->
                        <a class="back navbar-brand" href="{{ url('home') }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @else (strpos($url, 'message') == true) <!-- Messages page -->
                        <a class="back navbar-brand" href="{{ url('messages') }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @endif
                @elseif (strpos($url, 'contacts') == true) <!-- Contacts page -->
                    <a class="back navbar-brand" href="{{ url('messages') }}">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                @elseif (strpos($url, 'notifications') == true) <!-- Notifications page -->
                    <a class="back navbar-brand" href="{{ url('home') }}">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                @elseif (strpos($url, 'downloads') == true) <!-- Notifications page -->
                    <a class="back navbar-brand" href="{{ url('home') }}">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                @elseif (strpos($url, 'unit') == true)
                    @if (strpos($url, 'info') == true) <!-- Info page -->
                        <a class="back navbar-brand" href="{{ url('unit/'.$unit_id) }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @elseif (strpos($url, 'announcement') == true) <!-- Announcement page -->
                        <a class="back navbar-brand" href="{{ url('unit/'.$unit_id) }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @elseif (strpos($url, 'assignment/') == true) <!-- Unit assignment page -->
                        <a class="back navbar-brand" href="{{ url('unit/'.$unit_id.'assignments') }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @elseif (strpos($url, 'assignment') == true) <!-- Unit assignments page -->
                        <a class="back navbar-brand" href="{{ url('unit/'.$unit_id) }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @elseif (strpos($url, 'grade') == true) <!-- Grade page -->
                        <a class="back navbar-brand" href="{{ url('unit/'.$unit_id) }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @elseif (strpos($url, 'forum/') == true) <!-- Thread page -->
                        <a class="back navbar-brand" href="{{ url('unit/'.$unit_id.'forum') }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @elseif (strpos($url, 'forum') == true) <!-- Forum page -->
                        <a class="back navbar-brand" href="{{ url('unit/'.$unit_id) }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @elseif (strpos($url, 'section') == true) 
                        @if (strpos($url, 'quiz') == true) <!-- Quiz page -->
                            @if (strpos($url, 'question') == true)
                                <a class="back navbar-brand" href="{{ url('unit/'.$unit_id.'section/'.$section_id.'subsection/'.$subsection_id.'quiz/'.$quiz_id) }}">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                            @elseif (strpos($url, 'review') == true)
                                <a class="back navbar-brand" href="{{ url('unit/'.$unit_id.'section/'.$section_id.'subsection/'.$subsection_id.'quiz/'.$quiz_id) }}">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                            @elseif (strpos($url, 'summary') == true)
                                <a class="back navbar-brand" href="{{ url('unit/'.$unit_id.'section/'.$section_id.'subsection/'.$subsection_id.'quiz/'.$quiz_id) }}">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                            @else
                                <a class="back navbar-brand" href="{{ url('unit/'.$unit_id.'section/'.$section_id) }}">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                            @endif
                        @elseif (strpos($url, 'file') == true) <!-- File page -->
                            <a class="back navbar-brand" href="{{ url('unit/'.$unit_id.'section/'.$section_id) }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                        @else <!-- Section page -->
                        <a class="back navbar-brand" href="{{ url('unit/'.$unit_id) }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        @endif
                    @else <!-- Unit page -->
                        <a class="back navbar-brand" href="{{ url('home') }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                    @endif
                @endif                    
                <div class="margin-left-auto">
                    <!-- <span class="reset navbar-brand glyphicon glyphicon-refresh" href="/reset"></span> --> <!-- Reset test user -->
                    <span class="sidebar-open navbar-brand glyphicon glyphicon-menu-hamburger"></span> <!-- Sidebar open -->
                </div>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->
    <div class="sidebar-container">
        @include('sidebar')    
    </div>
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