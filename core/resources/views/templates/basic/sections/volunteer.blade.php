@php
    $volunteer = getContent('volunteer.content',true);
    $volunteers = App\Volunteer::where('status',1)->get();
@endphp
<!-- volunteer section start -->
    <section class="pt-150 pb-150">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="section-header text-center">
              <h2 class="section-title">{{__(@$volunteer->data_values->title)}}</h2>
              <p>{{__(@$volunteer->data_values->description)}}</p>
            </div>
          </div>
        </div>
        <div class="row mb-none-30">
        @foreach ($volunteers as $item)

        <div class="col-xl-3 col-sm-6 mb-30 wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
          <div class="volunteer-card hover--effect-1">
            <div class="volunteer-card__thumb">
              <img src="{{getImage(imagePath()['volunteer']['path'].'/'.$item->image)}}" alt="image" class="w-100">
            </div>
            <div class="volunteer-card__content">
              <img src="{{asset($activeTemplateTrue.'images/top-shape.png')}}" alt="image">
              <h4 class="name">{{$item->fullname}}</h4>
              <span class="designation">@lang("Participate {$item->participated} Campaigns")</span>
            </div>
          </div><!-- volunteer-card end -->
        </div>
        @endforeach

        </div>
      </div>
    </section>
    <!-- volunteer section end -->
