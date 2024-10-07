<?php
    $donation = $campaign->donation->where('payment_status',1)->sum('donation');

    $percent = ($donation * 100) / $campaign->goal;

?>
<?php $__env->startSection('content'); ?>
<!-- event details section start -->
<section class="pt-90 pb-90">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="event-details-wrapper">
            <div class="event-details-thumb">
            <img src="<?php echo e(get_image(imagePath()['campaign']['path'].'/'.$campaign->image)); ?>" alt="<?php echo app('translator')->get('image'); ?>">
            </div>
          </div><!-- event-details-wrapper end -->
          <div class="event-details-area mt-50">
            <ul class="nav nav-tabs nav-tabs--style" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true"><?php echo app('translator')->get('Description'); ?></a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false"><?php echo app('translator')->get('Relevent Image'); ?></a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="false"><?php echo app('translator')->get('Relevent Document'); ?></a>
              </li>

              <li class="nav-item" role="presentation">
                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false"><?php echo app('translator')->get('Review'); ?></a>
              </li>
            </ul>
            <div class="tab-content mt-4" id="myTabContent">
              <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <p class="text-justify"><?php echo e(__($campaign->description)); ?></p>
                
              </div><!-- tab-pane end -->
              <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                <div class="row mb-none-30">

                <?php $__currentLoopData = json_decode($campaign->image_prof); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           
                <?php if(explode('.',$prof)[1] == 'pdf'): ?>
                  <?php else: ?>
                    <div class="col-lg-4 col-sm-6 mb-30">
                        <div class="gallery-card">
                        <a href="<?php echo e(get_image(imagePath()['prof']['path'].'/'.$prof)); ?>" class="view-btn" data-rel="lightcase:myCollection:slideshow"><i class="las la-plus"></i></a>
                        <div class="gallery-card__thumb">
                            <img src="<?php echo e(get_image(imagePath()['prof']['path'].'/'.$prof)); ?>" alt="<?php echo app('translator')->get('image'); ?>">
                        </div>
                        </div><!-- gallery-card end -->
                    </div>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
              </div><!-- tab-pane end -->
              <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                <?php $__currentLoopData = json_decode($campaign->image_prof); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           
                <?php if(explode('.',$prof)[1] == 'pdf'): ?>
                  
                  <iframe width="100%" height="800" src="<?php echo e(get_image(imagePath()['prof']['path'].'/'.$prof)); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php else: ?>
                 
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div><!-- tab-pane end -->

              <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                <ul class="review-list mb-50">
                <?php $__empty_1 = true; $__currentLoopData = $campaign->comments->where('published',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <li class="single-review">
                    <div class="thumb"><i class="fa fa-user comment-user"></i></div>
                    <div class="content">
                    <h6 class="name mb-1"><?php echo e(__($comment->fullname)); ?></h6>
                    <span class="date"><?php echo e($comment->created_at->diffforhumans()); ?></span>
                      
                    <p class="mt-2 text-justify"><?php echo e(__($comment->details)); ?></p>
                    </div>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-center my-3"><?php echo app('translator')->get('No Review Is being placed Yet'); ?></p>
                  <?php endif; ?>
                </ul>
              <form action="<?php echo e(route('user.campaign.comment')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                  <div class="form-row">
                  <input type="hidden" name="campaign" value="<?php echo e($campaign->id); ?>">
                    <div class="form-group col-lg-6">
                      <input type="text" name="fullname" placeholder="<?php echo app('translator')->get('Full Name'); ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-6">
                      <input type="email" name="email" placeholder="<?php echo app('translator')->get('Email Address'); ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-12">
                      <textarea placeholder="<?php echo app('translator')->get('Review Text'); ?>" class="form-control" name="details"></textarea>
                    </div>
                    <div class="col-lg-12">
                      <button type="submit" class="cmn-btn"><?php echo app('translator')->get('Submit Review'); ?></button>
                    </div>
                  </div>
                </form>
              </div><!-- tab-pane end -->
              
            </div>
          </div>
        </div>
        <div class="col-lg-4 mt-lg-0 mt-5">
          <div class="donation-sidebar">
            <div class="donation-widget">
            <p><?php echo e(shortDescription($campaign->title,80)); ?></p>
         
              <div class="skill-bar mt-4">
                <div class="progressbar" data-perc="<?php echo e($percent > 100 ? '100': $percent); ?>%">
                  <div class="bar"></div>
                  <span class="label"><?php echo e(number_format(($percent > 100 ? '100': $percent),2)); ?>%</span>
                </div>
              </div>
              <div class="row mt-2 justify-content-between">
                <div class="col-sm-6">
                  <b><?php echo e($general->cur_sym); ?> <?php echo e($campaign->donation->where('payment_status',1)->sum('donation')); ?></b> <?php echo app('translator')->get('Donated'); ?>
                </div>
                <div class="col-sm-6">
                <?php echo app('translator')->get('Goal Amount'); ?> <b><?php echo e($general->cur_sym); ?> <?php echo e(number_format($campaign->goal)); ?></b>
                </div>
              </div>
              <div class="row mt-50 mb-none-30">
                <div class="col-6 donate-item text-center mb-30">
                <h4 class="amount"><?php echo e($campaign->donation->where('payment_status',1)->count()); ?></h4>
                  <p><?php echo app('translator')->get('Donors'); ?></p>
                </div>
                <div class="col-6 donate-item text-center mb-30">
                  <h4 class="amount"><?php echo e($general->cur_sym); ?> <?php echo e($campaign->donation->where('payment_status',1)->sum('donation')); ?></h4>
                  <p><?php echo app('translator')->get('Donated'); ?></p>
                </div>
              </div>
            </div><!-- donation-widget end -->
              <div class="donation-widget">
              <form class="vent-details-form" method="POST" action="">
                <?php echo csrf_field(); ?>
                <h3 class="mb-2"><?php echo app('translator')->get('Donate Amount'); ?></h3>
                <div class="form-row align-items-center">
                  <div class="col-lg-12 form-group">
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                      <div class="input-group-text"><?php echo e($general->cur_sym); ?></div>
                      </div>
                      <input type="number" id="donateAmount" class="form-control" value="0" name="amount" required> 
                    </div>
                  </div>
                  
                  <div class="col-12 form-group donated-amount">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="100">
                      <label class="custom-control-label" for="customRadioInline1"><?php echo e($general->cur_sym); ?><?php echo app('translator')->get('100'); ?></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="200">
                      <label class="custom-control-label" for="customRadioInline2"><?php echo e($general->cur_sym); ?><?php echo app('translator')->get('200'); ?></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="customRadioInline3" name="customRadioInline1" class="custom-control-input" value="300">
                      <label class="custom-control-label" for="customRadioInline3"><?php echo e($general->cur_sym); ?><?php echo app('translator')->get('300'); ?></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="customAmount" name="customRadioInline1" class="custom-control-input" value="300">
                      <label class="custom-control-label" for="customAmount"><?php echo app('translator')->get('custom'); ?></label>
                    </div>
                  </div>
                </div>
                <h3 class="mb-2 mt-30"><?php echo app('translator')->get('Personal Information'); ?></h3>

                <?php if(json_decode($general->anonymous)->status == 'on'): ?>
                <div class="d-flex flex-row">
                    <div class="align-self-start my-3">
                      <input type="checkbox" name="anonymous" id="checkdon" value="1">
                      
                    </div>

                    <div class="pl-3 my-3">
                      <label><?php echo app('translator')->get('Make anonymous Donation'); ?></label>
                    </div>
                </div>
                <?php endif; ?>

                <div class="form-row">
                  <div class="form-group col-lg-12">
                    <label class="text-small"><?php echo app('translator')->get('Full Name'); ?></label>
                    <input type="text" name="name" placeholder="First Name" class="form-control checktoggle"  required>
                  </div>

                  <div class="form-group col-lg-12">
                    <label class="text-small"><?php echo app('translator')->get('Email'); ?></label>
                    <input type="text" name="email" placeholder="Email Address" class="form-control checktoggle" required>
                  </div>

                  <div class="form-group col-lg-12">
                    <label class="text-small"><?php echo app('translator')->get('Mobile'); ?>: </label>
                    <input type="text" name="mobile" placeholder="Mobile Number" class="form-control checktoggle" required>
                  </div>

                  <div class="form-group col-lg-12">
                    <label class="text-small"><?php echo app('translator')->get('Country'); ?></label>
                    <input type="text" name="country" class="form-control checktoggle" placeholder="Country" required>
                  </div>

                  
                  <div class="col-lg-12">
                    <button type="submit" class="cmn-btn"><?php echo app('translator')->get('Donate Now'); ?></button>
                  </div>
                </div>
              </form>
            </div><!-- donation-widget end -->


            <div class="donation-widget">
              <h3><?php echo app('translator')->get('Event Share'); ?></h3>
              <div class="link-copy copy mt-3">
                <form>
                <input type="text" value="<?php echo e(route('user.campaign.details',['slug'=> $campaign->slug,'id'=>$campaign->id])); ?>" class="form-control">
                  <button type="button"><?php echo app('translator')->get('Copy'); ?></button>
                </form>
              </div>
              <ul class="social-links mt-4">
                <li class="facebook face"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>"><i class="fab fa-facebook-f"></i></a></li>
                <li class="twitter twi"><a href="https://twitter.com/intent/tweet?text=Post and Share &amp;url=<?php echo e(urlencode(url()->current())); ?>"><i class="fab fa-twitter"></i></a></li>
                <li class="linkedin lin"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(urlencode(url()->current())); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                <li class="whatsapp what"><a href="https://wa.me/?text=<?php echo e(urlencode(url()->current())); ?>"><i class="fab fa-whatsapp"></i></a></li>
              </ul>
            </div><!-- donation-widget end -->


          
            <div class="donation-widget pb-5">
              <h4 class="mb-4"><?php echo app('translator')->get('Latest Donation'); ?></h4>
              <ul class="donor-small-list">
                <?php $__empty_1 = true; $__currentLoopData = $campaign->donation->where('payment_status',1)->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="single">
                  <div class="thumb feature-card__icon "><i class="fa fa-user"></i></div>
                  <div class="content">
                  <h6><?php echo e($donor->fullname); ?></h6>
                  <p><?php echo app('translator')->get('Amount'); ?> : <?php echo e($general->cur_sym); ?><?php echo e($donor->donation); ?></p>
                  </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> 
                 <p><?php echo app('translator')->get('No Donor Found'); ?></p>
                <?php endif; ?>
              </ul>
             
            </div><!-- donation-widget end -->

            
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- event details section end -->


  
  <!-- Modal -->
  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title"><?php echo app('translator')->get('All Donor'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
         
            <div class="donation-widget pb-5">
              <ul class="donor-small-list">
                <?php $__empty_1 = true; $__currentLoopData = $campaign->donation->where('payment_status',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="single">
                  <div class="thumb feature-card__icon "><i class="fa fa-user"></i></div>
                  <div class="content">
                  <h6><?php echo e($donor->fullname); ?></h6>
                  <p><?php echo app('translator')->get('Amount'); ?> : $ <?php echo e($donor->donation); ?></p>
                  </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> 
                 <p><?php echo app('translator')->get('No Donor Found'); ?></p>
                <?php endif; ?>
              </ul>
            </div><!-- donation-widget end -->
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
          
        </div>
      </div>
    </div>
  </div>
  

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
  <style>
    .comment-user{
      font-size: 50px;
      color: #13c366;
      margin-top: 20px;
    padding-left: 50px;
    }
    .link-copy form {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
.link-copy input {
    width: calc(100% - 65px);
}
.link-copy button {
    width: 65px;
    background-color: #13c366;
    color: #ffffff;
    border-radius: 0 5px 5px 0;
    -webkit-border-radius: 0 5px 5px 0;
    -moz-border-radius: 0 5px 5px 0;
    -ms-border-radius: 0 5px 5px 0;
    -o-border-radius: 0 5px 5px 0;
}
.social-links {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin: -5px -5px;
}
.social-links li {
    margin: 5px 5px;
    width: 45px;
    height: 45px;
    background-color: #13c366;
    text-align: center;
    line-height: 45px;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
}
.social-links li.facebook {
    background-color: #3b5998;
}
.social-links li.twitter {
    background-color: #55acee;
}
.social-links li.linkedin {
    background-color: #0077b5;
}
.social-links li.whatsapp {
    background-color: #43d854;
}
.social-links li a {
    color: #ffffff;
    font-size: 18px;
}
    .custom-btn-color{
      background: #13c366;
      border:none;
      margin-left: 50%;
      margin-top: 32px;
    }
    .custom-btn-color:hover{
      background: #13c366;
      border:none;
    }
    .feature-card__icon {
    width: 75px;
    color: #13c366;
    font-size: 45px;
    line-height: 1;
    -webkit-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}


  </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
'use strict';

$('#checkdon').on('change',function(){
  var status = this.checked;
  if(status){
      $('.checktoggle').prop("disabled", true)
  } else{
    $('.checktoggle').prop("disabled", false)
  }
    
})


  $(".progressbar").each(function(){
	$(this).find(".bar").animate({
		"width": $(this).attr("data-perc")
	},3000);
	$(this).find(".label").animate({
		"left": $(this).attr("data-perc")
	},3000);
});


    $(".donated-amount input[type='radio']").each(function() {
      $(this).on('click', function(){
        var selValue = $(".donated-amount input[type='radio']:checked").val();
        $('#donateAmount').val(selValue);
       
      });

      $("#customAmount").on('click', function(){
        $('#donateAmount').focus();
        $('#donateAmount').val('');
      });
      $('#donateAmount').focus(function(){
        $('#donateAmount').val('');
        $("#customAmount").prop("checked", true);
      });
    });

    $('.donarModal').click(function(){
      $('#modelId').modal('show')
    })


    var copyButton = document.querySelector('.copy button');
    var copyInput = document.querySelector('.copy input');
    copyButton.addEventListener('click', function(e) {
      e.preventDefault();
      var text = copyInput.select();
      document.execCommand('copy');
    });
    copyInput.addEventListener('click', function() {
      this.select();
    });

    

  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate.'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/sections/details.blade.php ENDPATH**/ ?>