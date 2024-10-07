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
                          
                          <th>@lang('Campaign')</th>
                          <th>@lang('Fullname')</th>
                          <th>@lang('Email')</th>
                          <th>@lang('Details')</th>
                          <th>@lang('Review Date')</th>
                          <th>@lang('Status')</th>
                          <th>@lang('Action')</th>
                      </tr>
                      </thead>
                      <tbody class="list">
                      @forelse($comment as $key => $com)
                          <tr class="filt">
                              
                              <td data-label="@lang('Campaign')">
                              <a href="{{route('admin.fundrise.edit',['slug' => @$com->campaign->slug,'id'=>@$com->campaign->id])}}">{{shortDescription($com->campaign->title,20)}}</a>  
                                </td>
                              <td data-label="@lang('Fullname')">{{$com->fullname}}</td>
                              <td data-label="@lang('Email')">{{$com->email}}</td>
                              <td data-label="@lang('Details')">{{Str::limit($com->details,30)}}</td>
                              <td data-label="@lang('Review Date')">{{$com->created_at->diffForHumans()}}</td>
                              <td data-label="@lang('Status')"> 
                               
                                <span class="text--small badge font-weight-normal {{$com->published == 1 ? 'badge--success':($com->published == 2 ? "badge--danger":'badge--warning')}}">{{$com->published == 1 ? 'Published':($com->published == 2 ? 'Rejected': 'Pending')}}</span>
                                
                                

                              </td>

                              <td data-label="@lang('Action')">

                              <a href="javascript:void(0)" class="icon-btn btn--primary editbtn  ml-1" data-toggle="tooltip" title="" data-original-title="Edit" data-comment_id="{{$com->id}}" data-description="{{$com->details}}" data-title ="{{$com->campaign->title}}" data-status = "{{$com->published}}">
                                    <i class="la la-pen"></i>
                                </a>

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

          <div class="card-footer py-4">
            {{ $comment->links('admin.partials.paginate') }}
        </div>
      </div><!-- card end -->
  </div>
  </div>



  
  
  <!-- Modal -->
  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
                  <div class="modal-header">
                          <h5 class="modal-title"></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                      </div>
              <div class="modal-body">
                  <div class="container-fluid">
                     <form action="" method="POST">
                         @csrf
                        <input type="hidden" name="id" id="comment_id">

                        <div class="form-group">
                            <label for="Description">@lang('Comments Description')</label>
                            <textarea name="details" cols="30" rows="10" class="form-control" readonly></textarea>
                        </div>


                        <div class="form-group">
                            <label for="Description">@lang('Action For Comment')</label>
                            <select name="status" id="" value="" class="form-control"> 
                                <option value="1">@lang('Publised')</option>
                                <option value="0">@lang('Pending')</option>
                                <option value="2">@lang('Reject')</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <input type="submit" class="form-control btn btn--primary" value="Update">
                        </div>
                     </form>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
              </div>
          </div>
      </div>
  </div>
  
  

@endsection


@push('script')
    
  <script>
      'use strict';
        $('.editbtn').on('click',function(){
            var modal = $('#modelId');
            modal.find("input[name=id]").val($(this).data('comment_id'));
            modal.find("select[name=status]").val($(this).data('status'));
            modal.find("textarea[name=details]").val($(this).data('description'));
            modal.find('.modal-title').text($(this).data('title'));
            modal.modal('show');
        })

        $("#myInput").on("keyup", function() {

var value = $(this).val().toLowerCase();

$("#myTable .filt").filter(function() {
  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});

  </script>

@endpush


@push('breadcrumb-plugins')


<div class="d-flex flex-row-reverse bd-highlight ">
    <div class="p-2 bd-highlight">
      <div class="input-group has_append">
        <input type="text" name="search" class="form-control" placeholder="Search Review" value="" id="myInput">
        <div class="input-group-append" >
            <span class="bg--primary px-3"><i class="fa fa-search mt-2"></i></span>
        </div>
    </div>
    </div>
    
  </div>

@endpush