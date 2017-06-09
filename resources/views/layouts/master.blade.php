<!DOCTYPE html>

<html>
    <head>
        <title> PHIC Supplies System - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}"> 
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}"> 

    </head>
    <body>
        
        @include('shared.header')
        
        <div class="container">
            @yield('content')
        
        </div>

        @include('shared.footer')


        <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>

    </body>
</html>
