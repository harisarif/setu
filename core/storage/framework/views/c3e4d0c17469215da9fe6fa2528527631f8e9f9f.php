<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8 shadow p-5">
            <h3 class="text-center pb-4"><?php echo e(__($page_title)); ?></h3>
            <form method="post" action="">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <input name="name" type="text" placeholder="<?php echo app('translator')->get('Your Name'); ?>" class="form-control"
                           value="<?php echo e(old('name')); ?>" required>
                </div>
                <div class="form-group">
                    <input name="email" type="text" placeholder="<?php echo app('translator')->get('Enter E-Mail Address'); ?>" class="form-control"
                           value="<?php echo e(old('email')); ?>" required>
                </div>

                <div class="form-group">
                    <input name="subject" type="text" placeholder="<?php echo app('translator')->get('Write your subject'); ?>" class="form-control"
                           value="<?php echo e(old('subject')); ?>" required>
                </div>


                <div class="form-group">
                    <textarea name="message" wrap="off" placeholder="<?php echo app('translator')->get('Write your message'); ?>"
                              class="form-control"><?php echo e(old('message')); ?></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success"><?php echo app('translator')->get('Create Ticket'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate.'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/contact.blade.php ENDPATH**/ ?>