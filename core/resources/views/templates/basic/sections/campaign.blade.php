@php
    $data = getContent('campaign.content',true);
    $now = Carbon\Carbon::now();

    $campaign = App\Campaign::where('stop_status',0)->where('approval',1)->where('complete_status',0)->where('deadline','>',$now)->latest()->take(6)->get();

@endphp
<!-- event section start -->
<section class="pt-150 pb-150 position-relative base--bg">
    <div class="section-img"><img src="{{get_image($activeTemplateTrue.'images/texture-3.jpg')}}" alt="@lang('image')"></div>
    <div class="bottom-shape"><img src="{{asset($activeTemplateTrue.'images/top-shape.png')}}" alt="@lang('image')"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-8">
          <div class="section-header text-center">
          <h2 class="section-title text-white">{{__($data->data_values->title)}}</h2>
          <p class="text-white">{{__($data->data_values->description)}}</p>
          </div>
        </div>
      </div><!-- row end -->
      <div class="row mb-none-30">
        @foreach($campaign as $camp)
        <div class="col-lg-4 col-md-6 mb-30">
          <div class="event-card hover--effect-1 has-link">
          <a href="{{route('user.campaign.details',['slug' => $camp->slug, 'id' => $camp->id])}}" class="item-link"></a>
            <div class="event-card__thumb">
            <img src="{{get_image(imagePath()['campaign']['path'].'/'.$camp->image)}}" alt="@lang('image')" class="w-100">
            </div>
            <div class="event-card__content">
            <h4 class="title">{{Str::limit($camp->title,50)}}</h4>

            <span class="days-left mb-3 font-italic" data-deadline = {{$camp->deadline}}>
              <span class="day"></span>
              <span class="hour"></span>
              <span class="minute"></span>
              <span class="sec"></span>

            </span>
              <p class="text-justify">{{Str::limit($camp->description,120)}}</p>
              <div class="event-bar-item">
                <div class="skill-bar">
                  @php
                    $percent = ($camp->donation->where('payment_status',1)->sum('donation') * 100) / $camp->goal;
                  @endphp
                  <div class="progressbar" data-perc="{{$percent > 100 ? '100': $percent}}%">
                    <div class="bar"></div>
                    <span class="label">{{number_format(($percent > 100 ? '100': $percent),2)}}%</span>
                  </div>
                </div>
              </div><!-- event-bar-item end -->
              <div class="amount-status">
              <div class="left">@lang('Raised') - <b>{{$general->cur_sym}}  {{$camp->donation->where('payment_status',1)->sum('donation')}}</b></div>
              <div class="right">@lang('Goal') - <b>{{$general->cur_sym}} {{$camp->goal}}</b></div>
              </div>
            </div>
          </div><!-- event-card end -->
        </div>
    @endforeach

       <div class="col-md-12 mb-5 text-center">
       <a href="{{route('user.campaigns')}}" class="cmn-btn">@lang('Show All Campaign')</a>
       </div>
      </div>

    </div>
  </section>
  <!-- event section end -->


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


        var x = setInterval(function() {
          console.log('a');
          var deadline = $('.days-left').each(function(item){

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
              $(this).children('.day').text(days + 'D');
              $(this).children('.hour').text(hours + 'H');
              $(this).children('.minute').text(minutes + 'M');
              $(this).children('.sec').text(seconds + 'S');

              if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                  }

              });
                            // If the count down is finished, write some text

                }, 1000);


      </script>
@endpush


@push('style')

     <style>

       .btn--primary{
         background: #ffffff;
         margin-left: 50%;
         transform: translate(-50%, 30%);
       }
        h4.title {
          min-height: 60px;
        }

        .day{
          width: 50px;
          height: 50px;
          border: 2px dashed mediumseagreen;
          border-radius: 50%;
          margin-right: 4px;
          text-align: center;
          font-weight: bolder;
          color: mediumseagreen;
        }

        .hour{
          width: 50px;
          height: 50px;
          border: 2px dashed mediumseagreen;
          border-radius: 50%;
          margin-right: 4px;
          text-align: center;
          font-weight: bolder;
          color: mediumseagreen;
        }
        .minute{
          width: 50px;
          height: 50px;
          border: 2px dashed mediumseagreen;
          border-radius: 50%;
          margin-right: 4px;
          text-align: center;
          font-weight: bolder;
          color: mediumseagreen;
        }
        .sec{
          width: 50px;
          height: 50px;
          border: 2px dashed mediumseagreen;
          border-radius: 50%;
          margin-right: 4px;
          text-align: center;
          font-weight: bolder;
          color: mediumseagreen;
        }
        .days-left > span {
          display: inline-flex;
          align-items: center;
          justify-content: center;
        }
      </style>

@endpush
