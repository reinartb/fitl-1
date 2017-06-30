<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PHIC Supplies - @yield('title')</title>

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/select2.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/custom_1.css') }}"> 

</head>
    <body>
        @include('shared.header')

        <div class="container">
            @include('shared.errors')
            @include('shared.message')
            @yield('content')
        
        </div>

        @include('shared.footer')


        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/custom_app.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>
        <!-- <script src="{{ asset('js/app.js') }}"></script> -->

        @yield('scripts')

    </body>
</html>
