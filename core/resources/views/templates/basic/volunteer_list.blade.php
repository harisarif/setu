@extends($activeTemplate.'layouts.frontend')

@section('content')

    @php
    $volunteer = getContent('volunteer.content', true);
    @endphp


    <!-- volunteer section start -->
    <section class="pt-150 pb-150">
        <div class="container-fluid custom-container">
            <div class="filter_in_btn d-xl-none mb-4 d-flex justify-content-end">
                <a href="javascript:void(0)"><i class="las la-filter"></i></a>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="section-header text-center">
                        <h2 class="section-title">{{ __(@$volunteer->data_values->title) }}</h2>
                        <p>{{ __(@$volunteer->data_values->description) }}</p>
                    </div>
                </div>
            </div>
            <div class="row mb-none-30">

                <div class="col-xl-3">
                    <aside class="category-sidebar">
                        <div class="widget d-xl-none">
                            <div class="d-flex justify-content-between">
                                <h5 class="title border-0 pb-0 mb-0">@lang('Filter')</h5>
                                <div class="close-sidebar"><i class="las la-times"></i></div>
                            </div>
                        </div>

                        <div class="widget p-0">
                            <div class="widget-title">
                                <h5>@lang('Filter by Search')</h5>
                            </div>

                            <div class="widget-body">
                                <div class="widget-input-group">
                                    <label for="search">@lang('Search By Volunteer name') :</label>
                                    <input type="text" id="search" class="form-control"
                                        placeholder="@lang('volunteer name')">
                                </div>
                            </div>
                        </div>

                        <div class="widget p-0">
                            <div class="widget-title">
                                <h5>@lang('Filter by Country')</h5>
                            </div>
                            <div class="widget-body">
                                <div class="filter-color-area d-flex flex-wrap">

                                    <div class="row w-100">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="country">@lang('Country')</label>
                                                <select name="country" id="country" class="form-control w-100">
                                                    @foreach ($countries as $key => $country)
                                                        <option data-mobile_code="{{ $country->dial_code }}"
                                                            value="{{ $country->country }}"
                                                            data-code="{{ $key }}">
                                                            {{ __($country->country) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </aside>
                </div>

                <div class="col-md-9">

                    <div class="row search-filter">
                        @foreach ($volunteers as $item)
                            <div class="col-xl-3 col-sm-6 mb-30 ">
                                <div class="volunteer-card hover--effect-1">
                                    <div class="volunteer-card__thumb">
                                        <img src="{{ getImage(imagePath()['volunteer']['path'] . '/' . $item->image) }}"
                                            alt="image" class="w-100">
                                    </div>
                                    <div class="volunteer-card__content">
                                        <img src="{{ asset($activeTemplateTrue . 'images/top-shape.png') }}" alt="image">
                                        <h4 class="name">{{ $item->fullname }}</h4>
                                        <span class="designation">@lang("Participate {$item->participated}
                                            Campaigns")</span>
                                    </div>
                                </div><!-- volunteer-card end -->
                            </div>
                        @endforeach
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="py-4">
                                {{ $volunteers->links($activeTemplate . 'partials.paginate') }}
                            </div>
                        </div>
                    </div><!-- row end -->

                </div>



            </div>
        </div>
    </section>
    <!-- volunteer section end -->



@endsection



@push('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .widget-title {
            padding: 10px;
            background: #13c366;
            line-height: 1.5;
        }

        .widget-title h5 {
            color: #fff;
        }

        .widget-body {
            padding: 30px;
        }

        .day,
        .minute,
        .hour,
        .sec {
            width: 50px;
            height: 50px;
            border: 2px dashed mediumseagreen;
            border-radius: 50%;
            margin-right: 4px;
            text-align: center;
            font-weight: bolder;
            color: mediumseagreen;
        }

        .days-left>span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .feature {
            width: 150px;
            line-height: 35px;
            background: rgb(19 195 102);
            position: absolute;
            transform: rotate(321deg);
            top: 15px;
            left: -28px;
            text-align: center;
            color: aliceblue;
        }

        .top {
            width: 150px;
            line-height: 35px;
            background: rgb(19 195 102);
            position: absolute;
            transform: rotate(321deg);
            top: 15px;
            left: -28px;
            text-align: center;
            color: aliceblue;
        }

        .urgent {
            width: 150px;
            line-height: 35px;
            background: rgb(224 68 68);
            position: absolute;
            transform: rotate(321deg);
            top: 15px;
            left: -28px;
            text-align: center;
            color: aliceblue;
        }

        h4.title {
            min-height: 60px;
        }

        @media (max-width: 1359px) {

            .day,
            .minute,
            .hour,
            .sec {
                width: 50px;
                height: 50px;

            }

            .days-left>span {
                font-size: 14px;
            }
        }

        @media (max-width: 1199px) {

            .day,
            .minute,
            .hour,
            .sec {
                width: 44px;
                height: 44px;
            }

            .days-left>span {
                font-size: 14px;
            }
        }

        @media (max-width: 991px) {
            .urgent {
                font-size: 14px;
            }

            .feature {
                font-size: 14px;
            }

            .top {
                font-size: 14px;
            }
        }

        @media screen and (max-width:420px) {

            .day,
            .minute,
            .hour,
            .sec {
                width: 50px;
                height: 50px;

            }

            .days-left>span {
                font-size: 14px;
            }
        }


        @media screen and (max-width:374px) {

            .day,
            .minute,
            .hour,
            .sec {
                width: 40px;
                height: 40px;

            }

            .days-left>span {
                font-size: 12px;
            }
        }


        @media screen and (max-width:320px) {

            .day,
            .minute,
            .hour,
            .sec {
                width: 40px;
                height: 40px;
            }

            .days-left>span {
                font-size: 12px;
            }
        }

    </style>

@endpush

@push('script')
    <script>
        'use strict'
        $('#search').on('keyup', function() {
            var value = $(this).val();
            var mainView = '';
            $.ajax({
                method: 'GET',
                url: "{{ route('volunteer.search.filter') }}",
                data: {
                    search: value
                },
                success: function(response) {
                    if (response == '') {
                        $('.search-filter').html(mainView);
                        return 0;
                    }
                    $('.search-filter').html(response);

                }
            })
        })


        $('#country').on('change', function() {
            var value = $(this).val();
            var mainView = '';
            $.ajax({
                method: 'GET',
                url: "{{ route('volunteer.search.country') }}",
                data: {
                    search: value
                },
                success: function(response) {
                    if (response == '') {
                        $('.search-filter').html(mainView);
                        return 0;
                    }
                    $('.search-filter').html(response);

                }
            })
        })

    </script>
@endpush
