@extends('includes.auth.base')
@section('page_title')
    @lang('فعال‌سازی حساب کاربری')
@endsection
@section('content')
    <div class="page-links">
        <a href="{{ route('auth.login.pass') }}">@lang('ورود')</a>
        <a href="{{ route('auth.forgot.password') }}">@lang('فراموشی گذرواژه')</a>
        <a href="{{ route('auth.active') }}" class="active">@lang('فعال‌سازی')</a>
    </div>
    <form method="post" action="{{ route('auth.active.check') }}">
        @csrf
        <input class="form-control" type="mobile" name="mobile"
            @if (!empty($mobile)) value="0{{ $mobile }}" @endif placeholder="@lang('موبایل')" required>
        <div class="form-button">
            <button id="submit" type="submit" class="ibtn">@lang('فعال‌سازی مجدد')</button>
        </div>
    </form>
@endsection
