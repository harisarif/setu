@extends($activeTemplate.'layouts.master')
@section('content')

    <!-- dashboard section start -->
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row mb-none-30">

                @if ($campaign['expired'] > 0)
                    <div class="offset-lg-9 col-md-3">
                        <div class="alert alert-warning alert-dismissible fade show shadow text-center" role="alert">
                            <a href="{{route('user.fundrise.expired')}}" class="text-danger">
                              @lang('Campaign Expired') ({{ $campaign['expired'] }})
                            </a>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>

                @endif

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-one">
                        <div class="d-widget__icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">{{ $campaign['requested'] }}</h2>
                            <span class="caption text-white">@lang('Total Campaign')</span>
                        </div>
                        <a href="{{ route('user.fundrise.all') }}" class="view-btn">@lang('View all')</a>
                    </div><!-- d-widget end -->
                </div>

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-two">
                        <div class="d-widget__icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">{{ $general->cur_sym }}
                                {{ number_format($campaign['collectedFund'], 2) }}</h2>
                            <span class="caption text-white">@lang('Total Collected Fund')</span>
                        </div>

                    </div><!-- d-widget end -->
                </div>

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-three">
                        <div class="d-widget__icon">
                            <i class="fas fa-donate"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">{{ $campaign['donateLog'] }}</h2>
                            <span class="caption text-white">@lang('Total Donation')</span>
                        </div>
                        <a href="{{ route('user.donation.log') }}" class="view-btn">@lang('View all')</a>
                    </div><!-- d-widget end -->
                </div>
                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-four">
                        <div class="d-widget__icon">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">{{ $campaign['pending'] }}</h2>
                            <span class="caption text-white">@lang('Pending Campaign')</span>
                        </div>
                        <a href="{{ route('user.fundrise.pending') }}" class="view-btn">@lang('View all')</a>
                    </div><!-- d-widget end -->
                </div>

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-five">
                        <div class="d-widget__icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">{{ $campaign['completed'] }}</h2>
                            <span class="caption text-white">@lang('Campaign Completed')</span>
                        </div>
                        <a href="{{ route('user.fundrise.complete') }}" class="view-btn">@lang('View all')</a>
                    </div><!-- d-widget end -->
                </div>


                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-six">
                        <div class="d-widget__icon">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">{{ $campaign['rejectLog'] }}</h2>
                            <span class="caption text-white">@lang('Campaign Rejected')</span>
                        </div>
                        <a href="{{ route('user.fundrise.rejected') }}" class="view-btn">@lang('View all')</a>
                    </div><!-- d-widget end -->
                </div>


                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-seven">
                        <div class="d-widget__icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">{{ $general->cur_sym }}
                                {{ number_format($campaign['withdraw'], 2) }}</h2>
                            <span class="caption text-white">@lang('Total Withdraw')</span>
                        </div>
                        <a href="{{ route('user.withdraw.history') }}" class="view-btn">@lang('View all')</a>
                    </div><!-- d-widget end -->
                </div>


                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-eight">
                        <div class="d-widget__icon">
                            <i class="fab fa-btc"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white">{{ $general->cur_sym }}
                                {{ number_format($campaign['current_balance'], 2) }}</h2>
                            <span class="caption text-white">@lang('Current Balance')</span>
                        </div>

                    </div><!-- d-widget end -->
                </div>


                <div class="col-md-6 mb-30">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">@lang('Monthly Donation report')</h5>
                            <div id="apex-line"> </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-6 mb-30">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">@lang('Monthly Withdraw report')</h5>
                            <div id="apex-line-withdraw"></div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>
    <!-- dashboard section end -->

@endsection

@push('style')
    <style>
        .bttn {
            padding: 5px 35px;
            color: #16c26b;

        }

        .bttn:hover {
            background: #16c26b;
            padding: 5px 35px;
            border-radius: 5px;
            color: aliceblue;

        }

        .feature-card {
            min-width: 383px;
        }

    </style>
@endpush


@push('script')
    <script src="{{ asset($activeTemplateTrue . 'js/vendor/apexchart.js') }}" charset="utf-8"></script>
    <script>
        'use strict';
        // apex-line chart
        var options = {
            series: [{
                data: @json($donations['per_day_amount'])
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '15%',
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: @json($donations['per_day'])
            }
        };

        // withdraw Apex Chart

        var withdraw = {
            series: [{
                data: @json($withdraws['per_day_amount'])
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '10%',
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: @json($withdraws['per_day'])
            }
        };

        var chart = new ApexCharts(document.querySelector("#apex-line"), options);
        var chart2 = new ApexCharts(document.querySelector("#apex-line-withdraw"), withdraw);

        chart.render();
        chart2.render();

    </script>
@endpush
