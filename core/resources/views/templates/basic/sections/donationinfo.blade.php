@extends($activeTemplate.'layouts.master')
@php
    $payment_method = App\Deposit::where('donation_id',$donor->id)->first();
    
@endphp
@section('content')
<div class="container">
    
    <div class="card card-style">
        <div class="card-header">
            <h4 class="card-title text-light">
                <i class="fa fa-list font-style"></i> 
                @lang('Details For Donor of ID')-{{$donor->id}}
            </h4>
        </div>
      <div class="card-body">
      

        <div class="row">
            <div class="col-md-4">
                <h3>@lang('Campaign') : </h3>
            </div>
            <div class="col-md-8">
                <p><a href="{{route('user.campaign.details',['slug'=>$donor->campaign->slug,'id'=>$donor->campaign->id])}}">{{__($donor->campaign->title)}}</a></p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <h3>@lang('Full Name') : </h3>
            </div>
            <div class="col-md-8">
                <p>{{__($donor->fullname)}}</p>
            </div>
        </div>
    
    
        <div class="row">
            <div class="col-md-4">
                <h3>@lang('Email') : </h3>
            </div>
            <div class="col-md-8">
                <p>{{__($donor->email)}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <h3>@lang('Country') : </h3>
            </div>
            <div class="col-md-8">
                <p>{{__($donor->country)}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <h3>@lang('Mobile') : </h3>
            </div>
            <div class="col-md-8">
                <p>{{$donor->mobile}}</p>
            </div>
        </div>

        <hr>
    
    
        <div class="row">
            <div class="col-md-4">
                <h3>@lang('Amount') : </h3>
            </div>
            <div class="col-md-8">
                <p>{{$general->cur_sym}} {{$donor->donation}}</p>
            </div>
        </div>
    
    
        <div class="row">
            <div class="col-md-4">
                <h3>@lang('Payment Method') : </h3>
            </div>
            <div class="col-md-8">
                <p>{{$payment_method->gateway->alias}}</p>
            </div>
        </div>
    

            <hr>
    
        <div class="row">
            <div class="col-md-4">
                <h3>@lang('Payment Date') : </h3>
            </div>
            <div class="col-md-8">
                <p>{{$payment_method->created_at}}</p>
            </div>
        </div>

      </div>


    </div>

</div>

@endsection

@push('style')
    <style>
        .font-style{
            font-size: 25px;
        }
        .card-header{
            background: #16C26B;
        }

        p{
            margin-left: 50px;
            font-size: 18px;
        }
        h3{
            text-align: right;
            font-size: 20px;
        }
        .card-style{
            margin: 50px auto;
            width: 60%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)

        }
    </style>
@endpush