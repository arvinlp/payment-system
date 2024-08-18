@extends('includes.auth.base')
@section('page_title')
    @lang('ورود یا ثبت نام')
@endsection
@section('content')
    <div class="page-links">
        <a href="{{ route('auth.login.pass') }}">@lang('ورود با پسورد')</a>
        <a href="{{ route('auth.login.code') }}" class="active">@lang('ورود با کد یک بارمصرف')</a>
    </div>
    <form method="post" action="{{ route('auth.login.code') }}">
        @csrf
        <input class="form-control" type="text" name="mobile"
            @if (!empty($mobile)) value="0{{ $mobile }}" @endif placeholder="@lang('موبایل')" required>
        <div class="form-button">
            <button id="submit" type="submit" class="ibtn">@lang('دریافت کد')</button>
            <a href="{{ route('auth.active') }}" class="wbtn">@lang('فعال‌سازی')</a>
        </div>
    </form>
@endsection
