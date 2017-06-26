<div class="sidebar height-100p">
    @if (Auth::guest())
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
    @else
        <div class="sidebar-close padding-10">
            <div class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></div>
        </div>
        <a href="{{ url('grades') }}">
            <div class="sidebar-nav padding-10">{{ Auth::user()->name }}</div>
        </a>
        <a href="{{ url('home') }}">
            <div class="padding-10">Dashboard</div>
        </a>
        <a href="{{ url('calendar') }}">
            <div class="padding-10">Calendar</div>
        </a>
        <a href="{{ url('messages') }}">
            <div class="padding-10">Messages</div>
        </a>
        <a href="{{ url('notifications') }}">
            <div class="padding-10">Notifications</div>
        </a>
        <a href="{{ url('downloads') }}">
            <div class="padding-10">Downloads</div>
        </a>
        <a href="{{ route('logout') }}" 
            onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            <div class="padding-10">Logout</div>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    @endif
</div>
<div class="sidebar-overlay height-100p width-100p">
</div>