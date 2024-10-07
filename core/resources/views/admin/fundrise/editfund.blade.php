@extends('admin.layouts.app')

@section('panel')

    <div class="row">
        <div class="col-lg-7 shadow p-2">
            <div class="event-details-wrapper">
                <div class="event-details-thumb">
                    <img src="{{ asset(imagePath()['campaign']['path'] . '/' . $campaign->image) }}" alt="@lang('image')">
                </div>
            </div><!-- event-details-wrapper end -->
            <div class="event-details-area mt-50">
                <ul class="nav nav-tabs nav-tabs--style" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab"
                            aria-controls="description" aria-selected="true">@lang('Description')</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab"
                            aria-controls="gallery" aria-selected="false">@lang('Relevent Image')</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video"
                            aria-selected="false">@lang('Relevent Document')</a>
                    </li>

                </ul>
                <div class="tab-content mt-4" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                        aria-labelledby="description-tab">
                        <p class="text-justify" id="description">{{ $campaign->description }}</p>

                    </div><!-- tab-pane end -->

                    <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                        <div class="row mb-none-30">
                            @foreach ($documents as $prof)

                                @if (explode('.', $prof)[1] == 'pdf')

                                @else

                                    <div class="col-lg-4 col-sm-6 mb-30">
                                        <div class="gallery-card">
                                            <a href="{{ asset(imagePath()['prof']['path'] . '/' . $prof) }}"
                                                class="view-btn" data-rel="lightcase:myCollection"><i
                                                    class="las la-plus"></i></a>
                                            <div class="gallery-card__thumb">
                                                <img src="{{ asset(imagePath()['prof']['path'] . '/' . $prof) }}"
                                                    alt="@lang('image')">
                                            </div>
                                        </div><!-- gallery-card end -->
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div><!-- tab-pane end -->

                    <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                        @foreach ($documents as $prof)

                            @if (explode('.', $prof)[1] == 'pdf')
                                <iframe width="100%" height="800"
                                    src="{{ asset(imagePath()['prof']['path'] . '/' . $prof) }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            @else

                            @endif
                        @endforeach


                    </div><!-- tab-pane end -->
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-lg-0 mt-5">
            <div class="donation-sidebar">
                <div class="donation-widget shadow">
                    <h3 class="pb-4">{{ $campaign->title }}</h3>
                    <div class="skill-bar mt-4">
                        <div class="progressbar" data-perc="{{ $percent >= 100 ? '100' : $percent }}%">
                            <div class="bar"></div>
                            <span class="label">{{ number_format($percent >= 100 ? '100' : $percent, 2) }}%</span>
                        </div>
                    </div>
                    <div class="row mt-2 justify-content-between">
                        <div class="col-sm-6">
                            <b>{{ number_format($percent >= 100 ? '100' : $percent, 2) }}%</b> @lang('Donated')
                        </div>
                        <div class="col-sm-6">
                            @lang('Goal Amount') <b>{{ $general->cur_sym }} {{ $campaign->goal }}</b>
                        </div>
                    </div>
                    <div class="row mt-50 mb-none-30">
                        <div class="col-6 donate-item text-center mb-30">
                            <h4 class="amount text-light">{{ $donor }}</h4>
                            <p class="text-light">@lang('Donors')</p>
                        </div>
                        <div class="col-6 donate-item text-center mb-30">
                            <h4 class="amount text-light">{{ $general->cur_sym }} {{ $donate }}</h4>
                            <p class="text-light">@lang('Donated')</p>
                        </div>
                    </div>
                </div><!-- donation-widget end -->


                <div class="donation-widget shadow">
                    <form class="vent-details-form">
                        <div class="form-group  col-md-12  col-sm-12 col-12">
                            <label class="form-control-label font-weight-bold">@lang('Make Featured')</label>
                            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                data-toggle="toggle" data-id="{{ $campaign->id }}" data-on="Featured"
                                data-off="Non Featured" name="tv" @if ($campaign->featured)
                            checked @endif
                            >
                        </div>
                    </form>
                </div><!-- donation-widget end -->


                <div class="donation-widget shadow">
                    <form class="vent-details-form">
                        <h3 class="mb-2">@lang('Category')</h3>
                        <div class="form-group col-lg-12">
                            <td><span class="badge badge-danger font-weight-normal">{{ $campaign->category->name }}</span>
                            </td>
                        </div>
                        <h3 class="mb-2">@lang('Deadline')</h3>
                        <div class="form-row align-items-center">
                            <div class="col-lg-12 form-group">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{ $campaign->deadline }}</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <h3 class="mb-2 mt-30">@lang('Personal Information')</h3>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold">@lang('Full Name') :</label>
                                <span class="text-light">{{ $campaign->user->firstname }}
                                    {{ $campaign->user->lastname }}</span>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold">@lang('Email') :</label>
                                <span class="text-light">{{ $campaign->user->email }} </span>
                            </div>

                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold">@lang('Mobile') :</label>
                                <span class="text-light">{{ $campaign->user->mobile }} </span>
                            </div>

                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold">@lang('Address') :</label>
                                <span class="text-light">{{ $campaign->address }} </span>
                            </div>


                        </div>
                    </form>
                </div><!-- donation-widget end -->
                @if (0 == $campaign->approval && $campaign->rejected == 0)
                    <div class="donation-widget offline-donate base--bg text-center">
                        <h3 class="text-dark">@lang('Do You Want to Approve')?</h3>

                        <div class="row mt-5">
                            <div class="col">
                                <a href="javascript:void(0)" class="btn btn--success approve"
                                    data-action={{ route('admin.fundrise.edit', ['slug' => $campaign->slug, 'id' => $campaign->id]) }}><i
                                        class="fa fa-check"></i> @lang('Approve')</a>
                            </div>
                            <div class="col">
                                <a href="javascript:void(0)" class="btn btn--danger reject"
                                    data-action={{ route('admin.fundrise.edit', ['slug' => $campaign->slug, 'id' => $campaign->id]) }}>
                                    <i class="fa fa-times"></i> @lang('Reject')</a>
                            </div>
                        </div>

                    </div><!-- donation-widget end -->
                @else

                    <div class="donation-widget shadow">
                        <h4 class="mb-4 text-light">@lang('Latest Donor')</h4>
                        <ul class="donor-small-list">
                            @if ($campaign->donation->count() == null)

                                <li class="single text-light">
                                    @lang('No Donation Found')
                                </li>

                            @else
                                @foreach ($donorList as $don)
                                    <li class="single">
                                        <div class="thumb"><i class="fa fa-user"></i></div>
                                        <div class="content">
                                            <h6 class="text-light">{{ $don->fullname }}</h6>
                                            <p class="text-light">@lang('Amount') : $ {{ $don->donation }}</p>
                                        </div>
                                    </li>
                                @endforeach

                                <div class=" mt-4 d-block">
                                    <a href="{{ route('admin.donor', ['campaign' => $campaign->slug, 'counter' => $campaign->id]) }}"
                                        class="btn btn-light">@lang('View All')</a>
                                </div>
                            @endif

                        </ul>
                    </div><!-- donation-widget end -->
                @endif


            </div>
        </div>
    </div>





    <!-- Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Approval Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        @lang('Are You Sure To Approve This Campaign') ?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal">@lang('Close')</button>
                    <form method="POST">
                        @csrf
                        <button type="submit" class="btn btn--primary">@lang('Approve')</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- Reject Modal --}}

    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reject Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        @lang('Are You Sure To Reject This Campaign') ?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal">@lang('Close')</button>
                    <form method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn--primary">@lang('Reject')</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('breadcrumb-plugins')
    <div class="d-flex flex-row-reverse bd-highlight ">
        <div class="p-2 bd-highlight">
            <a href="{{ url()->previous() }}" class="btn btn--primary"> <i class="fas fa-reply"></i> @lang('Back')</a>
        </div>

    </div>
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/animate.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .btn-primary {
            background: #7367F0;
            border: 1px solid #7367F0;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background: #7367F0;
            border: 1px solid #7367F0;
        }

        .input-group-text {
            background: none;
            border: none;
            color: #ffffff;
        }

        .badge-danger {
            padding: 8px 10px;
            border-radius: 10px;
        }

        .progressbar {
            position: relative;
            display: block;
            width: 100%;
            height: 10px;
            background-color: #eeeeee;
            border-radius: 999px;
            -webkit-border-radius: 999px;
            -moz-border-radius: 999px;
            -ms-border-radius: 999px;
            -o-border-radius: 999px;
        }

        .progressbar .bar {
            position: absolute;
            width: 0px;
            height: 100%;
            top: 0;
            left: 0;
            background: #13c366;
            overflow: hidden;
            border-radius: 999px;
            -webkit-border-radius: 999px;
            -moz-border-radius: 999px;
            -ms-border-radius: 999px;
            -o-border-radius: 999px;
        }

        .progressbar .label {
            position: absolute;
            top: -40px;
            left: 0;
            padding: 2px 8px;
            height: 30px;
            display: block;
            background-color: #ffffff;
            line-height: 28px;
            text-align: center;
            color: #7367F0;
            font-size: 14px;
            -webkit-transform: translateX(-22px);
            -ms-transform: translateX(-22px);
            transform: translateX(-22px);
            border-radius: 3px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            -ms-border-radius: 3px;
            -o-border-radius: 3px;
        }

        .progressbar .label::before {
            position: absolute;
            content: '';
            bottom: -10px;
            left: 50%;
            -webkit-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
            width: 10px;
            height: 10px;
            border-top: 6px solid #ffffff;
            border-bottom: 5px solid transparent;
            border-right: 5px solid transparent;
            border-left: 5px solid transparent;
            font-weight: 800;
        }

        /* event details css start */
        .event-details-wrapper {
            width: 75%;
            padding: 30px;
            background-color: #ffffff;
            border: 5px solid #f1f1f1;
        }

        @media (max-width: 767px) {
            .event-details-wrapper {
                padding: 15px;
            }
        }

        .event-details-thumb img {
            width: 100%;

        }

        .vent-details-form label {
            font-size: 14px;
            text-transform: uppercase;
        }

        .text-small {
            font-size: 12px !important;
        }

        .single-review {
            padding: 15px 0;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            border-bottom: 1px solid #e5e5e5;
        }

        .single-review:first-child {
            padding-top: 0;
        }

        .single-review:last-child {
            padding-bottom: 0;
            border-bottom: none;
        }

        .single-review .thumb {
            width: 120px;
        }

        .single-review .content {
            width: calc(100% - 120px);
            padding-left: 20px;
        }

        @media (max-width: 575px) {
            .single-review .content {
                width: 100%;
                padding-left: 0;
                margin-top: 20px;
            }
        }

        .single-review .ratings {
            float: right;
            margin-top: -28px;
        }

        @media (max-width: 575px) {
            .single-review .ratings {
                float: none;
                margin-top: 10px;
            }
        }

        .single-review .ratings i {
            color: #ffb560;
            font-size: 13px;
        }

        .single-review .date {
            font-size: 14px;
            font-style: italic;
        }

        .nav-tabs--style {
            border: none;
            margin: -3px -10px;
        }

        .nav-tabs--style .nav-item {
            margin: 3px 10px;
        }

        .nav-tabs--style .nav-item .nav-link {
            padding: 14px 30px;
            border: none;
            color: #6f6f6f;
            border-radius: 0;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            -ms-border-radius: 0;
            -o-border-radius: 0;
            position: relative;
            background-color: #f1f1f1;
        }

        .nav-tabs--style .nav-item .nav-link.active {
            background-color: #7367F0;
            color: #ffffff;
        }

        .donation-widget+.donation-widget {
            margin-top: 50px;
        }

        .donation-widget {
            padding: 40px 30px;
            background-color: #7367F0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            color: #ffffff;
        }

        .donation-widget h3 {
            color: #ffffff !important;
        }

        .donation-widget .donate-item {
            border-right: 1px solid #e5e5e5;
        }

        .donation-widget .donate-item:last-child {
            border-right: none;
        }

        .donation-widget .donate-item .amount {
            line-height: 1;
        }

        .donation-widget.offline-donate .mail-address {
            font-size: 24px;
        }

        .donor-small-list .single {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #e5e5e5;
        }

        .donor-small-list .single:first-child {
            padding-top: 0;
        }

        .donor-small-list .single:last-child {
            padding-bottom: 0;
            border-bottom: none;
        }

        .donor-small-list .single .thumb {
            width: 70px;
        }

        .donor-small-list .single .thumb img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            object-fit: cover;
            -o-object-fit: cover;
            object-position: center;
            -o-object-position: center;
        }

        .donor-small-list .single .content {
            width: calc(100% - 70px);
            padding-left: 20px;
        }

        .donor-small-list .single .content p {
            color: #13c366;
            font-size: 14px;
            text-transform: uppercase;
        }

        .gallery-card {
            position: relative;
        }

        .gallery-card:hover .view-btn {
            opacity: 1;
            visibility: visible;
        }

        .gallery-card .view-btn {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.65);
            color: #ffffff;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            font-size: 42px;
            opacity: 0;
            visibility: none;
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }

        .thumb i {
            color: #ffffff;
            font-size: 32px;
        }


        /* event details css end */

    </style>
@endpush


@push('script')
    <script src="{{ asset('assets/admin/js/vendor/lightcase.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/wow.js') }}"></script>

    <script>
        'use strict';

        $('a[data-rel^=lightcase]').lightcase();

        $(".progressbar").each(function() {
            $(this).find(".bar").animate({
                "width": $(this).attr("data-perc")
            }, 3000);
            $(this).find(".label").animate({
                "left": $(this).attr("data-perc")
            }, 3000);
        });

        new WOW().init();


        $('.approve').click(function() {
            $('#approveModal').attr('action', $(this).data('action'));
            $('#approveModal').modal('show');
        });


        $('.reject').click(function() {

            $('#rejectModal').attr('action', $(this).data('action'));
            $('#rejectModal').modal('show');
        });

        $("input[type=checkbox]").on('change', function() {

            var id = $(this).data('id');
            var status = 0
            if ($(this).prop('checked')) {
                status = 1;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                data: {
                    status: status,
                    id: id
                },
                url: "{{ route('admin.make.featured') }}",
                success: function(response) {
                    console.log(response);
                }
            })
        })

    </script>
@endpush
