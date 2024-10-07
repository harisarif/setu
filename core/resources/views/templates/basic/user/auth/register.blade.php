@php
    $data = getContent('terms.element',false);
@endphp
@extends($activeTemplate.'layouts.frontend')
@section('content')



<!-- registration section start -->
<section class="pt-90 pb-90">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 shadow p-3">
          <div class="login-area">
          <h2 class="title mb-3">@lang('Hi. welcome to') {{$general->sitename}}</h2>
            <p>@lang('Please provide your valid infomations to get the benefits form our site.')</p>
            <form class="action-form mt-50" action="" method="post" onsubmit="return submitUserForm();"> 
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label>@lang('First name')</label>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="las la-user"></i></div>
                              </div>
                            <input type="text" class="form-control" placeholder="@lang('First name')" name="firstname" required value="{{old('firstname')}}">
                            </div>
                          </div><!-- form-group end -->
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>@lang('Last name')</label>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="las la-user"></i></div>
                              </div>
                            <input type="text" class="form-control" placeholder="@lang('Last name')" name="lastname" required value="{{old('lastname')}}">
                            </div>
                          </div><!-- form-group end -->
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label>@lang('User name')</label>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="las la-user"></i></div>
                              </div>
                            <input type="text" class="form-control" placeholder="@lang('User name')" name="username" required value="{{old('username')}}">
                            </div>
                          </div><!-- form-group end -->
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>@lang('Email address')</label>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="las la-at"></i></div>
                              </div>
                            <input type="email" class="form-control" placeholder="@lang('Email address')" name="email" required value="{{old('email')}}">
                            </div>
                          </div><!-- form-group end -->
                    </div>
                </div> 

                <div class="row mb-3">
                  <div class="form-group col-md-6">

                    <label for="mobile" class="text-md-right">{{ __('Mobile') }}</label>

                    <div class=" country-code">

                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                <select name="country_code" >
                                  @include('partials.country_code')
                                </select>
                              </span>
                          </div>
                        <input type="text" name="mobile" class="form-control" placeholder="@lang('Your Phone Number')">
                        </div>
                    </div>


                  </div>

                  <div class="form-group col-md-6 mt-0">
                    <label for="email" class="text-md-right">{{ __('Country') }}</label>
                    <input type="text" name="country" class="form-control" readonly>
                  </div>
                </div>
              

              <div class="row mb-3">
                  <div class="col">
                    <div class="form-group">
                        <label>@lang('Password')</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="las la-key"></i></div>
                          </div>
                          <input type="password" class="form-control" placeholder="@lang('Password')" name="password" required>
                        </div>
                      </div><!-- form-group end -->
                  </div>
                  <div class="col">
                    <div class="form-group">
                        <label>@lang('Confirm Password')</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="las la-key"></i></div>
                          </div>
                          <input type="password" class="form-control" placeholder="@lang('Confirm Password')" required name="password_confirmation">
                        </div>
                      </div><!-- form-group end -->
                  </div>
              </div>

              

            @include($activeTemplate.'partials.recaptcha')
            @include($activeTemplate.'partials.custom-captcha')
            
            <div class="form-group">
                <div class="input-group my-3 d-flex flex-wrap align-items-center">
                  <input type="checkbox" placeholder="Checkbox" required name="check" id="check">
                  <label for="" class="mt-2 ml-2">@lang('I Accept All')
                    @foreach ($data as $item)
                      <a href="{{route('user.site',$item->data_values->pagename)}}">{{$item->data_values->pagename}}</a>
                       {{$loop->last ? '': '&'}}
                    @endforeach
                  </label>
                </div>
              </div><!-- form-group end -->

              <div class="form-group text-center">
                <button type="submit" class="cmn-btn rounded-0 w-100">@lang('Signup Now')</button>
              <p class="mt-20">@lang('Already i have an account in here') <a href="{{route('user.login')}}">@lang('Sign In')</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- registration section end -->




@endsection
@push('style')

    <style>
      

       .country-code .input-group-prepend .input-group-text {
          background: #e9ecef !important;
          padding: 0;
          border: none;
      }
      .country-code select{
          border: none;
      }
      .country-code select:focus{
          border: none;
          outline: none;
      }

      .select option{
        background: #fff !important;
      }

    
    </style>
@endpush


@push('script')
    <script>
       'use strict';

        @if($country_code)
        var t = $(`option[data-code={{ $country_code }}]`).attr('selected','');
      @endif
        $('select[name=country_code]').change(function(){
            $('input[name=country]').val($('select[name=country_code] :selected').data('country'));
        }).change();
    </script>


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
