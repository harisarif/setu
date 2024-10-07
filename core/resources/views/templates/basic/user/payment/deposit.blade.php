@extends($activeTemplate.'layouts.frontend')

@section('content')
    <div class="container mt-5">
        <div class="row">
            @foreach($gatewayCurrency as $data)
                <div class="col-lg-3 col-md-3 mb-4">
                    <div class="card card-deposit">
                        <h5 class="card-header text-center">{{__($data->name)}}
                        </h5>
                        <div class="card-body card-body-deposit">
                            <img src="{{$data->methodImage()}}" class="card-img-top" alt="{{$data->name}}" style="width: 100%; min-height: 213px; ">
                        </div>
                        <div class="card-footer">
                            <a href="javascript:void(0)"  data-id="{{$data->id}}" data-resource="{{$data}}"
                                data-donation_id="{{$donation->id}}"
                               data-min_amount="{{getAmount($data->min_amount)}}"
                               data-max_amount="{{getAmount($data->max_amount)}}"
                               data-base_symbol="{{$data->baseSymbol()}}"
                               data-fix_charge="{{getAmount($data->fixed_charge)}}"
                               data-percent_charge="{{getAmount($data->percent_charge)}}" class=" btn  btn-success btn-block custom-success deposit" data-toggle="modal" data-target="#exampleModal">
                                @lang('Donate Now')</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title method-name" id="exampleModalLabel"></strong>
                    <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <form action="{{route('user.donation.insert')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p class="text-danger depositLimit"></p>
                        <p class="text-danger depositCharge"></p>
                        <div class="form-group">
                            <input type="hidden" name="currency" class="edit-currency" value="">
                            <input type="hidden" name="method_code" class="edit-method-code" value="">
                            <input type="hidden" name="donation_id" class="donation_id" value="">
                            <input type="hidden" name="campaign_id" class="campaign" value="{{$donation->campaign_id}}">
                            <input id="user_id" type="hidden" class="form-control form-control-lg" value="{{$donation->user_id}}" name="userid">
                        </div>
                        <div class="form-group">
                            <label class="">@lang('Are You Sure To Donate ?')</label>
                            <div class="input-group">
                            <input id="amount" type="hidden" class="form-control form-control-lg" value="{{$donation->donation}}" name="amount">
                            
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Confirm')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('style')
    <style>
        .modal-header{
            background: mediumseagreen;
            color: aliceblue;
        }

        .modal-header span {
            color: aliceblue;
        }
        .card-header{
            background: mediumseagreen;
            color: aliceblue;
        }
        .btn-success{
            background: mediumseagreen;
        }

        .btn-success:hover{
            background: mediumseagreen;
            border: 1px solid mediumseagreen;
        }
    </style>
@endpush

@push('script')
    <script>
        'use strict';
        
        $(document).ready(function(){
            $('.deposit').on('click', function () {
                var id = $(this).data('id');
                var result = $(this).data('resource');
                var donation_id = $(this).data('donation_id');
                $('.method-name').text(`@lang('Payment By ') ${result.name}`);
                


                $('.edit-currency').val(result.currency);
                $('.edit-method-code').val(result.method_code);
                $('.donation_id').val(donation_id);

            });
        });
    </script>
@endpush
