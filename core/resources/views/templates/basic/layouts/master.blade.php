<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    @include('partials.seo')


    <title>{{$general->sitename(trans($page_title))}}</title>

<!-- Bootstrap CSS -->
   <!-- bootstrap 4  -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/vendor/bootstrap.min.css')}}">
  <!-- fontawesome 5  -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/all.min.css')}}">
  <!-- line-awesome webfont -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/line-awesome.min.css')}}">
  <!-- image and videos view on page plugin -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/lightcase.css')}}">
  
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/vendor/animate.min.css')}}">
  <!-- custom select css -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/vendor/nice-select.css')}}">
  <!-- slick slider css -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/vendor/slick.css')}}">
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/bootstrap-fileinput.css')}}">
  
  <!-- dashdoard main css -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/main.css')}}">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/bootstrap-fileinput.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/custom.css')}}">
    @stack('style-lib')


    @stack('style')
</head>
<body>
    {{-- preloder --}}

    <div class="preloader">
        <div class="dl">
          <div class="dl__container">
            <div class="dl__corner--top"></div>
            <div class="dl__corner--bottom"></div>
          </div>
          <div class="dl__square"></div>
        </div>
      </div>
@php
$contact = getContent('contact_us.content',true);
@endphp
      <header class="header">
        <div class="header__top">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-sm-6">
                <div class="left d-flex align-items-center">
                  <a href="tel:{{$contact->data_values->contact_number}}"><i class="las la-phone-volume"></i> @lang('Help Center')</a>
                  <div class="language">
                    <i class="las la-globe-europe"></i>
                    <select id="language">
                      @foreach($language as $lang)
                      <option value="{{$lang->code}}" {{session('lang') == $lang->code ? 'selected':''}}>{{__($lang->name)}}</option>
                     @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                @auth
                <div class="right text-sm-right text-center">
                  <a href="{{ route('user.home')}}"><i class="las la-sign-in-alt"></i> @lang('Dashboard')</a>
                  
                </div>    
                @endauth
                @guest
                <div class="right text-sm-right text-center">
                  <a href="{{ route('user.login')}}"><i class="las la-sign-in-alt"></i> @lang('Login')</a>
                  <a href="{{ route('user.register')}}"><i class="las la-user-plus"></i> @lang('Registration')</a>
                </div>    
                @endguest
               
              </div>
            </div>
          </div>
        </div>
        <div class="header__bottom">
          <div class="container">
            <nav class="navbar navbar-expand-xl p-0 align-items-center">
            <a class="site-logo site-title" href="{{ url('/') }}"><img src="{{ get_image(imagePath()['logoIcon']['path'] .'/logo.png') }}" alt="site-logo"><span class="logo-icon"><i class="flaticon-fire"></i></span></a>
              <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="menu-toggle"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @auth
                    
                
                <ul class="navbar-nav main-menu ml-auto">
                  

                  <li class="menu_has_children"><a href="javascript:void(0)">@lang('Campaign')</a>
                    <ul class="sub-menu">
                      <li><a class="dropdown-item" href="{{route('user.fundrise')}}">@lang('Create Campaign')</a></li>
                      <li><a class="dropdown-item" href="{{route('user.fundrise.approved')}}">@lang('Approved Campaign')</a></li>
                      <li><a class="dropdown-item" href="{{route('user.fundrise.pending')}}">@lang('Pending Campaign')</a></li>
                      <li><a class="dropdown-item" href="{{route('user.fundrise.rejected')}}">@lang('Rejected Campaign')</a></li>
                      <li><a class="dropdown-item" href="{{route('user.fundrise.complete')}}">@lang('Successfull Campaign')</a></li>
                    </ul>
                  </li>

                  <li class="menu_has_children"><a href="#0">@lang('Withdraw Money')</a>
                    <ul class="sub-menu">
                      <li><a class="dropdown-item" href="{{route('user.withdraw')}}">@lang('Withdraw Money')</a></li>
                      <li><a class="dropdown-item" href="{{route('user.withdraw.history')}}">@lang('Withdraw Log')</a></li>
                    </ul>
                  </li>
                    <li class="menu_has_children"><a href="#0">@lang('Ticket')</a>
                        <ul class="sub-menu">
                         <li> <a class="dropdown-item" href="{{route('ticket.open')}}">@lang('Create New')</a></li>
                         <li><a class="dropdown-item" href="{{route('ticket')}}">@lang('My Ticket')</a></li>
                        </ul>
                    </li>

                  
                  <li class="menu_has_children"><a href="#0"> <i class="fa fa-user mr-2"></i>{{ @Auth::user()->fullname }}</a>
                    <ul class="sub-menu">
                        <li><a class="dropdown-item" href="{{ route('user.change-password') }}">
                            @lang('Change Password')
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('user.profile-setting') }}">
                            @lang('Profile Setting')
                        </a></li>

                        <li><a class="dropdown-item" href="{{ route('user.twofactor') }}">
                            @lang('2FA Setting')
                        </a></li>
                       


                        <li><a class="dropdown-item" href="{{ route('user.logout') }}">
                            {{ __('Logout') }}
                        </a></li>
                    </ul>
                  </li>
                </ul>
                @endauth
                @guest

                <ul class="navbar-nav main-menu ml-auto">
                  <li> <a href="{{route('home')}}">@lang('Home')</a></li>
                  <li><a href="{{route('user.about')}}">@lang('About')</a></li>
                  <li class="menu_has_children"><a href="{{route('user.campaigns')}}">@lang('Campaigns')</a>
                      
                    </li>
                  <li class="menu_has_children"><a href="{{route('user.success.archive')}}">@lang('Success Story')</a>
                     
                    </li>
                   
                  </ul>

                <div class="nav-right">
                    <a href="{{route('contact')}}" class="cmn-btn style--three">@lang('Contact')</a>
                  </div> 
                @endguest

                
                
              </div>
            </nav>
          </div>
        </div>
      </header>

      @include($activeTemplate.'sections.breadcumb')




@yield('content')



@include($activeTemplate.'sections.footer')


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset($activeTemplateTrue.'js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/vendor/jquery.nice-select.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/vendor/lightcase.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/vendor/slick.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/vendor/wow.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/contact.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/app.js')}}"></script>

<script src="{{asset($activeTemplateTrue.'/js/bootstrap-fileinput.js')}}"></script>

@stack('script-lib')



@include('admin.partials.notify')


@stack('script')


<script>
  'use strict';

    $('#language').on("change", function() {

window.location.href = "{{url('/')}}/change/"+$(this).val() ;

});
</script>


@php
    echo analytics();
@endphp

</body>
</html>
