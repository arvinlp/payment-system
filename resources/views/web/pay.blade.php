@extends('includes.panel.auth')
@section('page_title')
    @lang('تایید پرداخت')
@endsection
@section('content')
    <div class="auth-form-wrapper px-4 py-5">
        <div class="noble-ui-logo d-block mb-2">@lang('سیستم پرداخت <span>آسان</span>')</div>
        <h5 class="text-muted fw-normal mb-4">
            @lang('در صورت درست بودن اطلاعات زیر جهت انتقال به بانک و پرداخت لطفا تایید فرمایید.')
        </h5>
        <form method="post" action="{{ route('web.pay.send') }}">
            @csrf
            @if (isset($name))
                <input type="hidden" name="name" value="{{ $name }}">
            @endif
            @if (isset($mobile))
                <input type="hidden" name="mobile" value="{{ $mobile }}">
            @endif
            @if (isset($backurl))
                <input type="hidden" name="backurl" value="{{ $backurl }}">
            @endif
            @if (isset($json))
                <input type="hidden" name="json" value="{{ $json }}">
            @endif
            <input type="hidden" name="amount" value="{{ $amount }}">
            <input type="hidden" name="gateway" value="{{ $gateway->id }}">

            <div class="">
                <div class="mb-3">
                    @lang('مبلغ قابل پرداخت : :amount ', ['amount' => priceWithCurrency($amount)])
                </div>
                @if (isset($name))
                    <div class="mb-3">
                        @lang('پرداخت کننده : :name ', ['name' => $name])
                    </div>
                @endif
                @if (isset($mobile))
                    <div class="mb-3">
                        @lang('موبایل پرداخت کننده : :mobile ', ['mobile' => $mobile])
                    </div>
                @endif
                <div class="mb-3">
                    @lang('پرداخت با :gateway ', ['gateway' => $gateway->name])
                </div>
            </div>
            <div class="form-button">
                <button type="submit" name="submit" class="btn btn-primary w-100 me-2 mb-2 mb-md-0 text-white">@lang('بله، پرداخت می‌کنم')</button>
            </div>
        </form>
    </div>
@endsection
