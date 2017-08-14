<div class="sidebar height-100p">
    @if (Auth::guest())
        <a href="{{ route('login') }}">
            <div class="flex-align-center padding-10">Login</div>
        </a>
    @else
        <div class="sidebar-close padding-10">
            <div class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></div>
        </div>
        <a href="#">
            <div class="flex-align-center padding-10">
                <div class="glyphicon glyphicon-user margin-bottom-4" aria-hidden="true"></div>
                <div class="margin-left-10">{{ Auth::user()->name }}</div>  
            </div>
        </a>
        <a href="{{ url('home') }}">
            <div class="flex-align-center padding-10">
                <div class="glyphicon glyphicon-home margin-bottom-4" aria-hidden="true"></div>
                <div class="margin-left-10">Dashboard</div>  
            </div>
        </a>
        <a href="{{ url('grades') }}">
            <div class="flex-align-center padding-10">
                <div class="glyphicon glyphicon-stats margin-bottom-4" aria-hidden="true"></div>
                <div class="margin-left-10">Course Grades</div>  
            </div>
        </a>
        <a href="{{ url('notifications') }}">
            <div class="flex-align-center padding-10">
                <div class="glyphicon glyphicon-bell margin-bottom-4" aria-hidden="true"></div>
                <div class="margin-left-10">Notifications</div>  
            </div>
        </a>
        <a href="{{ url('messages') }}">
            <div class="flex-align-center padding-10">
                <div class="glyphicon glyphicon-comment margin-bottom-4" aria-hidden="true"></div>
                <div class="margin-left-10">Messages</div>  
            </div>
        </a>
        <a href="{{ url('calendar') }}">
            <div class="flex-align-center padding-10">
                <div class="glyphicon glyphicon-calendar margin-bottom-4" aria-hidden="true"></div>
                <div class="margin-left-10">Calendar</div>  
            </div>
        </a>
        <a href="{{ url('downloads') }}">
            <div class="flex-align-center padding-10">
                <div class="glyphicon glyphicon-download margin-bottom-4" aria-hidden="true"></div>
                <div class="margin-left-10">Downloads</div>  
            </div>
        </a>
        <a href="{{ route('logout') }}" 
            onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            <div class="flex-align-center padding-10">
                <div class="glyphicon glyphicon-log-out margin-bottom-4" aria-hidden="true"></div>
                <div class="margin-left-10">Log Out</div>  
            </div>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    @endif
</div>
<div class="sidebar-overlay height-100p width-100p">
</div>