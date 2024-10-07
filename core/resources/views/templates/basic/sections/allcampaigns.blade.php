@extends($activeTemplate.'layouts.frontend')
@php
$data = getContent('campaign.content',true);

@endphp

@section('content')

    {{-- Urgent Fundrised --}}
    <section class="pt-90 pb-90">
        <div class="container-fluid custom-container">
            <div class="row m-0">
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
                                    <label for="search">@lang('Search By Campaign Name') :</label>
                                    <input type="text" id="search" class="form-control" placeholder="@lang('campaign name')">
                                </div>
                            </div>
                        </div>

                         <div class="widget p-0">
                             <div class="widget-title">
                                 <h5>@lang('Filter Campaign')</h5>
                             </div>
                            <div class="widget-body">
                                <div class="widget-input-group">
                                    <input type="radio" id="check_size-xs_1" class="check_size_xs" value="urgent">
                                    <label for="check_size_xs_1">@lang('Urgent Campaigns')</label>
                                </div>

                                <div class="widget-input-group">
                                    <input type="radio"  id="check_size-xs_2" class="check_size_xs" value="feature">
                                    <label for="check_size_xs_2">@lang('Featured Campaigns')</label>
                                </div>

                                <div class="widget-input-group">
                                    <input type="radio" id="check_size-xs_3" class="check_size_xs" value="top">
                                    <label for="check_size_xs_3">@lang('Top Campaigns')</label>
                                </div>
                            </div>
                        </div>


                        <div class="widget p-0">
                            <div class="widget-title">
                                <h5>@lang('Filter by Category')</h5>
                            </div>
                            <div class="widget-body">
                                <ul class="filter-category">
                                    <li>
                                        <a href="#0"><i class="las la-angle-double-left"></i> @lang('All Category')</a>
                                    </li>
                                    <li>
                                        @foreach($category as $cat)
                                            <a href="javascript:void(0)" class="categoryId" data-id="{{$cat->id}}" data-url="{{route('user.campaign.filter',$cat->id)}}">
                                                <i class="las la-angle-left"></i> 
                                                {{__($cat->name)}}
                                            </a>
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                     
                        <div class="widget p-0">
                            <div class="widget-title">
                                <h5>@lang('Filter by Date')</h5>
                            </div>
                            <div class="widget-body">
                                <div class="filter-color-area d-flex flex-wrap">
                                   
                                    <div class="row w-100">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="datepicker">@lang('From Date')</label>
                                                <input type="text" class="form-control" id="datepicker" placeholder="From Date" autocomplete="off">
                                            </div>
                                        </div>

                                    </div>
                                 
                                </div>
                            </div>
                        </div>
                        
                    </aside>
                </div>
                <div class="col-xl-9">
                    <div class="filter_in_btn d-xl-none mb-5 d-flex justify-content-end">
                            <a href="javascript:void(0)"><i class="las la-filter"></i></a>
                    </div>

                    <div class="d-flex flex-wrap justify-content-start align-items-center filter_tab_menu_wrapper main-view">
                        
                            @forelse ($campaigns as $campaign)
                                <div class="col-lg-4 col-md-6 mb-30">
                                    <div class="event-card hover--effect-1 has-link">
                                        <div class="feature">@lang('Latest')</div>
                                        <a href="{{ route('user.campaign.details', ['slug' => $campaign->slug, 'id' => $campaign->id]) }}"
                                            class="item-link"></a>
                                        <div class="event-card__thumb">
                                            <img src="{{ get_image(imagePath()['campaign']['path'] . '/' . $campaign->image) }}" alt="image"
                                                class="w-100">
                                        </div>
                                        <div class="event-card__content">
                                            <h4 class="title">{{ __(Str::limit($campaign->title, 50)) }}</h4>
                                            <span class="days-left mb-3 font-italic" data-deadline={{ $campaign->deadline }}>
                                                <span class="day"></span>
                                                <span class="hour"></span>
                                                <span class="minute"></span>
                                                <span class="sec"></span>

                                            </span>
                                            <p>{{ __(Str::limit($campaign->description, 120)) }}</p>
                                            <div class="event-bar-item">
                                                <div class="skill-bar">
                                                    @php
                                                    $percent = ($campaign->donation->where('payment_status',1)->sum('donation') * 100) /
                                                    $campaign->goal;
                                                    @endphp
                                                    <div class="progressbar" data-perc="{{ $percent > 100 ? '100' : $percent }}%">
                                                        <div class="bar"></div>
                                                        <span
                                                            class="label">{{ number_format($percent > 100 ? '100' : $percent, 2) }}%</span>
                                                    </div>
                                                </div>
                                            </div><!-- event-bar-item end -->
                                            <div class="amount-status">
                                                <div class="left">@lang('Raised -') <b>{{ $general->cur_sym }}
                                                        {{ $campaign->donation->where('payment_status', 1)->sum('donation') }}</b></div>
                                                <div class="right">@lang('Goal -') <b>{{ $general->cur_sym }} {{ $campaign->goal }}</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- event-card end -->
                                </div>
                             @empty


                            <div class="col-md-6 mx-auto">
                                <div class="card shadow">

                                    <div class="card-header text-center bg-success">
                                        <h4 class="text-white"><i class="text-white far fa-sad-cry"></i> @lang('Upps No Campaign Found ') <i class="text-white far fa-sad-cry"></i></h4>
                                    </div>

                                    <div class="card-body text-center py-5">
                                        <a href="{{url()->previous()}}" class="text-white btn btn-success">@lang('back To Previous')</a>
                                    </div>

                                </div>
                            </div>
                                    
                               
                            @endforelse


                            
                        
                        
                    </div>
                    
                </div>
            </div>
        
    
    <!-- Urgent Fundrise -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="py-4">
                        {{ $campaigns->links($activeTemplate . 'partials.paginate') }}
                    </div>
                </div>
            </div><!-- row end -->
        </div>
    </section>
    <!-- event section end -->

@endsection

@push('script')
    <script>
        'use strict';

        var mainViewAll = $('.main-view').html();

        var mainView = `

                <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-header text-center bg-success">
                                    <h4 class="text-white"><i class="text-white far fa-sad-cry"></i> @lang('Upps No Campaign Found ') <i class="text-white far fa-sad-cry"></i></h4>
                                </div>
                                <div class="card-body text-center py-5">
                                    <a href="" class="text-white btn btn-success">@lang('Show All Campaigns')</a>
                                </div>
                            </div>
                </div>


        `;

        var arrayFilter = [];
        var filter = [];
        $(".progressbar").each(function() {
            $(this).find(".bar").animate({
                "width": $(this).attr("data-perc")
            }, 3000);
            $(this).find(".label").animate({
                "left": $(this).attr("data-perc")
            }, 3000);
        });


        var tempTime = 0;
        var x = setInterval(function() {
            var deadline = $('.days-left').each(function(item) {
               
                var countDownDate = new Date($(this).data('deadline')).getTime();

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                tempTime = seconds;

               
                $(this).children('.day').text(days + 'D');
                $(this).children('.hour').text(hours + 'H');
                $(this).children('.minute').text(minutes + 'M');
                $(this).children('.sec').text(seconds + 'S');

            });

             if (tempTime < 0) {
                    clearInterval(x);
                    $('.days-left').html(`<span class="text-danger">Exprired</span>`);
            }
            
        }, 1000);

        //  If the count down is finished, write some text

    $(".check_size_xs").on('change',function(){
        var arrayFilter = $(this).val();

        $('.check_size_xs').prop('checked',false);
        
        $(this).prop('checked',true);

            if($(this).prop('checked')){
                 $.ajax({
                   method:"GET",
                   url:"{{route('user.checkbox.filter')}}",
                   data:{filter:arrayFilter},
                   success:function(response){
                      if(response == ''){
                            $('.main-view').html(mainView);
                            return 0;
                    }

                    $('.main-view').html(response);
                   }
               });

               return 0;
            }
            
            if($(this).prop('checked') == false){
                $('.main-view').html(mainViewAll);
            }
            
           
        })

           

    </script>
@endpush


@push('style')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .widget-title{
            padding: 10px;
            background: #13c366;
            line-height: 1.5;
        }

        .widget-title h5{
            color:#fff;
        }
        .widget-body{
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
    'use strict';
    
    $( function() {
        var mainView = `

                <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-header text-center bg-success">
                                    <h4 class="text-white"><i class="text-white far fa-sad-cry"></i> @lang('Upps No Campaign Found ') <i class="text-white far fa-sad-cry"></i></h4>
                                </div>
                                <div class="card-body text-center py-5">
                                    <a href="" class="text-white btn btn-success">@lang('Show All Campaigns')</a>
                                </div>
                            </div>
                </div>


        `;


        $( "#datepicker" ).datepicker({minDate:-"{{$minDate}}",maxDate:"+0D"});
        
        $( "#slider-range" ).slider({
        range: true,
        min: {{$priceCampaign['min']}},
        max: {{$priceCampaign['max']}},
        values: [ {{$priceCampaign['min']}} , {{$priceCampaign['max']}} ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            var amount = $('#amount').val();
            $.ajax({
                method:"GET",
                url:"{{route('user.price.filter')}}",
                data:{amount:amount},
                success:function(response){

                    if(response == ''){
                            $('.main-view').html(mainView);
                            return 0;
                    }

                    $('.main-view').html(response);
                }
            })
        }
        });
        $( "#amount" ).val( "{{$general->cur_sym}}" + $( "#slider-range" ).slider( "values", 0 ) + " - {{$general->cur_sym}}" + $( "#slider-range" ).slider( "values", 1 ) );

        $('#search').on('keyup',function(){
            var value = $(this).val();
            
             $.ajax({
                        method:'GET',
                        url:"{{route('user.search.filter')}}",
                        data:{search:value},
                        success:function(response){
                        
                        if(response == ''){
                            $('.main-view').html(mainView);
                            return 0;
                        }
                         $('.main-view').html(response);
                        
                        }
                    })
        })

        $('.categoryId').each(function(index){
            $(this).on('click',function(){
                var id = $(this).data('id');
                var url = $(this).data('url');
                $.ajax({
                        method:'GET',
                        url:url,
                        data:{id:id},
                        success:function(response){
                        if(response == ''){
                            $('.main-view').html(mainView);
                            return 0;
                        }
                        $('.main-view').html(response);
                        
                        }
                    })
                });
            });


        $('#datepicker').on('change',function(){
            var date = $(this).val();

            $.ajax({
                method:'GET',
                url:"{{route('user.date.filter')}}",
                data:{date:date},
                success:function(response){
                    if(response == ''){
                            $('.main-view').html(mainView);
                            return 0;
                        }
                        $('.main-view').html(response);
                }
            })
        })
        
    });
</script>    
@endpush