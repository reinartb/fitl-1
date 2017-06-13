<!DOCTYPE html>

<html>
    <head>
        <title> PHIC Supplies System - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}"> 
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        

    </head>
    <body>
        @include('shared.header')

        <div class="container">
            @include('shared.errors')
            @include('shared.message')
            @yield('content')
        
        </div>

        @include('shared.footer')


        <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/custom_app.js') }}"></script>

    </body>
</html>
