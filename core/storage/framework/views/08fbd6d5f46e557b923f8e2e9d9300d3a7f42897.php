<?php
    $volunteer = getContent('volunteer.content',true);
    $volunteers = App\Volunteer::where('status',1)->get();
?>
<!-- volunteer section start -->
    <section class="pt-150 pb-150">\
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="section-header text-center">
              <h2 class="section-title"><?php echo e(__(@$volunteer->data_values->title)); ?></h2>
              <p><?php echo e(__(@$volunteer->data_values->description)); ?></p>
            </div>
          </div>
        </div>
        <div class="row mb-none-30">
        <?php $__currentLoopData = $volunteers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="col-xl-3 col-sm-6 mb-30 wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
          <div class="volunteer-card hover--effect-1">
            <div class="volunteer-card__thumb">
              <img src="<?php echo e(getImage(imagePath()['volunteer']['path'].'/'.$item->image)); ?>" alt="image" class="w-100">
            </div>
            <div class="volunteer-card__content">
              <img src="<?php echo e(asset($activeTemplateTrue.'images/top-shape.png')); ?>" alt="image">
              <h4 class="name"><?php echo e($item->fullname); ?></h4>
              <span class="designation"><?php echo app('translator')->get("Participate {$item->participated} Campaigns"); ?></span>
            </div>
          </div><!-- volunteer-card end -->
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
      </div>
    </section>
    <!-- volunteer section end -->
<?php /**PATH D:\laragon\www\setu\situ_foundation\core\resources\views/templates/basic/sections/volunteer.blade.php ENDPATH**/ ?>