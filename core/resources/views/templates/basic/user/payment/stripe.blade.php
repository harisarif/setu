@extends($activeTemplate.'layouts.frontend')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card card-deposit shadow">
                    <div class="card-header">
                        <h5 class="card-title">@lang('Stripe Payment')</h5>
                    </div>
                    <div class="card-body card-body-deposit">


                        <div class="card-wrapper"></div>
                        <br><br>

                        <form role="form" id="payment-form" method="{{$data->method}}" action="{{$data->url}}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$data->track}}" name="track">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">@lang('CARD NAME')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg custom-input" name="name"
                                               placeholder="@lang('Card Name')" autocomplete="off" autofocus/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text addon-bg"><i class="fa fa-font"></i></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label for="cardNumber">@lang('CARD NUMBER')</label>
                                    <div class="input-group">
                                        <input type="tel" class="form-control form-control-lg custom-input"
                                               name="cardNumber" placeholder="Valid Card Number" autocomplete="off"
                                               required autofocus/>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text addon-bg"><i
                                                    class="fa fa-credit-card"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="cardExpiry">@lang('EXPIRATION DATE')</label>
                                    <input type="tel" class="form-control form-control-lg input-sz custom-input"
                                           name="cardExpiry" placeholder="MM / YYYY" autocomplete="off" required/>
                                </div>
                                <div class="col-md-6 ">

                                    <label for="cardCVC">@lang('CVC CODE')</label>
                                    <input type="tel" class="form-control form-control-lg input-sz custom-input"
                                           name="cardCVC" placeholder="CVC" autocomplete="off" required/>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-success btn-lg btn-block text-center" type="submit"> @lang('PAY NOW')
                            </button>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('script')
    <script type="text/javascript" src="https://rawgit.com/jessepollak/card/master/dist/card.js"></script>

    <script>
        'use strict';
        
        (function ($) {
            $(document).ready(function () {
                var card = new Card({
                    form: '#payment-form',
                    container: '.card-wrapper',
                    formSelectors: {
                        numberInput: 'input[name="cardNumber"]',
                        expiryInput: 'input[name="cardExpiry"]',
                        cvcInput: 'input[name="cardCVC"]',
                        nameInput: 'input[name="name"]'
                    }
                });
            });
        })(jQuery);
    </script>
@endpush


@push('style')
    <style>
        .card-deposit{
            margin: 60px;
        }   
        .card-header{
            background: mediumseagreen;
        } 
        .card-header h5{
            color: #ffffff;
        }

        .btn-success{
            background: mediumseagreen;
            margin:5px 0;
        }

        .btn-success:hover{
            
            background: mediumseagreen;
            border:1px solid mediumseagreen;
        }
    </style>    
@endpush