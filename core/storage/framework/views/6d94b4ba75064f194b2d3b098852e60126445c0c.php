<?php $__empty_1 = true; $__currentLoopData = $volunteers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-xl-3 col-sm-6 mb-30 ">
        <div class="volunteer-card hover--effect-1">
            <div class="volunteer-card__thumb">
                <img src="<?php echo e(getImage(imagePath()['volunteer']['path'] . '/' . $item->image)); ?>" alt="image"
                    class="w-100">
            </div>
            <div class="volunteer-card__content">
                <img src="<?php echo e(asset($activeTemplateTrue . 'images/top-shape.png')); ?>" alt="image">
                <h4 class="name"><?php echo e($item->fullname); ?></h4>
                <span class="designation"><?php echo app('translator')->get("Participate {$item->participated}
                    Campaigns"); ?></span>
            </div>
        </div><!-- volunteer-card end -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="py-4">
                <?php echo e($volunteers->links($activeTemplate . 'partials.paginate')); ?>

            </div>
        </div>
    </div><!-- row end -->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

    <div class="col-md-6 mx-auto">
        <div class="card shadow">

            <div class="card-header text-center bg-success">
                <h4 class="text-white"><i class="text-white far fa-sad-cry"></i> <?php echo app('translator')->get('Upps No Volunteer Found '); ?> <i
                        class="text-white far fa-sad-cry"></i></h4>
            </div>

            <div class="card-body text-center py-5">
                <a href="<?php echo e(url()->previous()); ?>" class="text-white btn btn-success"><?php echo app('translator')->get('back To Previous'); ?></a>
            </div>

        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/volunteer_partial_list.blade.php ENDPATH**/ ?>