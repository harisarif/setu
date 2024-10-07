@extends($activeTemplate.'layouts.frontend')

@section('content')
<!-- blog-section start -->
<section class="pt-150 pb-150">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="row mb-none-30" id="appear">
            @forelse($blog as $bl)
            <div class="col-md-6 mb-30 ajaxDom" >
              <div class="blog-post hover--effect-1 has-link">
                <a href="{{route('user.success.details',['slug'=>$bl->slug,'id'=>$bl->id])}}" class="item-link"></a>
                <div class="blog-post__thumb">
                <img src="{{get_image(imagePath()['success']['path'].'/'.$bl->image)}}" alt="@lang('image')" class="w-100">
                </div>
                <div class="blog-post__content">
                  <ul class="blog-post__meta mb-3">
                    <li>
                      <a href="#0">@lang('Post by Admin')</a>
                    </li>
                    <li>
                      <i class="las la-calendar-day"></i>
                    <span>{{Carbon\Carbon::parse($bl->created_at)->toFormattedDateString()}}</span>
                    </li>
                  </ul>
                  <h4 class="blog-post__title">@php echo __(shortDescription($bl->title,50)) @endphp</h4>
                  <p>@php echo __(shortDescription($bl->short_description,100)) @endphp</p>
                  <i class="blog-post__icon las la-arrow-right"></i>
                </div>
              </div>
            </div><!-- blog-post end -->
            @empty
            <div class="col-md-12 mb-30">
              <div class="card">
                <div class="card-body">
                  <p class="text-center text-danger">@lang('No Success Story Found')</p>
                </div>
              </div>
              
            </div>

            @endforelse
          </div><!-- row end -->
          <div class="row">
            <div class="col-lg-12">
              <div class=" py-4">
                {{ $blog->links($activeTemplate.'partials.paginate') }}
            </div>
            </div>
          </div><!-- row end -->
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="sidebar">
              <div class="widget search--widget">
                <form class="search-form" method="GET" action="{{route('user.success.ajax')}}">
                  <input type="search" name="search__field" id="search__field" placeholder="@lang('Search here by Title') ...." class="form-control" required>
                  <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                </form>
              </div><!-- widget end -->
              <div class="widget p-0">
                <div class="widget-title">
                  <h5 class="">@lang('Categories')</h5>
                </div>
                <ul class="categories__list widget-body">
                    @foreach($category as $cat)
                          <li class="categories__item"><a href="{{route('user.success.archive',['category'=>$cat->name])}}">{{__($cat->name)}}</a></li>
                    @endforeach
                </ul>
              </div><!-- widget end -->
              <div class="widget p-0">
                <div class="widget-title">
                      <h5 class="">@lang('Archive')</h5>
                </div>
               
                <ul class="archive__list widget-body">
                  @foreach($archive as $arch)
                  <li class="archive__item"><a href="{{route('user.success.archive',['month'=> $arch->Month , 'year'=>$arch->Year])}}">{{__($arch->Month)}} {{__($arch->Year)}}</a></li>
                  @endforeach
                </ul>
              </div><!-- widget end -->
              <div class="widget p-0">
                <div class="widget-title">
                  <h5 class="">@lang('recent post')</h5>
                </div>
                <ul class="small-post-list widget-body">
              @foreach($recent as $re)
                <li class="small-post">
                <div class="small-post__thumb"><img src="{{asset(imagePath()['success']['path'].'/'.$re->image)}}" alt="@lang('image')"></div>
                    <div class="small-post__content">
                    <h5 class="post__title"><a href="{{route('user.success.details',['slug'=>$re->slug,'id'=>$re->id])}}">{{shortDescription($re->title,30)}}</a></h5>
                    </div>
                  </li><!-- small-post end -->
                  @endforeach
                </ul><!-- small-post-list end -->
              </div><!-- widget end -->
             
            </div><!-- sidebar end -->
          </div>
    </div>
  </section>
  <!-- blog-section end -->

  @endsection

  @push('style')
      <style>
        .widget-title{
            padding: 10px;
            background: #13c366;
            line-height: 1.5;
        }

        .widget-title h5{
            color:#fff;
        }
        .widget-body{
            padding: 30px;
        }
      </style>
  @endpush

