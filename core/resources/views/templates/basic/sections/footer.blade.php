@php
     $data = getContent('footer.content',true);
     $icon = getContent('social_icon.element',false);
     $policy = getContent('terms.element',false);
     $newsletter = getContent('newsletter.content',true);
     $contact = getContent('contact_us.content',true);

@endphp


<!-- footer section start -->
<footer class="footer-section base--bg position-relative bg_img" data-background="{{get_image('assets/images/frontend/footer/'.$data->data_values->image)}}">
<div class="top-shape"><img src="{{get_image($activeTemplateTrue.'images/top_texture.png')}}" alt="@lang('image')"></div>
    <div class="footer-top">
      <div class="container">
        <div class="row mb-30 align-items-center">
          <div class="col-lg-2 mb-lg-0 mb-5 text-lg-left text-center">
          <a href="#0" class="footer-logo"><img src="{{get_image(imagePath()['logoIcon']['path'].'/'.'logo.png')}}" alt="@lang('image')"></a>
          </div>
          <div class="col-lg-7 col-md-7">
            <div class="row justify-content-center mb-none-30">
              <div class="col-xl-4 col-sm-6 footer-overview-item text-md-left text-center mb-30">
              <h3 class="text-white amount-number text-center">{{App\Donation::where('payment_status',1)->count()}}</h3>
                <p class="text-white text-center">@lang('Total Donate Members')</p>
              </div><!-- footer-overview-item end -->
              <div class="col-xl-4 col-sm-6 footer-overview-item text-md-left text-center mb-30">
                <h3 class="text-white amount-number text-center">{{App\Campaign::where('approval',1)->where('rejected',0)->count()}}</h3>
                <p class="text-white text-center">@lang('Total Campaigns')</p>
              </div><!-- footer-overview-item end -->

              <div class="col-xl-4 col-sm-6 footer-overview-item text-md-left text-center mb-30">
                <h3 class="text-white amount-number text-center">{{$general->cur_sym}} {{App\Donation::where('payment_status',1)->sum('donation')}}</h3>
                <p class="text-white text-center">@lang('Donation Raised')</p>
              </div><!-- footer-overview-item end -->

            </div>
          </div>
          <div class="col-lg-3 col-md-5 mt-md-0 mt-4">
            <div class="text-md-right text-center">
            <a href="{{route('user.campaigns')}}" class="cmn-btn">@lang('Donate Now')</a>
            </div>
          </div>
        </div>
        <hr>
        <div class="row mt-50 mb-none-30 justify-content-center">
          <div class="col-lg-3 col-md-6 col-sm-8 mb-50">
            <div class="footer-widget">
            <h3 class="footer-widget__title">{{__($data->data_values->title)}}</h3>
              <p>{{__($data->data_values->description)}}</p>
              <ul class="social-links mt-4">
                @foreach($icon as $ic)
              <li><a href="{{$ic->data_values->url}}"><?= $ic->data_values->icon ?></a></li>
                @endforeach
              </ul>
              <ul class="company-info-list mt-3">
              <li><a href="tel:{{$contact->data_values->contact_number}}">{{$contact->data_values->contact_number}}</a></li>
              <li><a href="mailto:{{$contact->data_values->email_address}}">{{$contact->data_values->email_address}}</a></li>
              </ul>
            </div><!-- footer-widget end -->
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 mb-50">
            <div class="footer-widget">
              <h3 class="footer-widget__title">@lang('Our Info')</h3>
              <ul class="short-link-list">
              <li><a href="{{route('user.about')}}">@lang('About Us')</a></li>
              <li><a href="{{route('user.about')}}">@lang('Our Mission')</a></li>
              <li><a href="{{route('user.about')}}">@lang('Our Vision')</a></li>
              </ul>
            </div><!-- footer-widget end -->
          </div>
          <div class="col-lg-2 col-md-3 col-sm-6 mb-50">
            <div class="footer-widget">
            <h3 class="footer-widget__title">@lang('Latest Category')</h3>
              <ul class="short-link-list">
                @foreach(App\Category::whereHas('campaigns',function($q){$q->where('approval',1)->where('expired',0);})->where('mode',1)->latest()->take(3)->get() as $cat)
              <li><a href="{{route('user.campaigns',['category'=>$cat->slug])}}">{{$cat->name}}</a></li>
                
                @endforeach
              </ul>
            </div><!-- footer-widget end -->
          </div>
          <div class="col-lg-2 col-md-6 col-sm-6 mb-50">
            <div class="footer-widget">
              <h3 class="footer-widget__title">@lang('Short Links')</h3>
              <ul class="short-link-list">
              <li><a href="{{route('user.register')}}">@lang('Join With Us')</a></li>
              <li><a href="{{route('user.success.archive')}}">@lang('Our Latest News')</a></li>
              <li><a href="{{route('user.campaigns')}}">@lang('Make Donation')</a></li>
             
              </ul>
            </div><!-- footer-widget end -->
          </div>
          <div class="col-lg-3 col-md-6 mb-50">
            <div class="footer-widget">
              <h3 class="footer-widget__title">{{__($newsletter->data_values->heading)}}</h3>
              <p>{{__($newsletter->data_values->sub_heading)}}</p>
            <form class="subscribe-form mt-3" method="POST" action="{{route('user.subscribe')}}">
                @csrf
                <input type="email" name="email" placeholder="Email Address" class="form-control">
                <button type="submit" id="subscribe"><i class="las la-arrow-right"></i></button>
              </form>
            </div><!-- footer-widget end -->
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <hr>
        <div class="row">
          <div class="col-lg-8 col-md-6 text-md-left text-center">
            <p>@lang('Copyright') © {{\Carbon\Carbon::now()->format('Y')}} | @lang('All Rights Reserved')</p>
          </div>
          <div class="col-lg-4 col-md-6 mt-md-0 mt-3">
            <ul class="link-list justify-content-md-end justify-content-center">
              @foreach($policy as $pol)
            <li><a href="{{route('user.site',$pol->data_values->pagename)}}">{{$pol->data_values->pagename}}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer section end -->


  @push('script')
      <script>
        'use strict';

        $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });


        $(function(){
          

          $('#subscribe').on('click',function(event) {
            event.preventDefault();
            var email = $('input[name=email]').val();
            
              $.ajax({
                      method:'POST',
                      url:"{{route('user.subscribe')}}",
                      data:{email:email},
                      success:function(response){
                          if(response.fails){
                                iziToast.error({
                                message: response.errorMsg.email,
                                position: "topRight"
                            });
                            }

                            if (response.success) {
                                iziToast.success({
                                message: response.successMsg,
                                position: "topRight"
                            });
                            }
                      }
                })
          })


        })
      </script>
  @endpush