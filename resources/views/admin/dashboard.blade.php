@extends('includes.panel.base')
@section('page_title')
    @lang('داشبورد مدیریت')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row g-3">
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fa fa-users"></i>
                            @lang('مشتریان')
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted ">
                            @lang(':count مشتری', ['count' => $countClients])
                        </h6>
                        <a href="{{ route('admin.clients') }}">@lang('مشاهده')</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fa fa-users"></i>
                            @lang('فروشندگان')
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted ">
                            @lang(':count فروشنده', ['count' => $countMerchants])
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fa fa-users"></i>
                            @lang('کارمندان')
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted ">
                            @lang(':count کارمند', ['count' => $countSttafs])
                        </h6>
                        <a href="{{ route('admin.staffs') }}">@lang('مشاهده')</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fa fa-users"></i>
                            @lang('نمودار فروش سالانه')
                        </h5>
                        <canvas id="chartjsLine"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('panel/vendors/chartjs/Chart.min.js') }}"></script>
    <script>
        $(function() {
            'use strict';

            var colors = {
                primary: "#6571ff",
                secondary: "#7987a1",
                success: "#05a34a",
                info: "#66d1d1",
                warning: "#fbbc06",
                danger: "#ff3366",
                light: "#e9ecef",
                dark: "#060c17",
                muted: "#7987a1",
                gridBorder: "rgba(77, 138, 240, .15)",
                bodyColor: "#000",
                cardBg: "#fff"
            }

            var fontFamily = "'iransans', Helvetica, sans-serif"

            // Line Chart
            if ($('#chartjsLine').length) {
                new Chart($('#chartjsLine'), {
                    type: 'bar',
                    data: {
                        labels: [
                            @foreach ($sells2024 as $keyy => $valuee)
                                {{ $valuee->month }},
                            @endforeach
                        ],
                        datasets: [{
                            label: "2024",
                            type: "bar",
                            backgroundColor: colors.primary,
                            data: [
                                @foreach ($sells2024 as $keyy => $valuee)
                                    {{ $valuee->total_amount }},
                                @endforeach
                            ],
                        }]
                    },
                    options: {
                        plugins: {
                            tooltip: {
                                rtl: true
                            },
                            legend: {
                                display: true,
                                labels: {
                                    rtl: true,
                                    display: true,
                                    color: colors.bodyColor,
                                    font: {
                                        size: '13px',
                                        family: fontFamily
                                    }
                                }
                            },
                        },
                        scales: {
                            x: {
                                display: true,
                                grid: {
                                    display: true,
                                    color: colors.gridBorder,
                                    borderColor: colors.gridBorder,
                                },
                                ticks: {
                                    color: colors.bodyColor,
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            y: {
                                grid: {
                                    display: true,
                                    color: colors.gridBorder,
                                    borderColor: colors.gridBorder,
                                },
                                ticks: {
                                    color: colors.bodyColor,
                                    font: {
                                        size: 12
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection
