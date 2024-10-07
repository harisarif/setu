@extends($activeTemplate.'layouts.frontend')

@section('content')
<!-- event details section start -->
<section class="pt-90 pb-90">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="event-details-wrapper">
            <div class="event-details-thumb">
            <img src="{{asset(imagePath()['campaign']['path'].'/'.$campaign->image)}}" alt="@lang('image')">
            </div>
          </div><!-- event-details-wrapper end -->
          <div class="event-details-area mt-50">
            <ul class="nav nav-tabs nav-tabs--style" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">@lang('Description')</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false">@lang('Prof Image')</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="false">@lang('Prof Document')</a>
              </li>

              <li class="nav-item" role="presentation">
                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">@lang('Review')</a>
              </li>
            </ul>
            <div class="tab-content mt-4" id="myTabContent">
              <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <p class="text-justify">{{$campaign->description}}</p>
                
              </div><!-- tab-pane end -->
              <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                <div class="row mb-none-30">

                @foreach(json_decode($campaign->image_prof) as $prof)
           
                @if(explode('.',$prof)[1] == 'pdf')
                  
                  @else
                  
                    <div class="col-lg-4 col-sm-6 mb-30">
                        <div class="gallery-card">
                        <a href="{{asset(imagePath()['prof']['path'].'/'.$prof)}}" class="view-btn" data-rel="lightcase:myCollection:slideshow"><i class="las la-plus"></i></a>
                        <div class="gallery-card__thumb">
                            <img src="{{asset(imagePath()['prof']['path'].'/'.$prof)}}" alt="@lang('image')">
                        </div>
                        </div><!-- gallery-card end -->
                    </div>
                  @endif
                  @endforeach

                </div>
              </div><!-- tab-pane end -->
              <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                @foreach(json_decode($campaign->image_prof) as $prof)
           
                @if(explode('.',$prof)[1] == 'pdf')
              <iframe width="100%" height="800" src="{{asset(imagePath()['prof']['path'].'/'.$prof)}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                @endif
                @endforeach
              </div><!-- tab-pane end -->

              <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                <ul class="review-list mb-50">
                @forelse($campaign->comments->where('published',1) as $comment)
                  <li class="single-review">
                    <div class="thumb"><i class="fa fa-user comment-user"></i></div>
                    <div class="content">
                    <h6 class="name mb-1">{{$comment->fullname}}</h6>
                    <span class="date">{{$comment->created_at->diffforhumans()}}</span>
                      
                    <p class="mt-2 text-justify">{{$comment->details}}</p>
                    </div>
                  </li>
                  @empty
                    <p class="text-center my-3">@lang('No Review Is being placed Yet')</p>
                  @endforelse
                </ul>
              
              </div><!-- tab-pane end -->
              
            </div>
          </div>
        </div>
        <div class="col-lg-4 mt-lg-0 mt-5">
          <div class="donation-sidebar">
            <div class="donation-widget">
            <h3>{{shortDescription($campaign->title,25)}}</h3>
            <p>{{Str::limit($campaign->description,50)}}</p>
             
              <div class="row mt-2 justify-content-between">
                <div class="col-sm-6">
                  <b>{{$general->cur_sym}} {{$campaign->donation->where('payment_status',1)->sum('donation')}}</b> @lang('Donated')
                </div>
                <div class="col-sm-6">
                @lang('Goal Amount') <b>{{$general->cur_sym}} {{number_format($campaign->goal)}}</b>
                </div>
              </div>
              <div class="row mt-50 mb-none-30">
                <div class="col-6 donate-item text-center mb-30">
                <h4 class="amount">{{$campaign->donation->where('payment_status',1)->count()}}</h4>
                  <p>@lang('Donors')</p>
                </div>
                <div class="col-6 donate-item text-center mb-30">
                  <h4 class="amount">{{$general->cur_sym}} {{$campaign->donation->where('payment_status',1)->sum('donation')}}</h4>
                  <p>@lang('Donated')</p>
                </div>
              </div>
            </div><!-- donation-widget end -->

            <div class="donation-widget">
              <h3>@lang('Event Share')</h3>
              <div class="link-copy copy mt-3">
                <form>
                <input type="text" value="{{route('user.campaign.details',['slug'=> $campaign->slug,'id'=>$campaign->id])}}" class="form-control">
                  <button type="button">@lang('Copy')</button>
                </form>
              </div>
              <ul class="social-links mt-4">
                <li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}"><i class="fab fa-facebook-f"></i></a></li>
                <li class="twitter"><a href="https://twitter.com/intent/tweet?text=Post and Share &amp;url={{urlencode(url()->current()) }}"><i class="fab fa-twitter"></i></a></li>
                <li class="linkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}"><i class="fab fa-linkedin-in"></i></a></li>
                <li class="whatsapp"><a href="#0"><i class="fab fa-whatsapp"></i></a></li>
              </ul>
            </div><!-- donation-widget end -->

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- event details section end -->
  

@endsection

@push('style')
  <style>
    .comment-user{
      font-size: 50px;
      color: #13c366;
      margin-top: 20px;
    padding-left: 50px;
    }
    .link-copy form {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
.link-copy input {
    width: calc(100% - 65px);
}
.link-copy button {
    width: 65px;
    background-color: #13c366;
    color: #ffffff;
    border-radius: 0 5px 5px 0;
    -webkit-border-radius: 0 5px 5px 0;
    -moz-border-radius: 0 5px 5px 0;
    -ms-border-radius: 0 5px 5px 0;
    -o-border-radius: 0 5px 5px 0;
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
.social-links li.facebook {
    background-color: #3b5998;
}
.social-links li.twitter {
    background-color: #55acee;
}
.social-links li.linkedin {
    background-color: #0077b5;
}
.social-links li.whatsapp {
    background-color: #43d854;
}
.social-links li a {
    color: #ffffff;
    font-size: 18px;
}
    .custom-btn-color{
      background: #13c366;
      border:none;
      margin-left: 50%;
      margin-top: 32px;
    }
    .custom-btn-color:hover{
      background: #13c366;
      border:none;
    }
    .feature-card__icon {
    width: 75px;
    color: #13c366;
    font-size: 45px;
    line-height: 1;
    -webkit-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}


  </style>
@endpush

@push('script')
<script>
  'use strict';
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