@extends('includes.panel.base')
@section('page_title')
    @lang('داشبورد کاربری')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row g-3">
            
            <div class="col-lg-4 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">@lang('سرویس‌های فعال من')</h6>
                        </div>
                        <div class="d-flex flex-column">
                            @if (isset($subscribes))
                                @foreach ($subscribes as $item)
                                    <a href="{{ route('client.show_account',['id'=>$item->id]) }}" class="d-flex align-items-center border-bottom py-3">
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="text-body mb-2">@lang('سرویس') : {{ $item->service->name }}</h6>
                                            </div>
                                            <div class="text-primary tx-13">
                                                @lang('نام کاربری') : {{ $item->username }}<br>
                                                @lang('تاریخ انقضا') : {{ dateShow($item->expire_date, '%Y/%m/%d') }}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div class="d-flex align-items-center border-bottom pb-3">
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-body text-mute">@lang('سرویس فعالی جهت نمایش وجود ندارد.')</h6>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">@lang('تابلو اعلانات')</h6>
                        </div>
                        <div class="d-flex flex-column">
                            @if (isset($notifications))
                                @foreach ($notifications as $item)
                                    <div class="d-flex align-items-center border-bottom py-3">
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="text-body mb-2">{{ $item->title }}</h6>
                                                <p class="text-muted tx-12">{{ dateShow($item->updated_at, '%Y/%m/%d') }}
                                                </p>
                                            </div>
                                            <div class="text-{{ $item->type }} tx-13">{!! $item->content !!}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex align-items-center border-bottom pb-3">
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-body text-mute">@lang('اعلانی جهت نمایش وجود ندارد.')</h6>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">@lang('میز پشتیبانی')</h6>
                        </div>
                        <div class="d-flex flex-column">
                            @if (isset($supports))
                                @foreach ($supports as $item)
                                    <div class="d-flex align-items-center border-bottom py-3">
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="text-body mb-2">{{ $item->subject }}</h6>
                                                <p class="text-muted tx-12">
                                                    {{ dateShow($item->updated_at, '%Y/%m/%d H:m') }}</p>
                                            </div>
                                            <div class="text-{{ $item->type }} tx-13">{!! $item->content !!}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex align-items-center pb-3">
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-body text-mute">@lang('درخواست پشتیبانی باز جهت نمایش وجود ندارد.')</h6>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
