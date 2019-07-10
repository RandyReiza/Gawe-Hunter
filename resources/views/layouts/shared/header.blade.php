<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand">
        <img src="{{ asset('img/nasa.png') }}" alt="nasa" width="65" height="50" class="d-inline-block align-top">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">    {{--  {{ Request::is('/') ? 'active' : '' }}, utk membuat class active {bootstrap} saat url yg dituju sesuai --}}
                <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
        </ul>
        {{-- Menu Login & Register --}}
        <ul class="navbar-nav pull-right">
            @if (Auth::guest())
            <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">                
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            @else
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                </div>
            </li>
            @endif
        </ul>
        {{-- END Menu Login & Register --}}
    </div>
</nav>