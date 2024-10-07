@extends($activeTemplate.'layouts.frontend')
@php
    $about = getContent('about.content','true');
    $aboutel = getContent('about.element',false);
    $team = getContent('team.content',true);
@endphp

@section('content')

<!-- about section start -->
<section class="pb-0 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="about-thumb pb-150">
          <div class="thumb-one wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s"><img src=" {{get_image('assets/images/frontend/about/'.$about->data_values->image)}}" alt="@lang('image')" class="w-100"></div>
           
          </div>
        </div>
        <div class="col-lg-6 mt-lg-0 mt-5 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s">
          <div class="section-content pl-lg-4 pl-0">
            <h2 class="section-title mb-20">{{__($about->data_values->heading)}}</h2>
            <p>@php echo __($about->data_values->description) @endphp</p>
            
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- about section end -->


<!-- mission vission section start -->
<section class="pt-150 pb-150 section--bg">
    <div class="container">
    @foreach($aboutel as $about)
      <div class="row">
      <div class="{{$loop->odd ? 'col-lg-6 order-lg-2 order-2 mt-lg-0':'col-lg-6 order-lg-2 order-1'}}">
      <div class="{{$loop->odd ? 'section-content pl-lg-4':'section-content pl-lg'}}">
          <h2 class="section-title mb-20">{{__($about->data_values->heading)}}</h2>
          <p class="text-justify"> @php echo  __($about->data_values->description) @endphp </p>
          </div><!-- section-content end -->
        </div>
    <div class="{{$loop->odd ? 'col-lg-6 order-lg-2 order-1':'col-lg-6 order-1'}}">
        <img src="{{get_image('assets/images/frontend/about/'.$about->data_values->image)}}" alt="@lang('image')" class="w-100">
        </div>
      </div><!-- row end -->
    @endforeach

     
    </div>
  </section>
  <!-- mission vission section end -->

@endsection


@push('style')
  <style>
      .order-1{
        margin-bottom:90px !important;  
      }
    .pb-150 .container .row:nth-child(3) {
      display: none;
    }
    .pb-150 .container .row:nth-child(4) {
      display: none;
    }
    
  </style>    
@endpush