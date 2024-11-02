<?php
    $content = getContent('cta.content',true);
    $texture = getContent('cta.element',true);

?>

<!-- cta section section start -->
<section class="pt-120 pb-150 position-relative bg_img overlay-one" data-background="<?php echo e(get_image('assets/images/frontend/cta/'.$content->data_values->image)); ?>">
<div class="bottom-shape"><img src="<?php echo e(asset($activeTemplateTrue.'images/top-shape.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center pb-90">
        <h2 class="text-white"><?php echo e(__($content->data_values->title)); ?></h2>
          <p class="text-white"><?php echo e(__($content->data_values->description)); ?></p>
        <a href="<?php echo e(route('volunteer')); ?>" class="cmn-btn mt-50"><?php echo e(__($content->data_values->button_title)); ?></a>
        </div>
      </div>
    </div>
  </section>
  <!-- cta section section end -->
<?php /**PATH C:\laragon\www\setu-github\setu\core\resources\views/templates/basic/sections/cta.blade.php ENDPATH**/ ?>