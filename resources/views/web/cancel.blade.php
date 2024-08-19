@extends('includes.panel.auth')
@section('page_title')
    @lang('خطا در پرداخت')
@endsection
@section('content')
    <div class="auth-form-wrapper px-4 py-5">
        <div class="noble-ui-logo d-block mb-2">@lang('سیستم پرداخت <span>آسان</span>')</div>
        <h5 class="text-muted fw-normal mb-4">
            @lang('پرداخت با خطا مواجحه شده است، مبلغ واریز تا ۶۰ دقیقه به حسابتان بازگشت داده می‌شود.')
        </h5>
        <div class="alert alert-danger">
            <span>@lang('کد خطا : :code',['code' => $code])</span>
            <span>@lang('پیغام خطا : :message', ['message' => $message])</span>
        </div>
    </div>
@endsection