<?php $__env->startSection('panel'); ?>

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body p-0">

                    <div class="table-responsive--md table-responsive">
                        <table class=" table align-items-center table--light" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col"><?php echo app('translator')->get('User'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('Category'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('Title'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('Goal'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('Deadline'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $__empty_1 = true; $__currentLoopData = $campaign; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $camp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="filt">

                                        <td data-label="<?php echo app('translator')->get('User'); ?>">
                                            <a href="<?php echo e(route('admin.users.detail', $camp->user->id)); ?>"><?php echo e(@$camp->user->firstname); ?>

                                                <?php echo e($camp->user->lastname); ?></a>
                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Category'); ?>"><?php echo e(@$camp->category->name); ?></td>
                                        <td data-label="<?php echo app('translator')->get('Title'); ?>"><?php echo e(shortDescription($camp->title, 30)); ?></td>
                                        <td data-label="<?php echo app('translator')->get('Goal'); ?>"><?php echo e($general->cur_sym); ?> <?php echo e($camp->goal); ?></td>
                                        <td data-label="<?php echo app('translator')->get('Deadline'); ?>"><?php echo e($camp->deadline); ?></td>
                                        <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                            <?php if($camp->rejected == 0): ?>
                                                <span
                                                    class="text--small badge font-weight-normal <?php echo e($camp->approval ? 'badge--success' : 'badge--danger'); ?>"><?php echo e($camp->approval ? 'Approved' : 'Pending'); ?></span>
                                            <?php else: ?>
                                                <span
                                                    class="text--small badge font-weight-normal <?php echo e($camp->rejected ? 'badge--danger' : 'badge--danger'); ?>"><?php echo e($camp->rejected ? 'Rejected' : 'Rejected'); ?></span>
                                            <?php endif; ?>

                                        </td>
                                        <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                            <a href="<?php echo e(route('admin.fundrise.edit', ['slug' => $camp->slug, 'id' => $camp->id])); ?>"
                                                class="icon-btn">
                                                <i class="las la-edit text--shadow"></i>
                                            </a>
                                            <?php if($camp->approval != 1): ?>
                                                <a href="javascript:void(0)" class="icon-btn btn--danger deactivateBtn  ml-1"
                                                    data-toggle="tooltip" title="" data-original-title="delete"
                                                    data-src=<?php echo e(route('admin.fundrise.delete', ['slug' => $camp->slug, 'id' => $camp->id])); ?>>
                                                    <i class="la la-trash"></i>
                                                </a>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="100%" class="text-muted text-center"><?php echo app('translator')->get($empty_message); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>


                    </div>
                </div>
 <?php if($campaign->hasPages()): ?>
                <div class="card-footer py-4">
                    <?php echo e($campaign->links('admin.partials.paginate')); ?>

                </div>
            <?php endif; ?>
            </div><!-- card end -->
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="modalDelete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Delete Fund Request'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="font-weight-bold"><?php echo app('translator')->get('Are you Sure to delete ?'); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <a class="btn btn--danger text-light"><?php echo app('translator')->get('Delete'); ?></a>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <div class="d-flex flex-row-reverse bd-highlight ">
        <div class="p-2 bd-highlight">
            <div class="input-group has_append">
                <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Search Campaign'); ?>" value=""
                    id="myInput">
                <div class="input-group-append">
                    <span class="bg--primary px-3"><i class="fa fa-search mt-2"></i></span>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script'); ?>

    <script>
        'use strict';
        
        $('.deactivateBtn').on('click', function() {
            $('#modalDelete').find('a').attr('href', $(this).data('src'));
            $('#modalDelete').modal('show');

        });


        $("#myInput").on("keyup", function() {

            var value = $(this).val().toLowerCase();

            $("#myTable .filt").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/admin/fundrise/fundreq.blade.php ENDPATH**/ ?>