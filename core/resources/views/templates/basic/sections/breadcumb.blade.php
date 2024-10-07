@php
    $data = getContent('breadcumb.content',true);
    $texture = getContent('breadcumb.element',true);

@endphp
 <!-- inner-page-hero start -->
<section class="inner-page-hero bg_img" data-background="{{get_image('assets/images/frontend/breadcumb/'.@$data->data_values->image)}}">
    <div class="bottom-shape"><img src="{{asset($activeTemplateTrue.'images/top-shape.png')}}" alt="@lang('image')"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
        <h2 class="page-title">{{__($page_title)}}</h2>
          <ul class="page-list justify-content-center">
          <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
          <li class="active">{{__($page_title)}}</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- inner-page-hero end -->
