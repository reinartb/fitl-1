<!-- Header-->
    <div class="navbar navbar-inverse navbar-static-top">
        <div class="container=fluid">
            <div class ="navbar-header">
                <button type="button"  class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavBar">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Supplies</a>
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('requests/create') }}">Create New Request</a></li>
                    <li><a href="#">Approve Requests</a></li>
                    <li><a href="#">Issue Requests</a></li>
                    <li><a href="{{ url('requests') }}">Check Request Status</a></li>
                    <li><a href="{{ url('about') }}">About</a></li>
                </ul>
            </div>
        </div>
    </div>
<!-- End of Header -->