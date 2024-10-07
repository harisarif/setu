<?php $__env->startSection('content'); ?>


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

<?php $__env->stopSection(); ?>
<?php echo $__env->make($activeTemplate.'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/sections/terms.blade.php ENDPATH**/ ?>