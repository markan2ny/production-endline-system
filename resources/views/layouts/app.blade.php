<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Production System') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- DataTables-->
    <link rel="stylesheet" href="{{ asset('/datatable/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/datatable/css/dataTables.bootstrap4.min.css')}}">
    <!-- Toastr-->
    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.min.css')}}">
    @stack('styles')
    @livewireStyles
</head>
<body>
    <div id="app">
        @include('layouts.nav')
        <div class="container mt-5">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('/vendor/js/jquery.min.js')}}"></script>
    @stack('javascripts')
    <script src="{{ asset('/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/datatable/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('/vendor/js/all.min.js')}}"></script>
    @livewireScripts
</body>
</html>