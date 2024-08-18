@include('includes.panel.header')
<!-- partial:partials/_navbar.html -->
<!-- partial -->

<div class="page-content">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">@yield('page_title', '')</h4>
        </div>
    </div>

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

    <div id="SMMSpinner" class="text-center">
        <div class="row d-flex justify-content-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">بارگزاری...</span>
            </div>
            <div class="text-primary"><br>درحال بارگزاری ...</div>
        </div>
    </div>

    @yield('content')
</div>

@include('includes.panel.footer')
