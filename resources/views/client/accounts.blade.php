@extends('includes.panel.base')
@section('page_title')
    @lang('داشبورد کاربری')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row g-3">
            <div class="col-12 col-md-4">
                <div class="card h-100">
                    <a class="card-body" href="{{ route('client.dashboard') }}">
                        <span class="position-absolute top-50 start-50 translate-middle text-center">
                            <i class="fa fa-plus fa-3x"></i><br>
                            <b>@lang('خرید اشتراک')</b>
                        </span>
                    </a>
                </div>
            </div>
            @if (isset($mySubscribes))
                @foreach ($mySubscribes as $subscribe)
                    @include('includes.subscribe.box-item',['subscribe'=>$subscribe, 'view_prefix' => 'client'])
                @endforeach
            @endif
        </div>
    </div>
@endsection
