@extends('includes.auth.base')
@section('page_title')
    @lang('ورود یا ثبت نام')
@endsection
@section('content')
    <div class="page-links">
        <a href="{{ route('auth.login.pass') }}" class="active">@lang('ورود با گذرواژه')</a>
        <a href="{{ route('auth.login.code') }}">@lang('ورود با کد یک بارمصرف')</a>
    </div>
    <form method="post" action="{{ route('auth.login.pass') }}">
        @csrf
        <input class="form-control" type="text" name="mobile"
            @if (!empty($mobile)) value="0{{ $mobile }}" @endif placeholder="@lang('موبایل')" required>
        <input class="form-control" type="password" name="password" placeholder="@lang('گذرواژه')" required>
        <div class="form-button">
            <button id="submit" type="submit" class="ibtn">@lang('ورود')</button>
            <a href="{{ route('auth.active') }}" class="wbtn">@lang('فعال‌سازی')</a>
        </div>
    </form>
    <div class="other-links">
        <a href="{{ route('auth.forgot.password') }}">@lang('گذرواژه‌ام را فراموش کرده‌ام')</a>
    </div>
@endsection
