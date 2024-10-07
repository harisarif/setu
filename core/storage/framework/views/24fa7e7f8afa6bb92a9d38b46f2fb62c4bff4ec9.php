<?php
 
    $about = getContent('about.content','true');
?>


<!-- about section start -->
<section class="pb-150 about-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="about-thumb pb-150">
          <div class="thumb-one wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s"><img src=" <?php echo e(asset('assets/images/frontend/about/'.$about->data_values->image)); ?>" alt="<?php echo app('translator')->get('image'); ?>" class="w-100"></div>
           
          </div>
        </div>
        <div class="col-lg-6 mt-lg-0 mt-5 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s">
          <div class="section-content pl-lg-4 pl-0">
          <h2 class="section-title mb-20"><?php echo e(__($about->data_values->heading)); ?></h2>
            <p><?php echo __($about->data_values->description) ?></p>
           
            <div class="btn-group justify-content-start mt-30">
            <a href="<?php echo e(route('user.about')); ?>" class="cmn-btn"><?php echo app('translator')->get('Learn More'); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- about section end -->


  <?php $__env->startPush('style'); ?>
    <style>
      
      .about-section{
        padding-bottom: 0px;
      }  
      
    </style>  
  <?php $__env->stopPush(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/sections/about.blade.php ENDPATH**/ ?>