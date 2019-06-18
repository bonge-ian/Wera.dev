<div class="uk-box-shadow-medium uk-navbar-container uk-navbar-primary" uk-navbar="mode: click">
    <div class="uk-container uk-container-expand uk-width-1-1">
        <nav class="uk-navbar">
            <div class="uk-navbar-left">
                <!-- Branding Image -->
                <a class="uk-navbar-item uk-logo" href="{{ url('/') }}">
                    {{ config('app.name', 'WERA') }}
                </a>
            </div>
            <div class="uk-navbar-right">
                <a href="#offcanvas" uk-toggle uk-navbar-toggle-icon class="uk-navbar-toggle uk-hidden@s"></a>
                <ul class="uk-navbar-nav uk-visible@s">
                    @if (Auth::guest())
                        <li class="{{ request()->routeIs('login') ? 'uk-active' : '' }}"><a href="{{ route('login') }}">Login</a></li>
                        <li class="{{ request()->routeIs('register') ? 'uk-active' : '' }}"><a href="{{ route('register') }}">Register</a></li>
                    @else
                     <li class="">
                        <a href="#">
                            <span uk-icon="icon: bell"></span>
                            <span class="uk-badge " >
                                {{ Auth::user()->unreadNotifications()->count()  }}
                            </span>
                        </a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                @if (Auth::user()->unreadNotifications()->count() == 0)
                                    <li id="read"><a href="#">There are no unread notifications</a></li>
                                @else
                                    <li class="markAsRead"><a href="{{ route('jobs.markAsRead') }}">Mark as Read.</a></li>
                                    
                                @endif
                                @foreach (Auth::user()->unreadNotifications as $notification)
                                    <li>
                                        <a href="{{ route('jobs.viewApp', $notification->id)  }}">{{ $notification->data['application']['firstname'] }} applied for {{$notification->data['job_title'] }} job</a>
                                    </li>
                                @endforeach
                                
                                     
                               
                                
                            </ul>
                        </div>
                    </li>
                    
                    <li class="{{ request()->routeIs('dashboard') ? 'uk-active' : '' }}"><a href="/home">Dashboard</a></li>
                     <li class="{{ request()->routeIs('jobs.index') ? 'uk-active' : '' }}"><a href="/jobs">Browse Jobs</a></li>
                    <li class="{{ request()->routeIs('jobs.create') ? 'uk-active' : '' }}"><a href="{{ route('jobs.create') }}">Create Job</a></li>

                    <li class="">
                        <a href="#"><span class="uk-text-capitalize">{{ Auth::user()->name }}</span></a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
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
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>

@section('offcanvas')

<div id="offcanvas" uk-offcanvas="overlay: true; mode: reveal; flip: true">
    <div class="uk-offcanvas-bar uk-flex uk-flex-column">
       
        <ul class="uk-nav uk-nav-center uk-nav-primary uk-margin-auto-vertical">
            @if (Auth::guest())
                <li class="{{ request()->routeIs('login') ? 'uk-active' : '' }}"><a  href="{{ route('login') }}">Login</a></li>
                <li class="{{ request()->routeIs('register') ? 'uk-active' : '' }}"><a href="{{ route('register') }}">Register</a></li>
            @else
            <li class="{{ request()->routeIs('dashboard') ? 'uk-active' : '' }}"><a href="/home">Dashboard</a></li>
            <li class="{{ request()->routeIs('jobs.index') ? 'uk-active' : '' }}"><a href="/jobs">Browse Jobs</a></li>
            <li class="{{ request()->routeIs('jobs.create') ? 'uk-active' : '' }}"><a href="{{ route('jobs.create') }}">Create Job</a></li>
            <li class="{{ request()->routeIs('logout') ? 'uk-active' : '' }}">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
            @endif
        </ul>
    </div>
</div>
@endsection
