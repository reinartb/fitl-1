<!-- Header-->
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
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Request Module<span class="caret" aria-hidden="true"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('requests') }}">Show All Requests</a></li>
                        <li><a href="{{ url('requests/create') }}">Create New Request</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Edit Requests</a></li>
                        <li><a href="#">Approve Requests</a></li>
                        <li><a href="#">Issue Requests</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('about') }}">About</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- End of Header -->