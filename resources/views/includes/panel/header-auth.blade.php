<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}" dir="{{ Config::get('app.locale_direction') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Arvin Loripour">

    <title>@lang('Payment System') - @yield('page_title', '')</title>


    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('panel/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/css/custom.css') }}">
    <!-- endinject -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('panel/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    @if (Config::get('app.locale_direction') == 'rtl')
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
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-4 pe-md-0">
                                    <div class="auth-side-wrapper">

                                    </div>
                                </div>
                                <div class="col-md-8 ps-md-0">

                                    @if (session('message'))
                                        <div class="alert alert-primary">
                                            {!! session('message') !!}
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
