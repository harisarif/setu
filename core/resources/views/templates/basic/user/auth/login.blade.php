@extends($activeTemplate.'layouts.frontend')

@section('content')

  <!-- login section start -->
  <section class="pt-90 pb-90">
    <div class="container">
      <div class="row justify-content-center" >

        <div class="col-md-6 pr-0 pl-0">
          <div class="content-area bg_img" data-background="{{asset($activeTemplateTrue.'images/login.jpg')}}">
             
          </div>
          <div class="overlay">

          </div>
        </div>

        <div class="col-lg-6 shadow p-5">
          <div class="login-area">
          <h2 class="title mb-3">@lang('Hi. welcome to') {{__($general->sitename)}}</h2>
            <p>@lang('Please Provide Your Valid Credentials')</p>
            <form class="action-form mt-50" action="{{ route('user.login')}}" onsubmit="return submitUserForm()" method="POST">
                @csrf
              <div class="form-group">
                <label>@lang('Username')</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="las la-user"></i></div>
                  </div>
                  <input type="text" class="form-control" placeholder="@lang('Username')" name="username" required value={{old('username')}}>
                </div>
              </div><!-- form-group end -->
              <div class="form-group">
                <label>@lang('Password')</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="las la-key"></i></div>
                  </div>
                  <input type="password" class="form-control" placeholder="@lang('Password')" name="password">
                </div>
              </div><!-- form-group end -->

                  @include($activeTemplate.'partials.recaptcha')
                  @include($activeTemplate.'partials.custom-captcha')
                
            </div>
            

            <div class="form-group row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="col-md-6">
                    @if (Route::has('user.password.request'))
                        <a class="btn btn-link float-right" href="{{route('user.password.request')}}">
                                {{ __('Forgot Your Password?') }}
                                </a>
                    @endif
                </div>
            </div>
            
              <div class="form-group text-center">
                <button type="submit" class="cmn-btn rounded-0 w-100">@lang('Login Now')</button>
                <p class="mt-20">@lang("Haven't an account?") <a href="{{route('user.register')}}">@lang('Sign Up')</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- login section end -->


   
@endsection

@push('script')
    <script>
      'use strict';

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
@endpush


@push('style')
    <style>
      .content-area{
        z-index: -1;
        height: 100%;
      }
      .overlay{
               background: rgb(34 59 96 / .3);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
      }
    </style>
@endpush
