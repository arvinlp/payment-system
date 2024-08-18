@extends('includes.panel.base')
@section('page_title')
    @lang('پروفایل من')
@endsection
@section('content')
    <form action="{{ route('admin.profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-3">
                                            <label for="fname">@lang('نام')</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input id="fname" name="fname"
                                                @if (isset($data)) value="{{ $data->fname != '' ? $data->fname : '' }}" @endif
                                                placeholder="@lang('-')" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-3">
                                            <label for="lname">@lang('نام خانوادگی')</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input id="lname" name="lname"
                                                @if (isset($data)) value="{{ $data->lname != '' ? $data->lname : '' }}" @endif
                                                placeholder="@lang('-')" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-3">
                                            <label for="email">@lang('پست الکترونیک')</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input id="email" name="email"
                                                @if (isset($data)) value="{{ $data->email != '' ? $data->email : '' }}" @endif
                                                placeholder="@lang('-')" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-3">
                                            <label for="mobile">@lang('موبایل')</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input id="mobile" name="mobile" type="number"
                                                @if (isset($data)) value="{{ $data->mobile != '' ? $data->mobile : '0' }}" @endif
                                                placeholder="@lang('-')" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-3">
                                            <label for="password">@lang('گذرواژه')</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input id="password" name="password" type="password"
                                                placeholder="@lang('****')" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-3">
                                            <label for="password_confirmation">@lang('تایید گذرواژه')</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input id="password_confirmation" name="password_confirmation" type="password"
                                                placeholder="@lang('****')" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 mt-3 align-items-center">
                                <div class="col-12 col-md-6">
                                    <button class="btn btn-sm btn-outline-primary" type="submit">
                                        @lang('بروزرسانی')
                                    </button>
                                </div>
                                <div class="col-12 col-md-6 text-md-end">
                                    <a class="btn btn-sm btn-danger" href="{{ route('client.dashboard') }}">
                                        @lang('بازگشت')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        CKEDITOR.replace('myCKEditortextarea');
        $(function() {
            'use strict'

            if ($(".vira-select2").length) {
                $(".vira-select2").select2();
            }
        });
    </script>
@endsection
