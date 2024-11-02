<?php
    $content = getContent('story.content',true);
    $element = getContent('story.element',false);
    
?>
<!-- story section start -->
<section class="pt-150 pb-150">
    <div class="container">
      <div class="row no-gutters">
        
        <div class="col-lg-6">
          <div class="story-thumb">
            <div class="story-thumb-slider">
              <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $el): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="single-slide">
              <img src="<?php echo e(get_image('assets/images/frontend/story/'.$el->data_values->image)); ?>" alt="<?php echo app('translator')->get('image'); ?>">
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
        
        <div class="col-lg-6 right position-relative base--bg text-center">
        <div class="section-img"><img src="<?php echo e(get_image($activeTemplateTrue.'images/texture-3.jpg')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></div>
          <div class="story-content">
          <h2 class="mb-50 text-white"><?php echo e(__($content->data_values->heading)); ?></h2>
            <div class="story-slider">
              <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $el): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="single-slide">
              <h3 class="text-white mb-3"><?php echo e(__($el->data_values->title)); ?></h3>
              <p class="text-white"><?php echo e(__($el->data_values->description)); ?></p>
              </div><!-- single-slide end -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             
            </div><!-- story-slider end -->
          </div>
        </div>
      </div><!-- row end -->
    </div>
  </section>
  <!-- story section end --><?php /**PATH C:\laragon\www\setu-github\setu\core\resources\views/templates/basic/sections/story.blade.php ENDPATH**/ ?>