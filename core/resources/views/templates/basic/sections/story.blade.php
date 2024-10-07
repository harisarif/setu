@php
    $content = getContent('story.content',true);
    $element = getContent('story.element',false);
    
@endphp
<!-- story section start -->
<section class="pt-150 pb-150">
    <div class="container">
      <div class="row no-gutters">
        
        <div class="col-lg-6">
          <div class="story-thumb">
            <div class="story-thumb-slider">
              @foreach($element as $el)
              <div class="single-slide">
              <img src="{{get_image('assets/images/frontend/story/'.$el->data_values->image)}}" alt="@lang('image')">
              </div>
              @endforeach
            </div>
          </div>
        </div>
        
        <div class="col-lg-6 right position-relative base--bg text-center">
        <div class="section-img"><img src="{{get_image($activeTemplateTrue.'images/texture-3.jpg')}}" alt="@lang('image')"></div>
          <div class="story-content">
          <h2 class="mb-50 text-white">{{__($content->data_values->heading)}}</h2>
            <div class="story-slider">
              @foreach($element as $el)
              <div class="single-slide">
              <h3 class="text-white mb-3">{{__($el->data_values->title)}}</h3>
              <p class="text-white">{{__($el->data_values->description)}}</p>
              </div><!-- single-slide end -->
            @endforeach
             
            </div><!-- story-slider end -->
          </div>
        </div>
      </div><!-- row end -->
    </div>
  </section>
  <!-- story section end -->