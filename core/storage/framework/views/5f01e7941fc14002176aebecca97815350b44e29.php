<?php $__env->startSection('panel'); ?>


    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col"><?php echo app('translator')->get('Name'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('Email'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('Phone'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('Joined At'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $volunteers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $volunteer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td data-label="<?php echo app('translator')->get('Name'); ?>">
                                            <div class="user">
                                                <div class="thumb">
                                                    <img src="<?php echo e(getImage(imagePath()['volunteer']['path'] . '/' . $volunteer->image, '100x100')); ?>"
                                                        alt="image">
                                                </div>
                                                <span class="name"><?php echo e($volunteer->fullname); ?></span>
                                            </div>
                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Email'); ?>">
                                            <?php echo e($volunteer->email); ?>

                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Phone'); ?>">
                                            <?php echo e($volunteer->phone); ?>

                                        </td>
                                        <td data-label="<?php echo app('translator')->get('status'); ?>">
                                            <?php if($volunteer->status == 1): ?>
                                                <span class="badge badge--success"><?php echo app('translator')->get('Approved'); ?></span>
                                            <?php elseif($volunteer->status == 2): ?>
                                                <span class="badge badge--danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                            <?php else: ?>
                                                <span class="badge badge--danger"><?php echo app('translator')->get('pending'); ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <td data-label="<?php echo app('translator')->get('Joined At'); ?>">
                                            <?php echo e($volunteer->created_at->format('Y-m-d')); ?>

                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                            <a class="icon-btn" href="<?php echo e(route('admin.volunteer.edit',$volunteer)); ?>"><i class="la la-pen"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="100%" class="text-center"><?php echo app('translator')->get('No Volunteer Found'); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($volunteers->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e($volunteers->links('admin.partials.paginate')); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
    <form action="<?php echo e(route('admin.volunteer.search')); ?>" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="email or phone" value="<?php echo e($search ?? ''); ?>">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\setu\situ_foundation\core\resources\views/admin/volunteer.blade.php ENDPATH**/ ?>