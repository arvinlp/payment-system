@extends('includes.web.base')
@section('page_title')
    @lang('پرداخت')
@endsection
@section('content')
    @if (isset($gateways))
        <form method="post" action="{{ route('web.pay') }}">
            @csrf
            <input class="form-control" type="text" name="name" dir="rtl"
                placeholder="نام پرداخت کننده" >

                <input class="form-control" type="number" name="mobile" dir="ltr"
                placeholder="موبایل پرداخت کننده بدون صفر">

                <input class="form-control" type="text" name="amount" dir="rtl"
                placeholder="مبلغ را به {{ $currency ?? 'IRT' }} وارد نمایید." required>

            <div class="">
                <label>پرداخت با : </label>
                @php $i = 0; @endphp
                @foreach ($gateways as $item)
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="gatewaye" id="gatewaye-{{ $item->id }}"
                            @if($i == 0) checked @endif
                            value="{{ $item->id }}" />
                        <label class="form-check-label" for="gatewaye-{{ $item->id }}">
                            <span></span>{{ $item->name }}
                        </label>
                    </div>
                    @php $i++; @endphp
                @endforeach
            </div>

            <div class="form-button">
                <button id="submit" type="submit" class="ibtn">@lang('پرداخت')</button>
            </div>
        </form>
    @else
        <div>
            تنظیمات سیستم را بروز کنید.
        </div>
    @endif
    <div class="other-links">
        <a href="{{ route('auth.login.code') }}">@lang('ورود')</a>
        <a href="https://arvinlp.ir">طراح سیستم آروین لری پور</a>
    </div>
@endsection
@section('css')
<style>
    .form-check-input{
        display: none;
    }
</style>
@endsection