<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}" dir="{{ Config::get('app.locale_direction') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('Payment System') - @yield('page_title', '')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/css/fontawesome-all.min.css') }}">

    @if (Config::get('app.locale_direction') == 'rtl')
        <link rel="stylesheet" type="text/css" href="{{ asset('auth/css/iofrm-style-rtl.css') }}">
        <link rel="stylesheet" href="{{ asset('auth/css/iofrm-theme14.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('auth/css/iofrm-style.css') }}">
        <link rel="stylesheet" href="{{ asset('auth/css/iofrm-theme14.css') }}">
    @endif
    @yield('css')
</head>

<body>
    <div class="form-body" class="container-fluid">
        <div class="row">
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
    <script type="text/javascript" src="{{ asset('auth/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/main.js') }}"></script>
    @yield('js')
</body>

</html>
