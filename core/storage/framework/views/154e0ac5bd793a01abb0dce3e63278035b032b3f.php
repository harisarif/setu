<?php
    $about = getContent('about.content','true');
    $aboutel = getContent('about.element',false);
    $team = getContent('team.content',true);
?>

<?php $__env->startSection('content'); ?>

<!-- about section start -->
<section class="pb-0 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="about-thumb pb-150">
          <div class="thumb-one wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s"><img src=" <?php echo e(get_image('assets/images/frontend/about/'.$about->data_values->image)); ?>" alt="<?php echo app('translator')->get('image'); ?>" class="w-100"></div>
           
          </div>
        </div>
        <div class="col-lg-6 mt-lg-0 mt-5 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s">
          <div class="section-content pl-lg-4 pl-0">
            <h2 class="section-title mb-20"><?php echo e(__($about->data_values->heading)); ?></h2>
            <p><?php echo __($about->data_values->description) ?></p>
            
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- about section end -->


<!-- mission vission section start -->
<section class="pt-150 pb-150 section--bg">
    <div class="container">
    <?php $__currentLoopData = $aboutel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $about): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="row">
      <div class="<?php echo e($loop->odd ? 'col-lg-6 order-lg-2 order-2 mt-lg-0':'col-lg-6 order-lg-2 order-1'); ?>">
      <div class="<?php echo e($loop->odd ? 'section-content pl-lg-4':'section-content pl-lg'); ?>">
          <h2 class="section-title mb-20"><?php echo e(__($about->data_values->heading)); ?></h2>
          <p class="text-justify"> <?php echo  __($about->data_values->description) ?> </p>
          </div><!-- section-content end -->
        </div>
    <div class="<?php echo e($loop->odd ? 'col-lg-6 order-lg-2 order-1':'col-lg-6 order-1'); ?>">
        <img src="<?php echo e(get_image('assets/images/frontend/about/'.$about->data_values->image)); ?>" alt="<?php echo app('translator')->get('image'); ?>" class="w-100">
        </div>
      </div><!-- row end -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

     
    </div>
  </section>
  <!-- mission vission section end -->

<?php $__env->stopSection(); ?>


<?php $__env->startPush('style'); ?>
  <style>
      .order-1{
        margin-bottom:90px !important;  
      }
    
    
  </style>    
<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate.'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/about/about.blade.php ENDPATH**/ ?>