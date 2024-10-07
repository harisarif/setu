@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
            <div class="row mb-none-30">
                <div class="col-lg-4 col-md-4 mb-30">
                <div class="card">
                    <div class="card-body text-center border-bottom">
                        <img src="{{getImage(imagePath()['success']['path'].'/'.$success->image)}}" alt="profile-image" class="user-image">
                        <h5 class="card-title mt-3"></h5>
                        <p class="card-text font-weight-bold">{{$success->title}}</p>
                    </div>
                    <div class="card-body">
                    <p class="clearfix">
                        <span class="float-left">@lang('Category')</span>
                        <span class="float-right text-muted text--small badge font-weight-normal badge--success">{{@$success->category->name}}</span>
                    </p>

                    <p class="clearfix mt-4">
                        <span class="float-left">@lang('Created')</span>
                        <span class="float-right text-muted text--small badge font-weight-normal badge--success">{{$success->created_at->diffforhumans()}}</span>
                    </p>

                    <p class="clearfix mt-4">
                        <span class="float-left">@lang('Total Review')</span>
                    <span class="float-right text-muted text--small badge font-weight-normal badge--success">{{$success->comment->count()}}</span>
                    </p>
                   
                    </div>
                </div>
                </div>
                <div class="col-lg-8 col-md-8 mb-30">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title mb-25 border-bottom pb-2">@lang('Details Of Success Story')</h5>
                   
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <p class="text-justify">{{$success->details}}</p>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
            </div>
    </div>
</div>

@endsection


@push('breadcrumb-plugins')
<div class="d-flex flex-row-reverse bd-highlight ">
  <div class="p-2 bd-highlight">
  <a href="{{url()->previous()}}" class="btn btn--primary"> <i class="fas fa-reply"></i> @lang('Back')</a>
  </div>
  
</div>
@endpush

