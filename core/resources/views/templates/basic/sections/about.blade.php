@php
 
    $about = getContent('about.content','true');
@endphp


<!-- about section start -->
<section class="pb-150 about-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="about-thumb pb-150">
          <div class="thumb-one wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s"><img src=" {{asset('assets/images/frontend/about/'.$about->data_values->image)}}" alt="@lang('image')" class="w-100"></div>
           
          </div>
        </div>
        <div class="col-lg-6 mt-lg-0 mt-5 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s">
          <div class="section-content pl-lg-4 pl-0">
          <h2 class="section-title mb-20">{{__($about->data_values->heading)}}</h2>
            <p><?php echo __($about->data_values->description) ?></p>
           
            <div class="btn-group justify-content-start mt-30">
            <a href="{{route('user.about')}}" class="cmn-btn">@lang('Learn More')</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- about section end -->


  @push('style')
    <style>
      
      .about-section{
        padding-bottom: 0px;
      }  
      
    </style>  
  @endpush