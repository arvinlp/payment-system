@extends('includes.panel.auth')
@section('page_title')
    @lang('پرداخت')
@endsection
@section('content')

    <div class="auth-form-wrapper px-4 py-5">
        <div class="noble-ui-logo d-block mb-2">@lang('سیستم پرداخت <span>آسان</span>')</div>
        <h5 class="text-muted fw-normal mb-4">
            @lang('جهت پرداخت لطفا تمامی موارد پایین را تکمیل کنید.')
        </h5>
        @if (isset($gateways))
            <form method="post" action="{{ route('web.pay') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">@lang('نام')</label>
                    <input class="form-control" type="text" name="name" dir="rtl" placeholder="نام پرداخت کننده">
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">@lang('موبایل')</label>
                    <input id="mobile" class="form-control" type="number" name="mobile" dir="ltr" length="11"
                        placeholder="موبایل پرداخت کننده بدون صفر">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">@lang('مبلغ :currency',['currency'=> $currency ?? 'تومان' ])</label>
                    <input id="amount" class="form-control" type="number" min="1000" step="500" name="amount" dir="rtl"
                        placeholder="مبلغ را به {{ $currency ?? 'IRT' }} وارد نمایید." required>
                </div>
                <div class="mb-3">
                    <label for="gatewaye" class="form-label">@lang('درگاه پرداخت')</label>
                    <select class="form-select" name="gatewaye">
                        @php $i = 0; @endphp
                        @foreach ($gateways as $item)
                            <option @if ($i == 0) selected @endif value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                            @php $i++; @endphp
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-8">
                        <button type="submit" name="submit" class="btn btn-primary w-100 me-2 mb-2 mb-md-0 text-white">
                            @lang('پرداخت')
                        </button>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('auth.login.code') }}" class="btn btn-light w-100 me-2 mb-2 mb-md-0">
                            @lang('ورود')
                        </a>
                    </div>
                </div>
            </form>
        @else
            <div class="row">
                <div class="col-12">
                    <p>
                        @lang('متاسفانه درگاه پرداختی تعریف نشده است! لطفا پنل سامانه را بروزرسانی کنید.')
                    </p>
                </div>
                <div class="col-12">
                    <a href="{{ route('auth.login.code') }}" class="btn btn-light w-100 me-2 mb-2 mb-md-0">
                        @lang('ورود')
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
