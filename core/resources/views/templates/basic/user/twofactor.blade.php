@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-4">
            <div class="col-lg-6 col-md-6">
                @if(Auth::user()->ts)
                     <div class="card">
                        <div class="card-header bg-style">
                            <h5 class="card-title">@lang('two_factor_authenticator')</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" value="{{$prevcode}}"
                                           class="form-control form-control-lg" id="referralURL"
                                           readonly>
                                    <div class="input-group-append">
                                            <span class="input-group-text copytext" id="copyBoard"
                                                  onclick="myFunction()"> <i class="fa fa-copy"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mx-auto text-center">
                                <img class="mx-auto" src="{{$prevqr}}">
                            </div>

                            <div class="form-group mx-auto text-center">
                                <a href="#0"  class="btn btn-block btn-lg btn-danger"  data-toggle="modal" data-target="#disableModal">
                                    @lang('disable_two_factor_authenticator')</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card shadow">
                        <div class="card-header bg-style">
                            <h5 class="card-title text-white">@lang('two_factor_authenticator')</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="key" value="{{$secret}}" class="form-control form-control-lg" id="referralURL" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text copytext" id="copyBoard" onclick="myFunction()"> <i class="fa fa-copy"></i> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mx-auto text-center">
                                <img class="mx-auto" src="{{$qrCodeUrl}}">
                            </div>
                            <div class="form-group mx-auto text-center">
                                <a href="#0" class="btn btn-success btn-lg mt-3 mb-1"
                                   data-toggle="modal"
                                   data-target="#enableModal">@lang('enable_two_factor_authenticator')</a>
                            </div>
                        </div>
                    </div>

                @endif
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-style">
                        <h5 class="card-title text-white">@lang('google_authenticator')</h5>
                    </div>
                    <div class=" card-body">
                        <h5 class="text-uppercase">@lang('google_authenticator_title')</h5>
                        <hr/>
                        <p>@lang('google_authenticator_info')</p>
                        <a class="btn btn-success btn-md mt-3"
                           href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
                           target="_blank">@lang('DOWNLOAD APP')</a>
                    </div>
                </div><!-- //. single service item -->
            </div>
        </div>
    </div>



    <!--Enable Modal -->
    <div id="enableModal" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('verify_your_otp')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('user.twofactor.enable')}}" method="POST">
                    @csrf
                    <div class="modal-body ">
                        <div class="form-group">
                            <input type="hidden" name="key" value="{{$secret}}">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('close')</button>
                        <button type="submit" class="btn btn-success">@lang('verify')</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!--Disable Modal -->
    <div id="disableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('verify_your_otp_disable')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('user.twofactor.disable')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('close')</button>
                        <button type="submit" class="btn btn-success">@lang('verify')</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection

@push('script')
    <script>
        'use strict';
        function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            iziToast.success({message: "Copied: " + copyText.value, position: "topRight"});

        }
    </script>
@endpush

@push('style')
    <style>
        .bg-style{
            background: #3cc366 !important;
        }
    </style>
@endpush


