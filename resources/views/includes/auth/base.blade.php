<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}" dir="{{ Config::get('app.locale_direction') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('Payment System') - @yield('page_title', '')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('login/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login/css/fontawesome-all.min.css') }}">

    @if (Config::get('app.locale_direction') == 'rtl')
        <link rel="stylesheet" type="text/css" href="{{ asset('login/css/iofrm-style-rtl.css') }}">
        <link rel="stylesheet" href="{{ asset('login/css/iofrm-theme4-rtl.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('login/css/iofrm-style.css') }}">
        <link rel="stylesheet" href="{{ asset('login/css/iofrm-theme4.css') }}">
    @endif

</head>

<body>
    <div class="form-body" class="container-fluid">
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="{{ asset('login/images/graphic1.svg') }}" alt="Payment System - Panel">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>@yield('page_title', '')</h3>
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
                        @if (session('info'))
                            <div class="alert alert-info">
                                {{ session('info') }}
                            </div>
                        @endif

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('login/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('login/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('login/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('login/js/main.js') }}"></script>
    @yield('js')
</body>

</html>
