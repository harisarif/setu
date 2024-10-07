<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('partials.seo')
      <title>{{$general->sitename(trans($page_title))}}</title>
    <link rel="icon" type="image/png" href="{{get_image('assets/images/logoIcon/favicon.png')}}" sizes="16x16">
  <!-- bootstrap 4  -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/vendor/bootstrap.min.css')}}">
  <!-- fontawesome 5  -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/all.min.css')}}">
  <!-- line-awesome webfont -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/line-awesome.min.css')}}">
  <!-- image and videos view on page plugin -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/lightcase.css')}}">

  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/vendor/animate.min.css')}}">
  <!-- custom select css -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/vendor/nice-select.css')}}">
  <!-- slick slider css -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/vendor/slick.css')}}">
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/bootstrap-fileinput.css')}}">

  <!-- dashdoard main css -->
  <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/main.css')}}">
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

 <!-- header-section start  -->
 <header class="header">
    <div class="header__top">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <div class="left d-flex align-items-center">
              <a href="tel:65655655"><i class="las la-phone-volume"></i> @lang('Help Center')</a>
              <div class="language">
                <i class="las la-globe-europe"></i>
                <select id="languageSelection" name="lang">

                  @foreach($language as $lang)
                    <option value="{{$lang->code}}" {{session('lang') == $lang->code ? 'selected' : ''}}>{{__($lang->name)}}</option>
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
              <a href="{{ route('user.register')}}"><i class="las la-user-plus"></i>@lang('Registration')</a>
            </div>
            @endguest

          </div>
        </div>
      </div>
    </div>
    <div class="header__bottom">
      <div class="container">
        <nav class="navbar navbar-expand-xl p-0 align-items-center">
        <a class="site-logo site-title" href="{{route('home')}}">
          <img src="{{ get_Image(imagePath()['logoIcon']['path'] .'/logo.png') }}" alt="site-logo" class="site-logo"><span class="logo-icon"><i class="flaticon-fire">
            </i></span></a>
          <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="menu-toggle"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav main-menu ml-auto">
            <li> <a href="{{route('home')}}">@lang('Home')</a></li>
            <li><a href="{{route('user.about')}}">@lang('About')</a></li>
            <li class="menu_has_children"><a href="{{route('user.campaigns')}}">@lang('Campaigns')</a>
            <li class="menu_has_children"><a href="{{route('volunteer.list')}}">@lang('Volunteers')</a>

              </li>
            <li class="menu_has_children"><a href="{{route('user.success.archive')}}">@lang('Success Story')</a>

              </li>
              <li class="menu_has_children"><a href="{{route('user.team')}}">@lang('Team')</a>

              </li>

            </ul>
            @guest
            <div class="nav-right">
            <a href="{{route('contact')}}" class="cmn-btn style--three">@lang('Contact')</a>
            </div>
            @endguest
          </div>
        </nav>
      </div>
    </div>
  </header>
  <!-- header-section end  -->


@if(request()->is('/'))

@else
@include($activeTemplate.'sections.breadcumb')
@endif

@yield('content')

@include($activeTemplate.'sections.footer')

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset($activeTemplateTrue.'js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/vendor/jquery-ui.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/vendor/jquery.nice-select.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/vendor/lightcase.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/vendor/slick.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/vendor/wow.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/contact.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/app.js')}}"></script>

@stack('script-lib')

@stack('script')

@include('partials.analytics')
@include($activeTemplate.'partials.notify')

<script>
  'use strict';

    $('#languageSelection').on("change", function() {
        window.location.href = "{{url('/')}}/change/"+$(this).val() ;

    });


</script>

@php
    echo analytics();
@endphp
</body>
</html>
