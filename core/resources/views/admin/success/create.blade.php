@extends('admin.layouts.app')
@section('panel')

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group ">
                      <div class="image-upload">
                          <div class="thumb">
                              <div class="avatar-preview">
                                  <div class="row">
                                      <div class="col-sm-12">
                                          <div class="profilePicPreview logoPicPrev" style="background-size: 100%;background-image: url({{ getImage('image') }})">
                                              <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                          </div>
                                      </div>
                                     
                                  </div>
                              </div>
                              <div class="avatar-edit">
                                  <input type="file" class="profilePicUpload" id="profilePicUpload1" accept=".png, .jpg, .jpeg" name="file" required>
                                  <label for="profilePicUpload1" class="bg-primary">@lang('Upload Story Image') </label>
                              </div>
                          </div>
                      </div>

                  </div>
                  </div>



                  <div class="col-md-8">

                    <div class="form-group">
                      <label for="">@lang('Select Category For Blog')</label>
                      <select class="form-control" name="category" id="" required>
                          <option value="" selected>--@lang('Select Category')--</option>
                        @foreach($category  as  $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="">@lang('Title For Success')</label>
                      <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="Title for Blog" required>
                      
                    </div>

                    <div class="form-group">
                      <label for="description">@lang('Short Description')</label>
                      <textarea class="form-control" name="short_description" id="" rows="5" placeholder="Short Description"></textarea>
                    </div>

                    <div class="form-group">
                      <label for="description">@lang('Description')</label>
                      <textarea class="form-control nicEdit" name="description" id="" rows="8"></textarea>
                    </div>

                  </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="form-control btn btn--primary">@lang('Create Success Story')</button>
                </div>

            </form>
              
          </div>
      </div><!-- card end -->
  </div>
  </div>

  
  
@endsection

