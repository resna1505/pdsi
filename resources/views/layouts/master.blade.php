<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  data-layout="vertical" data-topbar="light"  data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | PDSI </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="ICT PDSI" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.png') }}">
    @include('layouts.head-css')
    @livewireStyles
</head>
<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @include('layouts.top-tagbar')
        @include('layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    @include('layouts.customizer')
    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')
    @livewireScripts
</body>

</html>
