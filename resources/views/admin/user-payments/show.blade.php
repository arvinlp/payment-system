@extends('includes.panel.base')
@section('page_title')
    @lang('جزییات تراکنش')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row g-3">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td>@lang('پرداخت کننده : ')</td>
                                    <td>{{ $data->user_id ?? 'نامشخص' }} - {{ $data->user->nickname ?? '!' }}</td>
                                    <td>@lang('موبایل : ')</td>
                                    <td>{{ $data->user->mobile ?? '!' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('تاریخ پرداخت : ')</td>
                                    <td>{{ dateShow($data->updated_at, '%Y/%m/%d') }}</td>
                                    <td>@lang('ساعت پرداخت : ')</td>
                                    <td>{{ dateShow($data->updated_at, 'H:m:i') }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('وضعیت پرداخت : ')</td>
                                    <td>{{ paymentStatus($data->status) }}</td>
                                    <td>@lang('کد وضعیت پرداخت : ')</td>
                                    <td>{{ $data->status }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('درگاه پرداخت : ')</td>
                                    <td>{{ paymentDriver($data->driver) }}</td>
                                    <td>@lang('کد پیگیری : ')</td>
                                    <td>{{ $data->track_id }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('مبلغ پرداختی : ')</td>
                                    <td>{{ priceWithCurrency($data->amount) }}</td>
                                    <td>@lang('مبلغ پرداختی خام : ')</td>
                                    <td>{{ $data->amount }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('کد ارز پرداخت شده : ')</td>
                                    <td>{{ $data->currency_id }}</td>
                                    <td>@lang('نام ارز پرداخت شده : ')</td>
                                    <td>{{ $data->currency->name ?? 'نامشخص' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('کد ارز پرداخت شده : ')</td>
                                    <td>{{ $data->currency_id }}</td>
                                    <td>@lang('نام ارز پرداخت شده : ')</td>
                                    <td>{{ $data->currency->name ?? 'نامشخص' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('کد سرویس انتخاب شده : ')</td>
                                    <td>{{ $data->service_id ?? 'نامشخص' }}</td>
                                    <td>@lang('سرویس انتخاب شده : ')</td>
                                    <td>{{ $data->service->name ?? 'نامشخص' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">@lang('کد اشتراک در صورت وجود : ')</td>
                                    <td colspan="2">{{ $data->subscribe ?? 'خرید سرویس جدید' }}</td>
                                </tr>
                            </table>

                            <div class="col-12 text-md-end mt-3">
                                <a class="btn btn-sm btn-danger" href="{{ route('admin.user-payments') }}">
                                    @lang('بازگشت')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
