@extends('includes.web.base')
@section('page_title')
    @lang('تایید پرداخت')
@endsection
@section('content')
    <form method="post" action="{{ route('web.pay.send') }}">
        @csrf
        <input type="hidden" name="amount" value="{{ $amount }}">
        @if(isset($name))<input type="hidden" name="name" value="{{ $name }}">@endif
        @if(isset($mobile))<input type="hidden" name="mobile" value="{{ $mobile }}">@endif
        <input type="hidden" name="gateway" value="{{ $gateway->id }}">

        <div class="">
            <p>@lang('مبلغ قابل پرداخت : :amount ',['amount'=>priceWithCurrency($amount) ])</p>
            @if(isset($name))<p>@lang('پرداخت کننده : :name ',['name'=>$name ])</p>@endif
            @if(isset($mobile))<p>@lang('موبایل پرداخت کننده : :mobile ',['mobile'=>$mobile ])</p>@endif
            <p>@lang('پرداخت با :gateway ',['gateway'=>$gateway->name])</p>
        </div>

        <div class="form-button">
            <button id="submit" type="submit" class="ibtn">@lang('پرداخت می‌کنم')</button>
        </div>
    </form>
@endsection
@section('css')
    <style>
        .form-check-input {
            display: none;
        }
    </style>
@endsection
