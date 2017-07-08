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
    <div id="app height-100p">
        <nav class="navbar navbar-custom navbar-static-top margin-0">
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
                        <span class="reset navbar-brand glyphicon glyphicon-refresh" href="/reset"></span> <!-- Reset test user -->
                        <span class="sidebar-open navbar-brand glyphicon glyphicon-menu-hamburger"></span> <!-- Sidebar open -->
                    </div>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->
        <div class="sidebar-container">
            @include('sidebar')    
        </div>
        <!-- Confirmation -->
        <div class="confirm-container display-none">
            <div class="confirm-overlay flex-align-center-justify-center">
                <div class="confirm confirm-reset display-none bg-white padding-10">
                    <div class="confirm-text flex-justify-center padding-10"></div>
                    <div class="confirm-options flex-align-center-justify-between">
                        <div class="btn btn-default confirm-option-cancel width-49p padding-10">Cancel</div>
                        <div class="btn btn-primary confirm-option-reset width-49p padding-10">Reset</div>    
                    </div>
                </div>
                <div class="confirm confirm-start display-none bg-white padding-10">
                    <div class="confirm-text flex-justify-center padding-10"></div>
                    <div class="confirm-options flex-align-center-justify-between">
                        <div class="btn btn-default confirm-option-cancel width-49p padding-10">Cancel</div>
                        <div class="btn btn-primary confirm-option-start width-49p padding-10">Start</div>    
                    </div>
                </div>
                <div class="confirm confirm-retry bg-white display-none padding-10">
                    <div class="confirm-text flex-justify-center padding-10"></div>
                    <div class="confirm-options flex-align-center-justify-between">
                        <div class="btn btn-default confirm-option-cancel width-49p padding-10">Cancel</div>
                        <div class="btn btn-primary confirm-option-retry width-49p padding-10">Retry</div>    
                    </div>
                </div>
                <div class="confirm confirm-download display-none bg-white padding-10">
                    <div class="confirm-text flex-justify-center padding-10"></div>
                    <div class="confirm-options flex-align-center-justify-between">
                        <div class="btn btn-default confirm-option-cancel width-49p padding-10">Cancel</div>
                        <div class="btn btn-primary confirm-option-download width-49p padding-10">Download</div>    
                    </div>
                </div>
                <div class="confirm confirm-delete bg-white display-none padding-10">
                    <div class="confirm-text flex-justify-center padding-10"></div>
                    <div class="confirm-options flex-align-center-justify-between">
                        <div class="btn btn-default confirm-option-cancel width-49p padding-10">Cancel</div>
                        <div class="btn btn-primary confirm-option-delete width-49p padding-10">Delete</div>    
                    </div>
                </div>
                <div class="confirm confirm-submit display-none bg-white padding-10">
                    <div class="confirm-text flex-justify-center padding-10"></div>
                    <div class="confirm-options flex-align-center-justify-between">
                        <div class="btn btn-default confirm-option-cancel width-49p padding-10">Cancel</div>
                        <div class="btn btn-primary confirm-option-submit width-49p padding-10">Submit</div>    
                    </div>
                </div>
                <div class="confirm confirm-cancel-submit bg-white display-none padding-10">
                    <div class="confirm-text flex-justify-center padding-10"></div>
                    <div class="confirm-options flex-align-center-justify-between">
                        <div class="btn btn-default confirm-option-cancel width-49p padding-10">Cancel</div>
                        <div class="btn btn-primary confirm-option-cancel-submit width-49p padding-10">Cancel Submit</div>    
                    </div>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div class="content">
            @yield('content')    
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/confirm.js') }}"></script>
    @yield('script')
</body>
</html>
