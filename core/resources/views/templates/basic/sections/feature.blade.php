@php

    $content = getContent('feature.content',true);
    $element = getContent('feature.element',false);
@endphp
<!-- feature section start -->
<section class="pt-90 pb-150 position-relative">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4 text-lg-left text-center">
          <div class="section-header">
          <h2 class="section-title">{{__($content->data_values->heading)}}</h2>
          <p>{{__($content->data_values->sub_heading)}}</p>
          </div>
        </div><!-- row end -->
        <div class="col-lg-8">
          <div class="row">
        @foreach($element as $el)
            <div class="col-lg-6 col-md-6 mb-30 wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
              <div class="feature-card">
              <div class="feature-card__icon"><?= $el->data_values->icon ?></div>
                <div class="feature-card__content">
                <h4 class="title">{{__($el->data_values->title)}}</h4>
                <p>{{__($el->data_values->description)}}</p>
                </div>
              </div>
            </div><!-- feature-card end -->
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- feature section end -->