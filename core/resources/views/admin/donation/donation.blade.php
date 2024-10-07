@extends('admin.layouts.app')
@section('panel')

  <div class="row">
    <div class="col-lg-12">
      
      <div class="card">
          <div class="card-body p-0">

              <div class="table-responsive--md table-responsive">
                        <table class=" table align-items-center table--light" id="myTable">
                      <thead>
                      <tr>
                          <th>@lang('Trx').</th>
                          <th>@lang('Campaign')</th>
                          <th>@lang('Full Name')</th>
                          <th>@lang('Country')</th>
                          <th>@lang('Email')</th>
                          <th>@lang('Mobile')</th>
                          <th>@lang('Donation')</th>
                          <th>@lang('Payment Method')</th>
                          <th>@lang('Payment Date')</th>
                          <th>@lang('Status')</th>
                          
                      </tr>
                      </thead>
                      <tbody class="list">
                      @forelse($donor as $key => $don)
                          <tr class="filt">
                              <td data-label="@lang('Trx')">{{@$don->deposite->trx}}</td>
                              <td data-label="@lang('Campaign')"> 
                                <a href="{{route('admin.fundrise.edit',['slug'=>@$don->campaign->slug,'id'=>@$don->campaign->id])}}">{{shortDescription(@$don->campaign->title,20)}}</a>
                              </td>
                              <td data-label="@lang('Full Name')">{{$don->fullname}}</td>
                              <td data-label="@lang('Country')">{{$don->country}}</td>
                              <td data-label="@lang('Email')">{{$don->email}}</td>
                              <td data-label="@lang('Mobile')">{{$don->mobile}}</td>
                              <td data-label="@lang('Donation')">{{$general->cur_sym}} {{$don->donation}}</td>
                              <td data-label="@lang('Payment Method')">
                                {{@App\Deposit::where('donation_id',$don->id)->first()->gateway->alias}}
                              </td>
                              <td data-label="@lang('Payment Date')">{{$don->created_at->diffForHumans()}}</td>
                              <td data-label="@lang('Status')">
                                <span class="text--small badge font-weight-normal {{$don->payment_status ? 'badge--success':'badge--danger'}}">{{$don->payment_status ? 'Complete':'Not Paid'}}</span>
                                
                              </td>
                             
                              
                          </tr>
                      @empty
                          <tr>
                              <td colspan="100%" class="text-muted text-center">{{$empty_message}}</td>
                          </tr>
                      @endforelse
                      </tbody>
                  </table>

                  
              </div>
          </div>
     @if($donor->hasPages())
          <div class="card-footer py-4">
            {{ $donor->links('admin.partials.paginate') }}
        </div>
    @endif
      </div><!-- card end -->
  </div>
  </div>


  <div class="modal fade" tabindex="-1" role="dialog" id="modalDelete">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">@lang('Delete Fund Request')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="font-weight-bold">@lang('Are you Sure to delete') ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
          <a  class="btn btn--danger text-light">@lang('Delete')</a>
        </div>
      </div>
    </div>
  </div>
  
  
@endsection

@push('breadcrumb-plugins')

    
      <div class="d-flex flex-row-reverse bd-highlight ">
        <div class="p-2 bd-highlight">
          <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Search Donation by Trx')" value="" id="myInput">
            <div class="input-group-append" >
                <span class="bg--primary px-3"><i class="fa fa-search mt-2"></i></span>
            </div>
        </div>
        </div>
        
      </div>
   
@endpush  


@push('script')

    <script>
      'use strict';

      $('.deactivateBtn').on('click',function(){
        $('#modalDelete').find('a').attr('href',$(this).data('src'));
        $('#modalDelete').modal('show');


      })
      $("#myInput").on("keyup", function() {

    var value = $(this).val().toLowerCase();

    $("#myTable .filt").filter(function() {
      
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    });
    </script>

@endpush
