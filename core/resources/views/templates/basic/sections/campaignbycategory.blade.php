@extends($activeTemplate.'layouts.frontend')
@php
    $data = getContent('campaign.content',true);    
@endphp

@section('content')
<section class="pt-90 pb-90">
    <div class="container">
    @if(0 == $campaigns->count())

    <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="section-header text-center">
          <h2 class="section-title">@lang('Sorry No Campaign Found') </h2>
            
          </div>
        </div>
      </div><!-- row end -->

    @else
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="section-header text-center">
          <h2 class="section-title">{{__($data->data_values->title)}}</h2>
            <p>{{__($data->data_values->description)}}</p>
          </div>
        </div>
      </div><!-- row end -->
      <div class="row mb-none-30">
        @foreach($campaigns as $campaign)
        <div class="col-lg-4 col-md-6 mb-30">
          <div class="event-card hover--effect-1 has-link">
            <a href="{{route('user.campaign.details',$campaign->slug)}}" class="item-link"></a>
            <div class="event-card__thumb">
              <img src="{{get_image(imagePath()['campaign']['path'].'/'.$campaign->image)}}" alt="image" class="w-100">
            </div>
            <div class="event-card__content">
            <h4 class="title">{{__($campaign->title)}}</h4>
              <span class="days-left mb-3 font-italic">{{Carbon\Carbon::parse($campaign->deadline)->diffInDays(Carbon\Carbon::now())}} @lang('Days Left')</span>
              <p>{{__(Str::limit($campaign->description,120))}}</p>
              <div class="event-bar-item">
                <div class="skill-bar">
                    @php 
                    $percent = ($campaign->donation->where('payment_status',1)->sum('donation') * 100) / $campaign->goal;
                  @endphp
                  <div class="progressbar" data-perc="{{$percent}}%">
                    <div class="bar"></div>
                  <span class="label">{{number_format($percent,2)}}%</span>
                  </div>
                </div>
              </div><!-- event-bar-item end -->
              <div class="amount-status">
                <div class="left">@lang('Raised') - <b>{{$general->cur_sym}} {{$campaign->donation->where('payment_status',1)->sum('donation')}}</b></div>
                <div class="right">@lang('Goal') - <b>{{$general->cur_sym}} {{$campaign->goal}}</b></div>
              </div>
            </div>
          </div><!-- event-card end -->
        </div>
@endforeach
      </div>

@endif
    </div>
  </section>
  <!-- event section end -->
    
@endsection

@push('script')
      <script>
        'use strict';
        
         $(".progressbar").each(function(){
	$(this).find(".bar").animate({
		"width": $(this).attr("data-perc")
	},3000);
	$(this).find(".label").animate({
		"left": $(this).attr("data-perc")
	},3000);
});
      </script>
@endpush


@push('style')
      
     <style>
        h4.title {
    min-height: 60px;
}
      </style>

@endpush 
