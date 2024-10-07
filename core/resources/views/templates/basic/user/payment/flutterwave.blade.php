@extends($activeTemplate.'layouts.frontend')

@section('content')
    <div class="container">
        <div class="col-md-7 align-item-custom">
            <div class="card shadow my-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{$deposit->gateway_currency()->methodImage()}}" class="card-img-top img-thumbnail " alt="@lang('image')">
    
                        </div>

                        <div class="col-md-6">
                           
                            <h3 class="stylepay" >@lang('Please Pay') {{getAmount($deposit->final_amo)}} {{$deposit->method_currency}}</h3>
                            <h3 class="stylepay mt-0 text-center">@lang('To Donate') {{getAmount($deposit->amount)}}  {{$general->cur_text}}</h3>


                            <button type="button" class="btn btn-success mt-4 btn-custom2 custom-button" id="btn-confirm" onClick="payWithRave()">@lang('Pay Now')</button>

                            <script
                                src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>

                            <script>
                                'use strict';

                                var btn = document.querySelector("#btn-confirm");
                                btn.setAttribute("type", "button");
                                const API_publicKey = "{{$data->API_publicKey}}";

                                function payWithRave() {
                                    var x = getpaidSetup({
                                        PBFPubKey: API_publicKey,
                                        customer_email: "{{$data->customer_email}}",
                                        amount: "{{$data->amount }}",
                                        customer_phone: "{{$data->customer_phone}}",
                                        currency: "{{$data->currency}}",
                                        txref: "{{$data->txref}}",
                                        onclose: function () {
                                        },
                                        callback: function (response) {
                                            var txref = response.tx.txRef;
                                            var status = response.tx.status;
                                            var chargeResponse = response.tx.chargeResponseCode;
                                            if (chargeResponse == "00" || chargeResponse == "0") {
                                                window.location = '{{ url('ipn/flutterwave') }}/' + txref + '/' + status;
                                            } else {
                                                window.location = '{{ url('ipn/flutterwave') }}/' + txref + '/' + status;
                                            }
                                            
                                        }
                                    });
                                }
                            </script>


                    </div>


                    </div>
                    
                   
                </div>
            </div>
        </div>

    </div>

@endsection

@push('style')
    <style>
        .img-thumbnail{
            width: 100%; 
            height:100%;
        }
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

        span{
            color: mediumseagreen;
            font-size: 18px;
            font-weight: 900;
        }

        .align-item-custom{
            margin:auto;
        }
    </style>
@endpush
