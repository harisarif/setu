@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">

                        <h2 class="title text-center">
                            <span>@lang('Payment Preview')</span>
                        </h2>

                        <img src="{{$deposit->gateway_currency()->methodImage()}}" class="card-img-top" alt="@lang('image')">
                    </div>
                    <div class="col-md-8 d-flex align-items-center justify-content-center">
                        <form action="{{ route('ipn.'.$deposit->gateway->alias) }}" method="POST" class="text-center">
                            @csrf
                            <h3>@lang('Please Pay') {{getAmount($deposit->final_amo)}} {{$deposit->method_currency}}</h3>
                            <h3 class="my-3">@lang('To Get') {{getAmount($deposit->amount)}}  {{$general->cur_text}}</h3>


                            <button type="button" class=" mt-4 btn-success btn-round custom-success text-center btn-lg" id="btn-confirm">@lang('Pay Now')</button>

                            <script
                                src="//js.paystack.co/v1/inline.js"
                                data-key="{{ $data->key }}"
                                data-email="{{ $data->email }}"
                                data-amount="{{$data->amount}}"
                                data-currency="{{$data->currency}}"
                                data-ref="{{ $data->ref }}"
                                data-custom-button="btn-confirm"
                            >
                            </script>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('style')
    <style>
        .card-img-top{
            width: 100%;
        }
    </style>
@endpush

