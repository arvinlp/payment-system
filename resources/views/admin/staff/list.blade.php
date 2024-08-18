@extends('includes.panel.base')
@section('page_title')
    @lang('پرسنل')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row g-3">
            <div class="col-md-12">
                <a href="{{ route('admin.staffs.new') }}" class="col-12 col-md-3 btn btn-primary">
                    @lang('افزودن کارمند جدید')
                </a>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" width="32px">#</th>
                                        <th scope="col">@lang('نام')</th>
                                        <th scope="col">@lang('نام خانوادگی')</th>
                                        <th scope="col">@lang('موبایل')</th>
                                        <th scope="col" width="128px" class="text-center">@lang('وضعیت')</th>
                                        <th scope="col" width="64px" class="text-center">@lang('عملیات')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td scope="row">{{ $item->id }}</td>
                                            <td>{{ $item->fname }}</td>
                                            <td>{{ $item->lname }}</td>
                                            <td>{{ $item->mobile }}</td>
                                            <td class="text-center">{{ userStatus($item->status) }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="action">
                                                    <a href="{{ route('admin.user.change', ['id' => $item->id]) }}"
                                                        name="@lang('ورود')"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-sign-in"></i>
                                                    </a>
                                                    <a href="{{ route('admin.user.change', ['id' => $item->id]) }}"
                                                        name="@lang('تغییر کاربری')"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-refresh"></i>
                                                    </a>
                                                    <a href="{{ route('admin.staffs.edit', ['id' => $item->id]) }}"
                                                        name="@lang('ویرایش')"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal-{{ $item->id }}"
                                                        name="@lang('حذف')"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteModal-{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="deleteModalLabel-{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel-{{ $item->id }}">حذف
                                                                    '{{ $item->name }}'</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                @lang('آیا از حذف ":name" مطمین هستید ?', ['name' => $item->nickname])
                                                            </div>
                                                            <form method="POST"
                                                                action="{{ route('admin.staffs.delete', ['id' => $item->id]) }}">
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
                                        <th scope="col">@lang('نام خانوادگی')</th>
                                        <th scope="col">@lang('موبایل')</th>
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
                $('#dataTable').DataTable({
                    "aLengthMenu": [
                        [10, 30, 50, -1],
                        [10, 30, 50, "همه"]
                    ],
                    "iDisplayLength": 10,
                    "language": {
                        search: ""
                    }
                });
                $('#dataTable').each(function() {
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