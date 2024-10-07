@extends($activeTemplate.'layouts.master')


@section('content')

<section class="pt-90 pb-90">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7 shadow p-5">
            <h3>@lang('Request Edit For This Campaign')</h3>
          <div class="login-area">
              <form action="" class="action-form mt-50" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <input type="hidden" value="{{$campaign->category_id}}" name="category_id">

                    <div class="col">
                      <div class="form-group">
                          <label>@lang('Goal')</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fas fa-money-check-alt"></i></div>
                            </div>
                            <input type="number" name="goal" required placeholder="@lang('Your goal')" value="{{$campaign->goal}}" class="form-control">
                          </div>
                        </div><!-- form-group end -->
                    </div>

                </div>
               


                  <div class="form-group mt-3">
                    <label>@lang('Title')</label>
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-heading"></i></div>
                      </div>
                        <input type="text" name="title" required placeholder="@lang('Title')" value="{{$campaign->title}}" class="form-control">
                    </div>
                  </div><!-- form-group end -->



                  <div class="form-group">
                    <label>@lang('Description')</label>
                    
                    <textarea name="description" id="" cols="30" rows="5" required class="form-control mb-2" placeholder="@lang('Write your Description for Fundrise')">{{$campaign->description}}</textarea>
                   
                  </div><!-- form-group end -->


                  <div class="row">
                    <div class="col">
                        <div class="form-group mt-4">
                            <label>@lang('Deadline')</label>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                              </div>
                                     <input type="date" name="deadline" required placeholder="@lang('Date')" value="{{$campaign->deadline}}" class="form-control">
                            </div>
                          </div><!-- form-group end -->
                    </div>
                    
                  </div>

                  <div class="row mt-4">

                    <div class="col-md-5 ">
                      <div class="form-group">
                        <label>@lang('Image')</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-images"></i></div>
                          </div>
                          <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="validatedCustomFile">
                            <label class="custom-file-label" for="validatedCustomFile">@lang('Choose file')...</label>
                          </div>
                        </div>
                      </div><!-- form-group end -->
                    </div>


                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputAttachments">@lang('Prove')</label>
                        <input type="file"
                              name="attachments[]"
                              id="inputAttachments"
                              class="form-control"/>
                              
                        <div id="fileUploadsContainer"></div>
                        <p class="my-2 ticket-attachments-message text-muted text-small">
                            @lang("Allowed File Extensions: .jpg, .jpeg, .png, .pdf")
                        </p>
                    </div>                                    
                    </div>
                    <div class="col-md-1 mt-3">
                      <a href="javascript:void(0)"
                           class="btn btn-danger btn-round"
                           onclick="extraTicketAttachment()">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                  </div>
                
                  <div class="form-group mt-4">
                    <input type="submit" value="Request For Update" class="form-control custom-button">
                  </div>

              </form>
          </div>
        </div>

        <div class="col-md-5 pl-md-5 text-center">
            <div class="card shadow p-3">
              <div class="card-body">
                <h3>@lang('Current Image') :</h3>

              <img src="{{asset(imagePath()['campaign']['path'].'/'.$campaign->image)}}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
              
                <h4 class="card-title mt-3">
                  @lang('Current Attachement For This campaign')
                </h4>
                <ul class="nav nav-tabs nav-tabs--style" id="myTab" role="tablist">
                <li class="nav-item " role="presentation">
                  <a class="nav-link active" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false">@lang('Prof Image')</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="false">@lang('Prof Document')</a>
                </li>
              </ul>
            <div class="tab-content mt-4" id="myTabContent">
                <div class="tab-pane fade show active" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                  <div class="row mb-none-30">
  
                  @foreach(json_decode($campaign->image_prof) as $prof)
             
                  @if(explode('.',$prof)[1] == 'pdf')
                    
                    @else
                    
                      <div class="col-lg-4 col-sm-6 mb-30">
                          <div class="gallery-card">
                          <a href="{{asset(imagePath()['prof']['path'].'/'.$prof)}}" class="view-btn" data-rel="lightcase:myCollection:slideshow"><i class="las la-plus"></i></a>
                          <div class="gallery-card__thumb">
                              <img src="{{asset(imagePath()['prof']['path'].'/'.$prof)}}" alt="image">
                          </div>
                          </div><!-- gallery-card end -->
                      </div>
                    @endif
                    @endforeach
                  </div>
                </div><!-- tab-pane end -->
                <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                  @foreach(json_decode($campaign->image_prof) as $prof)
             
                  @if(explode('.',$prof)[1] == 'pdf')
                <iframe width="100%" height="400" src="{{asset(imagePath()['prof']['path'].'/'.$prof)}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  @else
                  @endif
                  @endforeach
                </div><!-- tab-pane end -->

               </div>
            </div>
                
              </div>
              {{-- Card body End --}}
            </div>
        </div>
      </div>
    </div>
</section>


@endsection

@push('style')

    <style>
        .nice-select {
            width: 85%;
        }

        .custom-check{
            width: 20px;
        }

        .margin--top{
            margin-top: 1.9rem!important;
        }

        a.btn.btn-danger.btn-round {
          margin-top: 21px;
        }

       .custom-button{
         background: #109452;
         color:#ffffff;
         font-weight: 600;
       }
    </style>
    
@endpush


@push('script')
    <script>
      'use strict';
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

function extraTicketAttachment() {
            $("#fileUploadsContainer").append('<input type="file" name="attachments[]" class="form-control mt-1" required />')
        }

        $('input[type=checkbox]').on('change',function(){
            if($(this).val() == 1){
              $(this).val(0);
            }else{
              $(this).val(1);
            }
            
        })
    </script>

    
@endpush