@php
    $content = getContent('cta.content',true);
    $texture = getContent('cta.element',true);

@endphp

<!-- cta section section start -->
<section class="pt-120 pb-150 position-relative bg_img overlay-one" data-background="{{get_image('assets/images/frontend/cta/'.$content->data_values->image)}}">
<div class="bottom-shape"><img src="{{asset($activeTemplateTrue.'images/top-shape.png')}}" alt="@lang('image')"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center pb-90">
        <h2 class="text-white">{{__($content->data_values->title)}}</h2>
          <p class="text-white">{{__($content->data_values->description)}}</p>
        <a href="{{route('volunteer')}}" class="cmn-btn mt-50">{{__($content->data_values->button_title)}}</a>
        </div>
      </div>
    </div>
  </section>
  <!-- cta section section end -->
