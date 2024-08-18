@extends('includes.auth.base')
@section('page_title')
    @lang('تایید کد یکبار مصرف')
@endsection
@section('content')
    <form method="post" action="{{ route('auth.login.code.verify') }}">
        @csrf
        <input class="form-control" type="text" name="mobile"
            @if (!empty($mobile)) value="0{{ $mobile }}" @endif placeholder="@lang('موبایل')" required>
        <input class="form-control" type="text" name="code" placeholder="@lang('کد دریافت شده را وارد کنید')" required>
        <div class="form-button">
            <button id="submit" type="submit" class="ibtn">@lang('ورود به پنل')</button>
            {{-- <a id="resend" onclick="submitPoll()" class="btn btn-danger">@lang('دریافت مجدد کد')</a> --}}
        </div>
        <div class="other-links" id="show">
            <p class="text"></p>
        </div>
    </form>
@endsection
@section('js')
@endsection
