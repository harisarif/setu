@extends($activeTemplate.'layouts.frontend')


@section('content')


<!-- privacy section start -->
<section class="pt-90 pb-90">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 order-lg-1 order-2">
          <div class="content-block" id="one">
          <p><?= $data->data_values->description ?></p>
            
          </div><!-- content-block end -->
        </div>
        
      </div>
    </div>
  </section>
  <!-- privacy section end -->

@endsection