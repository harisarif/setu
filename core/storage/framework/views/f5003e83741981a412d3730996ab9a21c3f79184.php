<?php $__env->startSection('panel'); ?>
    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('Gateway'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Supported Currency'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Enabled Currency'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td data-label="Gateway">
                                        <div class="user">
                                            <div class="thumb"><img src="<?php echo e(getImage(imagePath()['gateway']['path'].'/'. $gateway->image,'800x800')); ?>" alt="image"></div>
                                            <span class="name"><?php echo e($gateway->name); ?></span>
                                        </div>
                                    </td>


                                    <td data-label="Supported Currency">
                                        <?php echo e(count(json_decode($gateway->supported_currencies,true))); ?>

                                    </td>
                                    <td data-label="Enabled Currency">
                                        <?php echo e($gateway->currencies->count()); ?>

                                    </td>


                                    <td data-label="Status">
                                        <?php if($gateway->status == 1): ?>
                                            <span class="text--small badge font-weight-normal badge--success"><?php echo app('translator')->get('Active'); ?></span>
                                        <?php else: ?>
                                            <span class="text--small badge font-weight-normal badge--warning"><?php echo app('translator')->get('Disabled'); ?></span>
                                        <?php endif; ?>

                                    </td>
                                    <td data-label="Action">
                                        <a href="<?php echo e(route('admin.gateway.automatic.edit', $gateway->alias)); ?>"
                                            class="icon-btn editGatewayBtn" data-toggle="tooltip" title="" data-original-title="Edit">
                                            <i class="la la-pencil"></i>
                                        </a>


                                        <?php if($gateway->status == 0): ?>
                                            <button data-toggle="modal" data-target="#activateModal"
                                                    class="icon-btn bg--success ml-1 activateBtn"
                                                    data-code="<?php echo e($gateway->code); ?>"
                                                    data-name="<?php echo e($gateway->name); ?>" data-original-title="Enable">
                                                <i class="la la-eye"></i>
                                            </button>
                                        <?php else: ?>
                                            <button data-toggle="modal" data-target="#deactivateModal"
                                               class="icon-btn bg--danger ml-1 deactivateBtn"
                                               data-code="<?php echo e($gateway->code); ?>"
                                               data-name="<?php echo e($gateway->name); ?>" data-original-title="Disable">
                                                <i class="la la-eye-slash"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%"><?php echo e($empty_message); ?></td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>


    </div>



    
    <div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Payment Method Activation Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.gateway.automatic.activate')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="code">
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to activate'); ?> <span class="font-weight-bold method-name"></span> <?php echo app('translator')->get('method?'); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>

                        <button type="submit" class="btn btn--primary"><?php echo app('translator')->get('Activate'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div id="deactivateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Payment Method Disable Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.gateway.automatic.deactivate')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="code">
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to disable'); ?> <span class="font-weight-bold method-name"></span> <?php echo app('translator')->get('method?'); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn--danger"><?php echo app('translator')->get('Disable'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $(document).on('click','.activateBtn',function () {
            var modal = $('#activateModal');
            modal.find('.method-name').text($(this).data('name'));
            modal.find('input[name=code]').val($(this).data('code'));
        });

        $(document).on('click','.deactivateBtn',function () {
            var modal = $('#deactivateModal');
            modal.find('.method-name').text($(this).data('name'));
            modal.find('input[name=code]').val($(this).data('code'));
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/admin/gateway/list.blade.php ENDPATH**/ ?>