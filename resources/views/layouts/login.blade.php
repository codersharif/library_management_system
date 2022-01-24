<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Library Management System</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">
    </head>

    <body class="hold-transition login-page">
        @yield('login_content')
        <!-- jQuery -->
        <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>

    </body>

</html>
