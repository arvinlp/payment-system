@extends('includes.panel.auth')
@section('page_title')
    @lang('پرداخت موفق')
@endsection
@section('content')
    <div class="auth-form-wrapper px-4 py-5">
        <div class="noble-ui-logo d-block mb-2">@lang('سیستم پرداخت <span>آسان</span>')</div>
        <h5 class="text-muted fw-normal mb-4">
            @lang('پرداخت با موفقیت انجام شد.')
        </h5>
        <div class="alert alert-success">
            <span>@lang('کد پیگیری بانک : :refid',['refid'=>$refid])</span>
            <span>@lang('با تشکر از پرداخت شما')</span>
        </div>
    </div>
@endsection