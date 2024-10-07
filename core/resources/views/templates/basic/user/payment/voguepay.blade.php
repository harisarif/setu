@extends($activeTemplate.'layouts.frontend')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                            <div class="w-50 text-center">
                               <img src="{{$deposit->gateway_currency()->methodImage()}}" class="card-img-top" alt="@lang('image')"
                                    >
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <div>
                                <h3 class="mt-4">@lang('Please Pay') {{getAmount($deposit->final_amo)}} {{$deposit->method_currency}}</h3>
                                <h3 class="my-3">@lang('To Get') {{getAmount($deposit->amount)}}  {{$general->cur_text}}</h3>

                                <button type="button"
                                class=" mt-4 btn-success btn-round custom-success text-center btn-lg"
                                id="btn-confirm">@lang('Pay Now')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


@endsection

@push('style')

    <style>
        .card-img-top{
            width: 100%
        }
    </style>
    
@endpush

@push('script')

    <script src="//voguepay.com/js/voguepay.js"></script>
    <script>
        'use strict';
        closedFunction = function() {
        }
        successFunction = function(transaction_id) {
            window.location.href = '{{ route('user.campaigns') }}';
        }
        failedFunction=function(transaction_id) {
            window.location.href = '{{ route('user.deposit') }}' ;
        }

        function pay(item, price) {
            //Initiate voguepay inline payment
            Voguepay.init({
                v_merchant_id: "{{ $data->v_merchant_id}}",
                total: price,
                notify_url: "{{ $data->notify_url }}",
                cur: "{{$data->cur}}",
                merchant_ref: "{{ $data->merchant_ref }}",
                memo:"{{$data->memo}}",
                recurrent: true,
                frequency: 10,
                developer_code: '5af93ca2913fd',
                store_id:"{{ $data->store_id }}",
                custom: "{{ $data->custom }}",

                closed:closedFunction,
                success:successFunction,
                failed:failedFunction
            });
        }

        $(document).ready(function () {
            $(document).on('click', '#btn-confirm', function (e) {
                e.preventDefault();
                pay('Buy', {{ $data->Buy }});
            });
        });
    </script>
@endpush
