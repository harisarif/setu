@extends($activeTemplate.'layouts.frontend')

@section('content')
 <!-- blog-details-section start -->
 <section class="blog-details-section pt-150 pb-150">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <div class="blog-details-wrapper">
            <div class="blog-details__thumb">
            <img src="{{asset(imagePath()['success']['path'].'/'.$blog->image)}}" alt="image">
              <div class="post__date">
                <span class="date">{{Carbon\Carbon::parse($blog->created_at)->day}}</span>
                <span class="month">{{Carbon\Carbon::parse($blog->created_at)->format('M')}}</span>
              </div>
              <div class="post__date_right">
                <span class="date">@lang('View')</span>
                <span class="month">{{$blog->view}}</span>
              </div>
            </div><!-- blog-details__thumb end -->
            <div class="blog-details__content">
            <h4 class="blog-details__title">{{__($blog->title)}}</h4>
            <p class="text-justify show-read-more">{{__($blog->details)}}</p>
              
            </div><!-- blog-details__content end -->
            <div class="comments-area">
              <h3 class="title">{{$comment->count()}} @lang('comments')</h3>
              <ul class="comments-list">
            @forelse($comment as $com)
                <li class="single-comment">
                  <div class="single-comment__thumb">
                    <i class="fa fa-user"></i>
                  </div>
                  <div class="single-comment__content">
                  <h6 class="name">{{$com->name}}</h6>
                  <span class="date">{{$com->created_at->diffForHumans()}}</span>
                  <p class="text-justify">{{$com->messages}}</p>
                  </div>
                </li><!-- single-review end -->
              @empty
                  <p>@lang('No Comment Have been Posted Yet')</p>
             @endforelse
              </ul>
            </div><!-- comments-area end -->
            <div class="comment-form-area">
              <h3 class="title">@lang('Leave a Comment')</h3>
              <form class="comment-form" action="" method="POST">
                @csrf
                <div class="row">
                  <div class="col-lg-6 form-group">
                    <input type="text" name="name" id="comment-name" placeholder="@lang('Your Name')" class="form-control" required>
                  </div>
                  <div class="col-lg-6 form-group">
                    <input type="email" name="email" id="comment-email" placeholder="@lang('Email Address')" class="form-control" required>
                  </div>
                 
                  <div class="col-lg-12 form-group">
                    <textarea name="message" id="message" placeholder="@lang('Write Comment')" class="form-control" required></textarea>
                    <code class="">@lang('Charecter Remaining') <span id="limit">400</span> </code>
                  </div>
                  <div class="col-lg-12">
                    <button type="submit" class="cmn-btn">@lang('Post Comment')</button>
                  </div>
                </div>
              </form>
            </div><!-- comment-form-area end -->
          </div><!-- blog-details-wrapper end -->
         
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="sidebar">
            <div class="widget search--widget">
            <form class="search-form" method="GET" action="{{route('user.success.ajax')}}">
                <input type="search" name="search__field" id="search__field" placeholder="@lang('Search here')..." class="form-control" required>
                <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
              </form>
            </div><!-- widget end -->


            <div class="widget p-0">
              <div class="widget-title">
                <h3 class="text-white">@lang('Share Success Story')</h3>
              </div>

              <div class="link-copy copy widget-body">
                <form>
                <input type="text" value="{{route('user.success.details',['slug'=> $blog->slug,'id'=>$blog->id])}}" class="form-control">
                  <button type="button">@lang('Copy')</button>
                </form>
              </div>
              <ul class="social-links widget-body">
                <li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                <li class="twitter" ><a href="https://twitter.com/intent/tweet?text=Post and Share &amp;url={{urlencode(url()->current()) }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                <li class="linkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
              <li class="whatsapp"><a href="https://wa.me/?text={{urlencode(url()->current())}}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
              </ul>
            </div><!-- donation-widget end -->



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
                <h5 class="">@lang('Recent Post')</h5>
              </div>
              <ul class="small-post-list widget-body">
            @foreach($recent as $re)
              <li class="small-post">
              <div class="small-post__thumb"><img src="{{asset(imagePath()['success']['path'].'/'.$re->image)}}" alt="image"></div>
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
    </div>
  </section>
  <!-- blog-details-section end -->

  @endsection


  @push('style')


    <style>

      .post__date_right{
        position: absolute;
        top: 0;
        right: 0;
        width: 75px;
        text-align: center;
      }

      .blog-details__thumb .post__date_right .date{
        font-size: 22px;
        font-weight: 700;
        color: #ffffff;
        background-color: #13c366;
        padding: 10px 5px;
        width: 100%;
        line-height: 1;
      }
      
      .blog-details__thumb .post__date_right .month{
        background: #fff;
        padding: 3px 5px;
        width: 100%;
        font-size: 22px;
        font-weight: 700;
      }
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


      .single-comment__thumb i{
        color: #13c366;
        font-size: 65px;
        margin-left:auto;
      }

      code{
        display: block;
        padding-top: 10px;
      }
       .show-read-more .more-text{
        display: none;
    }
      .social-links {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin: -5px -5px;
    }

    .social-links li {
        margin: 5px 5px;
        width: 45px;
        height: 45px;
        background-color: #13c366;
        text-align: center;
        line-height: 45px;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        -ms-border-radius: 3px;
        -o-border-radius: 3px;
  }

  .social-links li a {
    color: #ffffff;
    font-size: 18px;
}


.social-links li.facebook {
    background-color: #3b5998;
}
.social-links li.twitter {
    background-color: #55acee;
}
.social-links li.linkedin {
    background-color: #0077b5;
}


    .link-copy form{
          display: flex;
    }

    .link-copy form input{
          border-radius: 0;
    }

    .link-copy form button{
      background:#13c366;
      color: #ffffff;
      padding: 0px 10px;
    }

    
    </style>
      
  @endpush



  @push('script')
    
        <script>
          'use strict';

              $(document).ready(function(){

                  
                  var maxLength = 800;
                  $(".show-read-more").each(function(){
                      var myStr = $(this).text();
                      if($.trim(myStr).length > maxLength){
                          var newStr = myStr.substring(0, maxLength);
                          var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                          $(this).empty().html(newStr);
                          $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
                          $(this).append('<span class="more-text">' + removedStr + '</span>');
                      }
                  });
                  $(".read-more").click(function(){
                      $(this).siblings(".more-text").contents().unwrap();
                      $(this).remove();
                  });

                  $('#message').on('keyup paste',function(){
                    var text = $(this).val();
                  
                    $('#limit').text(400-text.length);

                    if(text.length >= 400){
                      var newStr = text.substring(0, 400);
                      $(this).val(newStr);
                      $('#limit').text(0);
                    }
                  })
              });



                var copyButton = document.querySelector('.copy button');
                var copyInput = document.querySelector('.copy input');
                copyButton.addEventListener('click', function(e) {
                  e.preventDefault();
                  var text = copyInput.select();
                  document.execCommand('copy');
                });
                copyInput.addEventListener('click', function() {
                  this.select();
                });

    
        </script>

  @endpush