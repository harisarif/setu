@extends($activeTemplate.'layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="table-responsive--md  table-responsive">
            <table class="table table-bordered table--light">

                <thead>
                    <tr class="bg-table-custom">
                        <th scope="col">@lang('Serial')</th>
                        <th scope="col">@lang('trx')</th>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Email')</th>
                        <th scope="col">@lang('Mobile')</th>
                        <th scope="col">@lang('Country')</th>
                        <th scope="col">@lang('Amount')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>

                </thead>
                

                <tbody>

                </tbody>
                @forelse ($donation as $key => $item)
                    <tr class="text-center">
                        <td data-label="@lang('Serial')">{{++$key}}</td>
                        <td data-label="@lang('trx')">{{$item->deposite->trx}}</td>
                        <td data-label="@lang('Name')">{{$item->fullname}}</td>
                        <td data-label="@lang('Email')">{{$item->email}}</td>
                        <td data-label="@lang('Mobile')">{{$item->mobile}}</td>
                        <td data-label="@lang('Country')">{{$item->country}}</td>
                        <td data-label="@lang('Amount')">{{$general->cur_sym}} {{$item->donation}} </td>
                        
                        <td data-label="@lang('Action')">
                        <a href="{{route('user.donation.details',$item->id)}}"><i class="fa fa-eye" title="Show Info"></i></a>
                        </td>
                        
                        
                    </tr>
                @empty
                 <tr>
                    <td data-label="@lang('No Donation')"  colspan="100%">
                        <p class="text-center"><i class="fas fa-laugh"></i> @lang('No Donation Found') <i class="fas fa-laugh"></i></p>
                    </td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
@endsection

@push('style')
    <style>
        .bg-table-custom{
            background: #16C26B;
            color:#ffffff;
            text-align: center;
        }
        i{
            color: #16C26B;
        }

        i.fa.fa-edit{
            font-size:25px;
            font-weight: bolder
        }

        .custom-font-success{
            color: #16C26B;
        }

        .custom-font-error{
            color: #E2B748;
        }

        .custom-font-reject{
            color: #FF031B;
        }
    </style>
@endpush