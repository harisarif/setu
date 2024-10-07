<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center mt-5">
         <div class="table-responsive--md  table-responsive">
            <table class="table table-bordered table--light">
                <thead>
                    <tr class="bg-table-custom">
                        <th><?php echo app('translator')->get('Serial'); ?></th>
                        <th><?php echo app('translator')->get('Title'); ?></th>
                        <th><?php echo app('translator')->get('Goal'); ?></th>
                        <th><?php echo app('translator')->get('Fund Raised'); ?></th>
                        <th><?php echo app('translator')->get('Deadline'); ?></th>
                        <th><?php echo app('translator')->get('Status'); ?></th>
                        <th><?php echo app('translator')->get('Action'); ?></th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $campaign; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td data-label="<?php echo app('translator')->get('Serial'); ?>" ><?php echo e(++$key); ?></td>
                        <td data-label="<?php echo app('translator')->get('Title'); ?>" ><?php echo e(shortDescription($item->title,20)); ?></td>
                        <td data-label="<?php echo app('translator')->get('Goal'); ?>" ><?php echo e($general->cur_sym); ?> <?php echo e($item->goal); ?> </td>
                        <td data-label="<?php echo app('translator')->get('Fund Raised'); ?>" ><?php echo e($general->cur_sym); ?> <?php echo e($item->donation->sum('donation')); ?></td>
                        <td data-label="<?php echo app('translator')->get('Deadline'); ?>" ><?php echo e($item->deadline); ?></td>
                        <td data-label="<?php echo app('translator')->get('Status'); ?>" >
                            <?php if($item->complete_status == 1): ?>
                             <i class="fa fa-check"></i> <?php echo app('translator')->get('Completed'); ?>
                             <?php endif; ?>
                        </td>
                        <td  data-label="<?php echo app('translator')->get('Action'); ?>" class="text-center">
                        <a href="<?php echo e(route('user.campaign.view',['slug'=>$item->slug,'id'=>$item->id])); ?>"><i class="fa fa-eye"></i></a>
                        </td>
                        
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td data-label="<?php echo app('translator')->get('No Data'); ?>"  colspan="100%"><p class="text-center"><i class="fas fa-laugh"></i> <?php echo app('translator')->get('Campaign not Completed'); ?> <i class="fas fa-laugh"></i></p></td>
                </tr>
                    
                <?php endif; ?>
                </tbody>
                
            </table>
        </div>
    </div>
    <div class=" py-4">
        <?php echo e($campaign->links($activeTemplate.'partials.paginate')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        table tr td{
            white-space:nowrap;
        }
        .bg-table-custom{
            background: #16C26B;
            color:#ffffff;
            text-align: center;
        }
        i{
            color: #16C26B;
        }

        i.fa.fa-edit{
            font-size:25px;
            font-weight: bolder
        }

        

        .custom-font-success{
            color: #16C26B;
        }

        .custom-font-error{
            color: #E2B748;
        }

        .custom-font-reject{
            color: #FF031B;
        }

        .badge-primary{
            background: #16C26B;
            color:#ffffff;
            padding: 7px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/user/fundrise/complete.blade.php ENDPATH**/ ?>