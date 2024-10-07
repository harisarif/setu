@extends($activeTemplate.'layouts.frontend')

@push('style')
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .stylepay{
            margin-top: 20%;
            color: mediumseagreen;
            font-weight: 900;
            margin-left: 18%;
            font-size: 28px;
        }

        .custom-button{
            margin-left: 31%;
            padding: 10px 37px;
            background: mediumseagreen;
            border: none;
        }

        .custom-button:hover{
            margin-left: 31%;
            padding: 10px 37px;
            background: mediumseagreen;
            border: none;
        }
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        .card button {
            padding-left: 0px !important;
        }

        button.stripe-button-el.btn-success.btn-round.custom-success.text-center.btn-lg {
    
                margin-left: 44%;
            }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow my-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{$deposit->gateway_currency()->methodImage()}}" class="card-img-top img-thumbnail w-100" alt="..">
                            </div>
                            <div class="col-md-8">
                                <form action="{{$data->url}}" method="{{$data->method}}">
                                    <h3 class="stylepay mt-1 text-center">@lang('Please Pay') {{getAmount($deposit->final_amo)}} {{$deposit->method_currency}}</h3>
                                    <h3 class="stylepay my-3 text-center">@lang('To Donate') {{getAmount($deposit->amount)}}  {{$general->cur_text}}</h3>
                                    <script
                                        src="{{$data->src}}"
                                        class="stripe-button"
                                        @foreach($data->val as $key=> $value)
                                        data-{{$key}}="{{$value}}"
                                        @endforeach
                                    >
                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
      

    </div>

@endsection

@push('script')
    <script>
        'use strict';
        
        $(document).ready(function () {
            $('button[type="submit"]').addClass("btn-success btn-round custom-success text-center btn-lg");
        })
    </script>
@endpush
