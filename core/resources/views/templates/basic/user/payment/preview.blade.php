@extends($activeTemplate.'layouts.frontend')

@section('content')
    <div class="container">
        <div class="row  justify-content-center my-5">
            <div class="col-md-10">
                <div class="card w-100 shadow">
                    <div class="card-header text-center">
                        <h3>
                            @lang('Donation Details')
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img
                                    src="{{ $data->gateway_currency()->methodImage() }}" class="img-thumbnail"/>
                            </div>
    
                            <div class="col-md-8 ">
                                <ul class="list-group text-center">
                                    <p class="list-group-item">
                                        @lang('Campaign'):
                                        <strong>{{$data->campaign->title}} </strong>
                                    </p>
    
    
                                    <p class="list-group-item">
                                        @lang('Goal'):
                                        <strong>{{$data->campaign->goal}} </strong>
                                    </p>
    
                                    <p class="list-group-item">
                                        @lang('Amount'):
                                        <strong>{{getAmount($data->amount)}} </strong> {{$general->cur_text}}
                                    </p>
                                    <p class="list-group-item">
                                        @lang('Charge'):
                                        <strong>{{getAmount($data->charge)}}</strong> {{$general->cur_text}}
                                    </p>
        
        
        
        
        
                                    <p class="list-group-item">
                                        @lang('Payable'): <strong> {{getAmount($data->amount + $data->charge)}}</strong> {{$general->cur_text}}
                                    </p>
        
                                    <p class="list-group-item">
                                        @lang('Conversion Rate'): <strong>1 {{$general->cur_text}} = {{getAmount($data->rate) }}  {{$data->baseCurrency()}}</strong>
                                    </p>
        
        
                                    <p class="list-group-item">
                                        @lang('In') {{$data->baseCurrency()}}:
                                        <strong>{{getAmount($data->final_amo)}}</strong>
                                    </p>
        
        
                                    @if($data->gateway->crypto==1)
                                        <p class="list-group-item">
                                            @lang('Conversion with')
                                            <b> {{ $data->method_currency }}</b> @lang('and final value will Show on next step')
                                        </p>
                                    @endif
                                </ul>
    
                                
                            </div>
                        </div>
                        @if( 1000 >$data->method_code)
                                <a href="{{route('user.deposit.confirm')}}" class="btn btn-success btn-block py-3 font-weight-bold mt-3">@lang('Pay Now')</a>
                            @else
                                <a href="{{route('user.deposit.manual.confirm')}}" class="btn btn-success btn-block py-3 font-weight-bold mt-3">@lang('Pay Now')</a>
                            @endif
                    </div>
                </div>
            </div>
            
           
        </div>
    </div>
@stop


@push('style')
    <style>
       
        tr { line-height: 22px;width: 100% }
        .shadow{
            margin-top:60px;
        }
        .card-header{
            background: mediumseagreen;
           
        }

        .card-header h3{
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
        .card-deposit{
            margin: 60px;
        }
    
    </style>    
@endpush