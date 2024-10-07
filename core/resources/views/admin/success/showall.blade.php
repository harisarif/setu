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
                          <th>@lang('Category')</th>
                          <th>@lang('Title')</th>
                          <th>@lang('Image')</th>
                          <th>@lang('Action')</th>
                      </tr>
                      </thead>
                      <tbody class="list">
                      @forelse($success as $key => $story)
                          <tr class="filt">
                              <td data-label="@lang('Serial')">{{++$key}}</td>
                              <td data-label="@lang('Category')">{{@$story->category->name}}</td>
                              <td data-label="@lang('Title')">{{shortDescription($story->title,30)}}</td>
                              <td data-label="@lang('User')">
                                <div class="user">
                                    <div class="thumb"><img src="{{ asset(imagePath()['success']['path']).'/'.$story->image}}" alt="image"></div>
                                   
                                </div>
                            </td>
                              <td data-label="@lang('Action')">
                              
                              <a href="{{route('admin.success.details',['slug'=>$story->slug, 'id' => $story->id])}}" class="icon-btn editmodal mr-1" title="Details" data-original-title="Details" >
                                  <i class="las la-desktop text--shadow"></i>
                              </a>

                              <a href="{{route('admin.success.edit',['slug'=>$story->slug, 'id' => $story->id])}}" class="icon-btn editmodal" title="Edit" data-original-title="Edit">
                                    <i class="las la-pen text--shadow"></i>
                                </a>

                            <a href="javascript:void(0)" data-src="{{route('admin.success.delete',$story->slug)}}" class="icon-btn editmodal ml-1 bg-danger delete" title="Delete" data-original-title="delete">
                                    <i class="las la-trash text--shadow"></i>
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
            {{ $success->links('admin.partials.paginate') }}
        </div>
      </div><!-- card end -->
  </div>
  </div>


  <div class="modal fade" tabindex="-1" role="dialog" id="modalDelete">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">@lang('Delete Success Story')</h5>
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


@push('style')
    <style>
      table .user {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        justify-content: center;
    }
    </style>
@endpush

@push('breadcrumb-plugins')
<div class="d-flex flex-row-reverse bd-highlight ">
  <div class="p-2 bd-highlight">
    <div class="input-group has_append">
      <input type="text" name="search" class="form-control" placeholder="Search Success story" value="" id="myInput">
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

      $('.delete').on('click',function(){
        $('#modalDelete').find('a').attr('href',$(this).data('src'));
        $('#modalDelete').modal('show');


      });
      $("#myInput").on("keyup", function() {

        var value = $(this).val().toLowerCase();

        $("#myTable .filt").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
});
    </script>

@endpush
