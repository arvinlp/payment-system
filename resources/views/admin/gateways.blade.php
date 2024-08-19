@extends('includes.panel.base')
@section('page_title')
    @lang('درگاه‌ها')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row g-3">
            <div class="accordion" id="addNewForm">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button @if (!isset($editData)) collapsed @endif" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseAddNewForm"
                            aria-expanded="@if (isset($editData)) true @else false @endif"
                            aria-controls="collapseAddNewForm">
                            @if (isset($editData))
                                @lang('ویرایش درگاه :name', ['name' => $editData->name])
                            @else
                                @lang('افزودن درگاه جدید')
                            @endif
                        </button>
                    </h2>
                    <div id="collapseAddNewForm"
                        class="accordion-collapse collapse @if (isset($editData)) show @endif"
                        aria-labelledby="headingOne" data-bs-parent="#addNewForm">
                        <div class="accordion-body">
                            @if (!isset($editData))
                                <form action="{{ route('admin.gateways.new') }}" method="POST"
                                    enctype="multipart/form-data" id="fileUploadForm">
                                @else
                                    <form action="{{ route('admin.gateways.edit', ['id' => $id]) }}" method="POST"
                                        enctype="multipart/form-data" id="fileUploadForm">
                            @endif
                            @csrf
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            @if (isset($editData))
                                                <h3>@lang('ویرایش درگاه :name', ['name' => $editData->name])</h3>
                                            @else
                                                <h3>@lang('افزودن درگاه جدید')</h3>
                                            @endif
                                        </div>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-12">
                                                <div class="row align-items-center">
                                                    <div class="col-2 col-md-1">
                                                        <label for="name">@lang('نام')</label>
                                                    </div>
                                                    <div class="col col-md">
                                                        <input id="name" name="name"
                                                            @if (isset($editData)) value="{{ $editData->name != '' ? $editData->name : '' }}" @endif
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row align-items-center">
                                                    <div class="col-12 col-md-2">
                                                        <label for="driver">@lang('درایور')</label>
                                                    </div>
                                                    <div class="col-12 col-md">
                                                        <select class="vira-select2 form-select" name="driver"
                                                            data-width="100%">
                                                            @foreach (paymentDriverCode() as $key => $value)
                                                                <option value="{{ $key }}"
                                                                    @if (isset($editData)) {{ $editData->driver == $key ? 'selected' : '' }} @endif>
                                                                    {{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row align-items-center">
                                                    <div class="col-2 col-md-2">
                                                        <label for="username">@lang('نام کاربری')</label>
                                                    </div>
                                                    <div class="col col-md">
                                                        <input id="username" name="username"
                                                            @if (isset($editData)) value="{{ $editData->username != '' ? $editData->username : '' }}" @endif
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row align-items-center">
                                                    <div class="col-2 col-md-2">
                                                        <label for="password">@lang('گذرواژه')</label>
                                                    </div>
                                                    <div class="col col-md">
                                                        <input id="password" name="password"
                                                            @if (isset($editData)) value="{{ $editData->password != '' ? $editData->password : '' }}" @endif
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row align-items-center">
                                                    <div class="col-2 col-md-2">
                                                        <label for="merchant_id">@lang('کد مرچمنت')</label>
                                                    </div>
                                                    <div class="col col-md">
                                                        <input id="merchant_id" name="merchant_id"
                                                            @if (isset($editData)) value="{{ $editData->merchant_id != '' ? $editData->merchant_id : '' }}" @endif
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row align-items-center">
                                                    <div class="col-2 col-md-2">
                                                        <label>@lang('وضعیت :')</label>
                                                    </div>
                                                    <div class="col col-md align-items-center">
                                                        @foreach (statusCode() as $key => $value)
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" class="form-check-input"
                                                                    name="status" id="status-{{ $key }}"
                                                                    @if (isset($editData)) {{ $editData->status == $key ? 'checked' : '' }} @else @if ($key == 1) checked @endif
                                                                    @endif
                                                                value="{{ $key }}">
                                                                <label class="form-check-label"
                                                                    for="status-{{ $key }}">
                                                                    <span></span>{{ $value }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3 mt-3 align-items-center">
                                            <div class="col col-md">
                                                <button class="btn btn-sm btn-outline-primary" type="submit">
                                                    @lang('ذخیره')
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTablePayment" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="32px">#</th>
                                        <th scope="col">@lang('نام')</th>
                                        <th scope="col" width="128px" class="text-center">@lang('وضعیت')</th>
                                        <th scope="col" width="64px" class="text-center">@lang('عملیات')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td scope="row">{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-center">{{ status($item->status) }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="btnGroup">
                                                    <a href="{{ route('admin.gateways.edit', ['id' => $item->id]) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal-{{ $item->id }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteModal-{{ $item->id }}"
                                                    tabindex="-1" aria-labelledby="deleteModalLabel-{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel-{{ $item->id }}">حذف
                                                                    '{{ $item->name }}'</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                @lang('آیا از حذف درگاه  ":name" مطمین هستید ?', ['name' => $item->name])
                                                            </div>
                                                            <form method="POST"
                                                                action="{{ route('admin.gateways.delete', ['id' => $item->id]) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                                        @lang('بلی')
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm btn-danger"
                                                                        data-bs-dismiss="modal">
                                                                        @lang('خیر')
                                                                    </button>
                                                                </div>
                                                            </form>
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
                                        <th scope="col">@lang('نام')</th>
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

@section('css')
    <link rel="stylesheet" href="{{ asset('panel/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/vendors/dropify/dist/dropify.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('panel/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('panel/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('panel/vendors/dropify/dist/dropify.min.js') }}"></script>
    <script>
        $(function() {
            'use strict';

            if ($(".vira-select2").length) {
                $(".vira-select2").select2();
            }

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
