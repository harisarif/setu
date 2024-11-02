<?php
    $data = getContent('breadcumb.content',true);
    $texture = getContent('breadcumb.element',true);

?>
 <!-- inner-page-hero start -->
<section class="inner-page-hero bg_img" data-background="<?php echo e(get_image('assets/images/frontend/breadcumb/'.@$data->data_values->image)); ?>">
    <div class="bottom-shape"><img src="<?php echo e(asset($activeTemplateTrue.'images/top-shape.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
        <h2 class="page-title"><?php echo e(__($page_title)); ?></h2>
          <ul class="page-list justify-content-center">
          <li><a href="<?php echo e(route('user.home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
          <li class="active"><?php echo e(__($page_title)); ?></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- inner-page-hero end -->
<?php /**PATH C:\laragon\www\setu-github\setu\core\resources\views/templates/basic/sections/breadcumb.blade.php ENDPATH**/ ?>