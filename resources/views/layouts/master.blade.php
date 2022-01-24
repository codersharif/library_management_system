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

    <title>{{ config('app.name', 'Library Management System') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
    <!--<link rel="stylesheet" href="{{ asset('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">-->
    <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div id="app">
        <div class="wrapper">
            <!--TOp Navbar -->
            @include('layouts.topNavbar')
            <!-- Top /.navbar -->

            <!-- Main Sidebar Container -->
            @include('layouts.sidebar')
            {{-- End Main Sidebar Container --}}

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- /.content-wrapper -->


            <!-- Main Footer -->
            @include('layouts.footer')
            {{-- END Main Footer --}}
        </div>
        <!-- ./wrapper -->

    </div>
    <!-- REQUIRED SCRIPTS -->
    <!--<script src="{{ asset('public/js/app.js') }}"></script>-->
    <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--<script src="{{ asset('public/plugins/select2/js/select2.full.min.js') }}"></script>-->
    <script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>
    <!-- <script>
    $('.delete').click(function() {
        alt = confirm('Are you sure, want to delete!');

        if (alt == true) {
            return true;
        }
        return false;
    });
    </script> -->
</body>

</html>
