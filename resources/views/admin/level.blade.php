@extends('includes.panel.base')
@section('page_title')
    @lang('تغییر کاربری :name', ['name' => $data->nickname])
@endsection
@section('content')
    <form action="{{ route('admin.user.change', [ 'id' => $data->id ]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3>@lang('تغییر نوع کاربری')</h3>
                            </div>
                            <div class="row g-3  align-items-center">
                                <div class="col">
                                    نوع کاربری فعلی : {{ getUserType( $data->type ) }}
                                </div>
                                <div class="col">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-3">
                                            <label for="type">@lang('کاربری جدید')</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select class="vira-select2 form-select" name="type" data-width="100%">
                                                @if (!empty(getUserTypes()))
                                                    @foreach (getUserTypes() as $key => $value)
                                                        <option value="{{ $key }}"
                                                            @if (isset($data)) {{ $data->type == $key ? 'selected' : '' }} @endif>
                                                            {{ $value }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mt-3 align-items-center">
                                    <div class="col-12 col-md-6">
                                        <button class="btn btn-sm btn-outline-primary" type="submit">
                                            @lang('بروزرسانی')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($data->type == 'staff')
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3>@lang('تغییر سطح دسترسی')</h3>
                            </div>
                            <div class="row g-3  align-items-center">
                                <div class="col">
                                    سطح دسترسی فعلی : {{ getUserLevel( $data->access_level ) }}
                                </div>
                                <div class="col">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-3">
                                            <label for="access_level">@lang('سطح دسترسی جدید')</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select class="vira-select2 form-select" name="access_level" data-width="100%">
                                                @if (!empty(getUserLevel()))
                                                    @foreach (getUserLevels() as $key => $value)
                                                        <option value="{{ $key }}"
                                                            @if (isset($data)) {{ $data->access_level == $key ? 'selected' : '' }} @endif>
                                                            {{ $value }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mt-3 align-items-center">
                                    <div class="col-12 col-md-6">
                                        <button class="btn btn-sm btn-outline-primary" type="submit">
                                            @lang('بروزرسانی')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </form>
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
            'use strict'

            if ($(".vira-select2").length) {
                $(".vira-select2").select2();
            }
        });
    </script>
@endsection
