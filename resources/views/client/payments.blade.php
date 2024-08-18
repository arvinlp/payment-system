@extends('includes.panel.base')
@section('page_title')
    @lang('سابقه پرداخت‌ها')
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
                                        <th>مبلغ</th>
                                        <th class="text-center">وضعیت</th>
                                        <th class="text-center">کد پیگیری</th>
                                        <th class="text-center">تاریخ و ساعت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($data))
                                        @foreach ($data as $row)
                                            <tr class="{{ ($row->status > 0) ? '':'table-danger' }}">
                                                <td>{{ priceWithCurrencyToClient($row->amount) }}</td>
                                                <td class="text-center">{{ paymentStatus($row->status) }}</td>
                                                <td class="text-center">{{ $row->refid }}</td>
                                                <td class="text-center">{{ dateShow($row->updated_at, '%Y/%m/%d - H:m') }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
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
                        [10, 20, 30, 40, 50, -1],
                        [10, 20, 30, 40, 50, "همه"]
                    ],
                    "iDisplayLength": 20,
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
