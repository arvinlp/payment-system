@extends('includes.auth.base')
@section('page_title')
    @lang('بازیابی گذرواژه')
@endsection
@section('content')
    <div class="page-links">
        <a href="{{ route('auth.login.pass') }}">@lang('ورود')</a>
        <a href="{{ route('auth.forgot.password') }}" class="active">@lang('فراموشی گذرواژه')</a>
        <a href="{{ route('auth.active') }}">@lang('فعال‌سازی')</a>
    </div>
    <form method="post" action="{{ route('auth.forgot.password.check') }}">
        @csrf
        <input class="form-control" type="mobile" name="mobile"
            @if (!empty($mobile)) value="0{{ $mobile }}" @endif placeholder="@lang('موبایل')" required>
        <div class="form-button">
            <button id="submit" type="submit" class="ibtn">@lang('دریافت گذرواژه جدید')</button>
        </div>
    </form>
@endsection
