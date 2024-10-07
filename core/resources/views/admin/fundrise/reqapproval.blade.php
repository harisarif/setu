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
                          <th>@lang('Serial')</th>
                          <th>@lang('User')</th>
                          <th>@lang('Category')</th>
                          <th>@lang('Title')</th>
                          <th>@lang('Goal')</th>
                          <th>@lang('Deadline')</th>
                          <th>@lang('Status')</th>
                          <th>@lang('Action')</th>
                      </tr>
                      </thead>
                      <tbody class="list">
                      @forelse($update as $key => $camp)
                          <tr class="filt">
                              <td data-label="@lang('Serial')">{{++$key}}</td>
                              <td data-label="@lang('User')">{{$camp->user->firstname}} {{$camp->user->lastname}}</td>
                              <td data-label="@lang('Category')">{{$camp->category->name}}</td>
                              <td data-label="@lang('Title')">
                              <a href="{{route('admin.fundrise.edit',['slug'=>@$camp->campaign->slug,'id'=>@$camp->campaign->id])}}">{{$camp->title}}</a> 
                              </td>
                              <td data-label="@lang('Goal')">{{$camp->goal}}</td>
                              <td data-label="@lang('Deadline')">{{$camp->deadline}}</td>
                              <td data-label="@lang('Status')">
                               
                                <span class="text--small badge font-weight-normal {{$camp->rejected ? "badge--danger" :( $camp->approval ? 'badge--success':'badge--danger')}}">{{$camp->rejected ? "Rejected" : ($camp->approval ? 'Approved':'Pending')}}</span></td>
                              <td data-label="@lang('Action')">
                            @if($camp->rejected == 0)
                              <a href="{{route('admin.fundrise.request.edit',['slug'=>$camp->slug , 'id' => $camp->id])}}" class="icon-btn">
                                    <i class="las la-edit text--shadow"></i>
                                </a>
                            @endif
                                <a href="javascript:void(0)" class="icon-btn btn--danger deactivateBtn  ml-1" data-toggle="tooltip" title="" data-original-title="delete" data-src={{route('admin.fundrise.request.delete',['slug'=>$camp->slug , 'id' => $camp->id])}}>
                                    <i class="la la-trash"></i>
                                </a>

                                            
                              </td>
                          </tr>
                      @empty
                          <tr>
                              <td colspan="100%" class="text-muted text-center">@lang('No shortcode available')</td>
                          </tr>
                      @endforelse
                      </tbody>
                  </table>

                  
              </div>
          </div>

          <div class="card-footer py-4">
            {{ $update->links('admin.partials.paginate') }}
        </div>
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
      <input type="text" name="search" class="form-control" placeholder="@lang('Search Campaign')" value="" id="myInput">
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

    </script>

@endpush
