<?php $__env->startSection('panel'); ?>

    <div class="row">


        <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg--primary"><h4
                            class="card-title text-white"> <?php echo e(inputTitle($temp['name'])); ?> </h4></div>
                    <div class="card-body">
                        <img src="<?php echo e($temp['image']); ?>" alt="*" class="w-100">
                    </div>
                    <div class="card-footer">

                        <?php if($general->active_template == $temp['name']): ?>

                            <button type="submit" name="name" value="<?php echo e($temp['name']); ?>" class="btn btn--primary btn-block">
                                <?php echo app('translator')->get('SELECTED'); ?>
                            </button>
                        <?php else: ?>


								<form action="" method="post">
									<?php echo csrf_field(); ?>
									<button type="submit" name="name" value="<?php echo e($temp['name']); ?>" class="btn btn--success btn-block">
										<?php echo app('translator')->get('Select As Active'); ?>
									</button>
								</form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        <?php if($extra_templates): ?>
            <?php $__currentLoopData = $extra_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header bg--primary"><h4
                                class="card-title text-white"> <?php echo e(inputTitle($temp['name'])); ?> </h4></div>
                        <div class="card-body">
                            <img src="<?php echo e($temp['image']); ?>" alt="*" class="w-100">
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo e($temp['url']); ?>" target="_blank" class="btn btn--primary btn-block"><?php echo app('translator')->get('Get This'); ?></a>
                        </div>
                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/admin/frontend/templates.blade.php ENDPATH**/ ?>