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
                                        <th scope="col">@lang('صاحب امتیاز پایانه')</th>
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
