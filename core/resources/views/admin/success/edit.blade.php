@extends('admin.layouts.app')
@section('panel')

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
            <input type="hidden" name="success" value="{{$success->id}}">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group ">
                  <div class="image-upload">
                      <div class="thumb">
                          <div class="avatar-preview">
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="profilePicPreview logoPicPrev" style="background-size: 100%;background-image: url({{getImage(imagePath()['success']['path'].'/'.$success->image)}})">
                                          <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                      </div>
                                  </div>
                                 
                              </div>
                          </div>
                          <div class="avatar-edit">
                              <input type="file" class="profilePicUpload" id="profilePicUpload1" accept=".png, .jpg, .jpeg" name="file" >
                              <label for="profilePicUpload1" class="bg-primary">@lang('Update Story Image') </label>
                          </div>
                      </div>
                  </div>

              </div>
              </div>


              <div class="col-md-8">

                <div class="form-group">
                  <label for="">@lang('Select Category For Blog')</label>
                  <select class="form-control" name="category" id="">
                      
                    @foreach($category  as  $cat)
                        <option value="{{$cat->id}}" {{$cat->id == $success->category_id ? 'selected':''}}>{{$cat->name}}</option>
                    @endforeach
                  </select>
                </div>


                <div class="form-group">
                  <label for="">@lang('Title For Success')</label>
                <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="Title for Blog" value="{{$success->title}}">
                  
                </div>

                <div class="form-group">
                      <label for="description">@lang('Short Description')</label>
                      <textarea class="form-control" name="short_description" id="" rows="5" placeholder="Short Description">{{$success->short_description}}</textarea>
                  </div>

                <div class="form-group">
                  <label for="description">@lang('Description')</label>
                  <textarea class="form-control nicEdit" name="description" id="">{{$success->details}}</textarea>
                </div>

              </div>
            </div>

                <div class="form-group">
                    <button type="submit" class="form-control btn btn--primary">@lang('Update Success Story')</button>
                </div>

            </form>
              
          </div>
      </div><!-- card end -->
  </div>
  </div>

  
  
@endsection

@push('style')
      <style>
        .niceEdit-main{
          width: 1028px;
          margin: 4px;
          max-height: 175px !important; 
          overflow: scroll !important;
        }
      </style>
@endpush


@push('script')
<script>
  'use strict';
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});

$(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
   

@endpush
