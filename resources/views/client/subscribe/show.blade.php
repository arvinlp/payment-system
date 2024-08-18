@extends('includes.panel.base')
@section('page_title')
    @lang('اطلاعات سرویس')
@endsection
@section('content')
    @include('includes.subscribe.' . $data->service->proxy)
@endsection
