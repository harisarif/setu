@extends('admin.layouts.app')

@section('panel')
<div class="row">
    @if(request()->routeIs('admin.deposit.list') || request()->routeIs('admin.deposit.method') || request()->routeIs('admin.users.deposits') || request()->routeIs('admin.deposit.dateSearch') || request()->routeIs('admin.users.deposits.method'))
    <div class="col-xl-4 col-sm-6 mb-30">
        <div class="widget-two box--shadow2 b-radius--5 bg--success">
        <div class="widget-two__content">
            <h2 class="text-white">{{ $general->cur_sym }}{{ $deposits->where('status',1)->sum('amount') }}</h2>
            <p class="text-white">@lang('Successful Deposit')</p>
        </div>
        </div><!-- widget-two end -->
    </div>
    <div class="col-xl-4 col-sm-6 mb-30">
        <div class="widget-two box--shadow2 b-radius--5 bg--6">
            <div class="widget-two__content">
                <h2 class="text-white">{{ $general->cur_sym }}{{ $deposits->where('status',2)->sum('amount') }}</h2>
                <p class="text-white">@lang('Pending Deposit')</p>
            </div>
        </div><!-- widget-two end -->
    </div>
    <div class="col-xl-4 col-sm-6 mb-30">
        <div class="widget-two box--shadow2 b-radius--5 bg--pink">
        <div class="widget-two__content">
            <h2 class="text-white">{{ $general->cur_sym }}{{ $deposits->where('status',3)->sum('amount') }}</h2>
            <p class="text-white">@lang('Rejected Deposit')</p>
        </div>
        </div><!-- widget-two end -->
    </div>
    @endif
    <div class="col-lg-12">
        <div class="card b-radius--10">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Date')</th>
                            <th scope="col">@lang('Trx Number')</th>
                            
                            <th scope="col">@lang('Method')</th>
                            <th scope="col">@lang('Amount')</th>
                            <th scope="col">@lang('Charge')</th>
                            <th scope="col">@lang('After Charge')</th>
                            <th scope="col">@lang('Rate')</th>
                            <th scope="col">@lang('Payable')</th>

                            @if(request()->routeIs('admin.deposit.pending') || request()->routeIs('admin.deposit.approved'))
                                <th scope="col">@lang('Action')</th>

                            @elseif(request()->routeIs('admin.deposit.list') || request()->routeIs('admin.deposit.search') || request()->routeIs('admin.users.deposits') || request()->routeIs('admin.deposit.method') || request()->routeIs('admin.deposit.dateSearch') || request()->routeIs('admin.users.deposits.method'))
                                <th scope="col">@lang('Status')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($deposits as $deposit)
                            
                            @php
                                $details = ($deposit->detail != null) ? json_encode($deposit->detail) : null;
                            @endphp
                            <tr>
                                <td data-label="@lang('Date')"> {{ showDateTime($deposit->created_at) }}</td>
                                <td data-label="@lang('Trx Number')" class="font-weight-bold text-uppercase">{{ $deposit->trx }}</td>
                              
                                <td data-label="@lang('Method')">
                                   {{$deposit->gateway->name}}

                                </td>
                                <td data-label="@lang('Amount')" class="font-weight-bold">{{ getAmount($deposit->amount ) }} {{ $general->cur_text }}</td>
                                <td data-label="@lang('Charge')" class="text-success">{{ getAmount($deposit->charge)}} {{ $general->cur_text }}</td>
                                <td data-label="@lang('After Charge')"> 
                                    {{ getAmount($deposit->amount+$deposit->charge) }} {{ $general->cur_text }}
                                </td>
                                <td data-label="@lang('Rate')"> {{ getAmount($deposit->rate) }} {{$deposit->method_currency}}</td>
                                <td data-label="@lang('Payable')" class="font-weight-bold">
                                    {{ getAmount($deposit->final_amo) }} {{$deposit->method_currency}}
                                </td>

                                @if(request()->routeIs('admin.deposit.approved') || request()->routeIs('admin.deposit.pending'))

                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('admin.deposit.details', $deposit->id) }}"
                                           class="icon-btn ml-1 " data-toggle="tooltip" title="" data-original-title="Detail">
                                            <i class="la la-eye"></i>
                                        </a>
                                    </td>

                                @elseif(request()->routeIs('admin.deposit.list')  || request()->routeIs('admin.deposit.search') || request()->routeIs('admin.users.deposits') || request()->routeIs('admin.deposit.method') || request()->routeIs('admin.deposit.dateSearch') || request()->routeIs('admin.users.deposits.method'))
                                    <td data-label="@lang('Status')">
                                        @if($deposit->status == 2)
                                            <span class="badge badge--warning">@lang('Pending')</span>
                                        @elseif($deposit->status == 1)
                                            <span class="badge badge--success">@lang('Approved')</span>
                                        @elseif($deposit->status == 3)
                                            <span class="badge badge--danger">@lang('Rejected')</span>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ trans($empty_message) }}</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
            <div class="card-footer py-4">
                {{ $deposits->links('admin.partials.paginate') }}
            </div>
        </div><!-- card end -->
    </div>
</div>



@endsection


@push('breadcrumb-plugins')
    @if(!request()->routeIs('admin.users.deposits') && !request()->routeIs('admin.users.deposits.method'))

        <form action="{{route('admin.deposit.search', $scope ?? str_replace('admin.deposit.', '', request()->route()->getName()))}}" method="GET" class="form-inline float-sm-right bg--white">
            <div class="input-group has_append  ">
                <input type="text" name="search" class="form-control" placeholder="@lang('Deposit code/Username')" value="{{ $search ?? '' }}">
                <div class="input-group-append">
                    <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

        

    @endif
@endpush


@push('script')
  <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
  <script>
      'use strict';
      // date picker
      $('.datepicker-here').datepicker();
      $('.datepicker-here').val(new Date())selectDate(new Date($('.datepicker-here').val()));
  </script>
@endpush