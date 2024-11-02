{{-- Master Home Page --}}
@extends($activeTemplate.'layouts.frontend')

@section('content')
    @php
    $heroData = getContent('banner.element', false);

    $now = Carbon\Carbon::now();
    $category = App\Category::where('mode',1)->latest()->get();

    $campaignWithCategory = App\Category::whereHas('campaigns',function($q)use($now){$q->where('approval',1)->where('deadline','>', $now)->where('complete_status',0);})->where('mode',1)->latest()->get();

    @endphp


    <!-- hero-section start -->
    <section class="hero">
        <div class="hero__slider"  data-slick='{"autoplay": true, "autoplaySpeed": 1500}'>
            @foreach ($heroData as $hero)
                <div class="single__slide bg_img"
                    data-background="{{ asset('assets/images/frontend/banner/' . $hero->data_values->image) }}">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="hero__content text-center">
                                    <h2 class="hero__title" data-animation="fadeInUp" data-delay=".3s">{{ __($hero->data_values->title) }}</h2>
                                    <p data-animation="fadeInUp" data-delay=".5s">{{ __($hero->data_values->description) }}</p>
                                    <div class="btn-group mt-40" data-animation="fadeInUp" data-delay=".7s">
                                        <a href="{{ route('user.about') }}" class="cmn-btn">@lang('Learn More')</a>
                                        <a href="{{ route('user.campaigns') }}" class="cmn-btn">@lang('Explore Campaigns')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- single__slide end -->

            @endforeach
        </div><!-- hero__slider end -->
    </section>
    <!-- hero-section end -->





    <!-- category-section start -->
    <section class="pb-150 mt-minus-100">
        <div class="container">
            <div class=" mb-none-30 justify-content-center">
                <div class="responsive">
                    @foreach ($campaignWithCategory as $campaignCategory)
                        <div class="category-card has-link hover--effect-1 js-tilt {{ $loop->iteration % 3 == 0 ? 'overlay--three' : ($loop->odd ? 'overlay--one' : 'overlay--two') }}"
                            data-tilt-perspective="300" data-tilt-speed="400" data-tilt-max="25">
                            <a href="{{ route('user.campaigns', ['category' => $campaignCategory->name]) }}" class="item-link"></a>
                            <div class="category-card__thumb">
                                <img src="{{ asset(imagePath()['category']['path']) . '/' . $campaignCategory->icon }}" alt="image"
                                    class="w-100">
                            </div>
                            <div class="category-card__content">
                                <h4 class="title text-white">{{ __($campaignCategory->name) }}</h4>
                            </div>

                        </div>

                    @endforeach
                </div>

            </div>
        </div>
    </section>
    <!-- category-section end -->



    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $index => $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
@endsection

@push('style')
  <style>
    .category-card{
      margin: 0px 15px;
    }
    .responsive{
      overflow: hidden;
    }


  </style>
@endpush


@push('script')

        <script>
            'use strict';

            $(document).ready(function() {

                $('.responsive').slick({
                    autoplay: true,
                    dots: false,
                    arrows: false,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 3,
                    slidesToScroll: 4,
                    responsive: [{
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                                infinite: true,
                                dots: false
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                        // You can unslick at a given breakpoint now by adding:
                        // settings: "unslick"
                        // instead of a settings object
                    ]
                });
            });

        </script>

    @endpush
