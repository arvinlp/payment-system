<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}" dir="{{ Config::get('app.locale_direction') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Arvin Loripour">

    <title>@lang("Payment System") - {{ $store->name ?? '' }}@yield('page_title', '')</title>


    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('panel/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/css/custom.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('panel/vendors/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/css/persian-datepicker-0.4.5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('panel/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    @if( Config::get('app.locale_direction') == 'rtl')
    <link rel="stylesheet" href="{{ asset('panel/css/demo1/style-rtl.min.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('panel/css/demo1/style.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('panel/css/fontawesome/all.css') }}">
    @yield('css')
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('panel/images/favicon.png') }}" />
</head>

<body>
    <div class="main-wrapper">
        @include('includes.panel.sidebar')
        <div class="page-wrapper">

            @include('includes.panel.navbar')
