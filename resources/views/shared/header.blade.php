<!-- Header-->
    
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">PhilHealth Supplies System</a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Request Module&nbsp&nbsp<span class="caret" aria-hidden="true"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('requests') }}">Show All Requests</a></li>
                        <li><a href="{{ url('requests/create') }}">Create New Request</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Approve Requests</a></li>
                        <li><a href="#">Issue Requests</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Items Module&nbsp&nbsp<span class="caret" aria-hidden="true"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('items.index') }}">Show All Items</a></li>
                        <li><a href="{{ route('items.create') }}">Create New Item </a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Section Module&nbsp&nbsp<span class="caret" aria-hidden="true"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('sections.index') }}">Show All Section</a></li>
                        <li><a href="{{ route('sections.create') }}">Create New Section</a></li>
                    </ul>
                </li>

                <li><a href="{{ url('sample') }}">Sample</a></li>

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
                            {{ Auth::user()->first_name }}&nbsp&nbsp <span class="caret"></span>
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

<!-- End of Header -->


<!-- OLD HEADER -->

<!--
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a class="navbar-brand" href="#">PhilHealth Supplies System</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Request Module&nbsp&nbsp<span class="caret" aria-hidden="true"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('requests') }}">Show All Requests</a></li>
                        <li><a href="{{ url('requests/create') }}">Create New Request</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Approve Requests</a></li>
                        <li><a href="#">Issue Requests</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Items Module&nbsp&nbsp<span class="caret" aria-hidden="true"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('items.index') }}">Show All Items</a></li>
                        <li><a href="{{ route('items.create') }}">Create New Item </a></li>
                    </ul>
                </li>

                <li><a href="{{ url('about') }}">About</a></li>
            </ul>
        </div>
    </div>
</nav> 
-->
