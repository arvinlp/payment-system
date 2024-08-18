@extends('includes.panel.base')
@section('page_title')
    @lang('تراکنش‌ها')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row g-3">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTablePayment" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="32px">#</th>
                                        <th scope="col">@lang('پرداخت کننده')</th>
                                        <th scope="col" class="text-center">@lang('مبلغ')</th>
                                        <th scope="col" class="text-center">@lang('درگاه پرداخت')</th>
                                        <th scope="col" class="text-center">@lang('کد پیگیری')</th>
                                        <th scope="col" class="text-center">@lang('تاریخ')</th>
                                        <th scope="col" width="128px" class="text-center">@lang('وضعیت')</th>
                                        <th scope="col" width="64px" class="text-center">@lang('عملیات')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td scope="row">{{ $item->id }}</td>
                                            <td>{{ $item->user->nickname ?? $item->user_id }}</td>
                                            <td class="text-center">{{ priceWithCurrency($item->amount) }}</td>
                                            <td class="text-center">{{ paymentDriver($item->driver) }}</td>
                                            <td class="text-center">{{ $item->track_id }}</td>
                                            <td class="text-center">{{ dateShow($item->updated_at, '%Y/%m/%d - H:m') }}</td>
                                            <td class="text-center">{{ paymentStatus($item->status) }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="btnGroup">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#showModal-{{ $item->id }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="showModal-{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="showModalLabel-{{ $item->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="showModalLabel-{{ $item->id }}">
                                                                    مشاهده اطلاعات تراکنش '{{ $item->id }}'
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-bordered table-striped">
                                                                    <tr>
                                                                        <td>@lang('پرداخت کننده : ')</td>
                                                                        <td>{{ $item->user_id ?? 'نامشخص' }} - {{ $item->user->nickname ?? '!' }}</td>
                                                                        <td>@lang('موبایل : ')</td>
                                                                        <td>{{ $item->user->mobile ?? '!' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>@lang('تاریخ پرداخت : ')</td>
                                                                        <td>{{ dateShow($item->updated_at, '%Y/%m/%d') }}</td>
                                                                        <td>@lang('ساعت پرداخت : ')</td>
                                                                        <td>{{ dateShow($item->updated_at, 'H:m:i') }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>@lang('وضعیت پرداخت : ')</td>
                                                                        <td>{{ paymentStatus($item->status) }}</td>
                                                                        <td>@lang('کد وضعیت پرداخت : ')</td>
                                                                        <td>{{ $item->status }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>@lang('درگاه پرداخت : ')</td>
                                                                        <td>{{ paymentDriver($item->driver) }}</td>
                                                                        <td>@lang('کد پیگیری : ')</td>
                                                                        <td>{{ $item->track_id }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>@lang('مبلغ پرداختی : ')</td>
                                                                        <td>{{ priceWithCurrency($item->amount) }}</td>
                                                                        <td>@lang('مبلغ پرداختی خام : ')</td>
                                                                        <td>{{ $item->amount }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>@lang('کد ارز پرداخت شده : ')</td>
                                                                        <td>{{ $item->currency_id }}</td>
                                                                        <td>@lang('نام ارز پرداخت شده : ')</td>
                                                                        <td>{{ $item->currency->name ?? 'نامشخص' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>@lang('کد ارز پرداخت شده : ')</td>
                                                                        <td>{{ $item->currency_id }}</td>
                                                                        <td>@lang('نام ارز پرداخت شده : ')</td>
                                                                        <td>{{ $item->currency->name ?? 'نامشخص' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>@lang('کد سرویس انتخاب شده : ')</td>
                                                                        <td>{{ $item->service_id ?? 'نامشخص' }}</td>
                                                                        <td>@lang('سرویس انتخاب شده : ')</td>
                                                                        <td>{{ $item->service->name ?? 'نامشخص' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2">@lang('کد اشتراک در صورت وجود : ')</td>
                                                                        <td colspan="2">{{ $item->subscribe ?? 'خرید سرویس جدید' }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                    data-bs-dismiss="modal">
                                                                    @lang('بستن')
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col" width="32px">#</th>
                                        <th scope="col">@lang('پرداخت کننده')</th>
                                        <th scope="col" class="text-center">@lang('مبلغ')</th>
                                        <th scope="col" class="text-center">@lang('درگاه پرداخت')</th>
                                        <th scope="col" class="text-center">@lang('کد پیگیری')</th>
                                        <th scope="col" class="text-center">@lang('تاریخ')</th>
                                        <th scope="col" width="128px" class="text-center">@lang('وضعیت')</th>
                                        <th scope="col" width="64px" class="text-center">@lang('عملیات')</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function() {
            'use strict';

            $(function() {
                $('#dataTablePayment').DataTable({
                    "aLengthMenu": [
                        [10, 30, 50, -1],
                        [10, 30, 50, "همه"]
                    ],
                    "iDisplayLength": 10,
                    "language": {
                        search: ""
                    }
                });
                $('#dataTablePayment').each(function() {
                    var datatable = $(this);
                    // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                    var search_input = datatable.closest('.dataTables_wrapper').find(
                        'div[id$=_filter] input');
                    search_input.attr('placeholder', 'جستجو');
                    search_input.removeClass('form-control-sm');
                    // LENGTH - Inline-Form control
                    var length_sel = datatable.closest('.dataTables_wrapper').find(
                        'div[id$=_length] select');
                    length_sel.removeClass('form-control-sm');
                });
            });

        });
    </script>
@endsection
