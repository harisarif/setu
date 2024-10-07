@php
    $data = getContent('blog.content',true);
    $blog = App\SuccessStory::latest()->get();
    
@endphp


<!-- blog section start -->
<section class="pb-90 margin-top-120">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="section-header text-center">
          <h2 class="section-title">{{__($data->data_values->heading)}}</h2>
          <p> {{__($data->data_values->sub_heading)}}</p>
          </div>
        </div>
      </div><!-- row end -->
      <div class="row blog-slider mb-none-30 justify-content-center">
        @foreach($blog as $single)
         <div class="col-lg-12 col-md-6 mb-30 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
            <div class="blog-post hover--effect-1 has-link">
              <a href="{{route('user.success.details',['slug'=>$single->slug,'id'=>$single->id])}}" class="item-link"></a>
              <div class="blog-post__thumb">
                 <img src="{{get_image(imagePath()['success']['path'].'/'.$single->image)}}" alt="@lang('image')" class="w-100">
              </div>
              <div class="blog-post__content">
                <ul class="blog-post__meta mb-3">
                  <li>
                     <a href="#0">@lang('Post by admin')</a>
                  </li>
                  <li>
                    <i class="las la-calendar-day"></i>
                    <span>{{$single->created_at->toFormattedDateString()}}</span>
                  </li>
                </ul>
                <h4 class="blog-post__title">{{Str::limit($single->title,25)}}</h4>
                <div class="wrap text-justify">@php echo  __(shortDescription($single->short_description,100)) @endphp</div>
                <i class="blog-post__icon las la-arrow-right"></i>
              </div>
            </div>
        </div><!-- blog-post end -->
        @endforeach
        
        
      </div>
    </div>
  </section>
  <!-- blog section end -->


  @push('script')
      <script>
        'use strict';
        
        $(document).ready(function(){
          $('.wrap').children('*').removeAttr('style');
          $('.wrap').children('*').children('*').removeAttr('style');
          
          $('.blog-slider').slick({
            dots: false,
            arrows:false,
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                  infinite: true,
                  dots: false
                }
              },

              {
                breakpoint: 992,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                  infinite: true,
                  dots: false
                }
              },

              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
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


  @push('style')
      <style>
      
        .blog-post__thumb img{
          min-height: 300px;
          max-height: 300px;
        }
        .margin-top-120{
          margin-top: 120px;
        }

        .wrap > div{
          overflow: hidden;
          white-space: unset !important;
          
        }

      </style>
  @endpush

