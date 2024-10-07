<?php $__env->startSection('panel'); ?>

  <div class="row">
    <div class="col-lg-12">
      
      <div class="card">
          <div class="card-body p-0">

              <div class="table-responsive--md table-responsive">
                        <table class=" table align-items-center table--light" id="myTable">
                      <thead>
                      <tr>
                          <th><?php echo app('translator')->get('Trx'); ?>.</th>
                          <th><?php echo app('translator')->get('Campaign'); ?></th>
                          <th><?php echo app('translator')->get('Full Name'); ?></th>
                          <th><?php echo app('translator')->get('Country'); ?></th>
                          <th><?php echo app('translator')->get('Email'); ?></th>
                          <th><?php echo app('translator')->get('Mobile'); ?></th>
                          <th><?php echo app('translator')->get('Donation'); ?></th>
                          <th><?php echo app('translator')->get('Payment Method'); ?></th>
                          <th><?php echo app('translator')->get('Payment Date'); ?></th>
                          <th><?php echo app('translator')->get('Status'); ?></th>
                          
                      </tr>
                      </thead>
                      <tbody class="list">
                      <?php $__empty_1 = true; $__currentLoopData = $donor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $don): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                          <tr class="filt">
                              <td data-label="<?php echo app('translator')->get('Trx'); ?>"><?php echo e(@$don->deposite->trx); ?></td>
                              <td data-label="<?php echo app('translator')->get('Campaign'); ?>"> 
                                <a href="<?php echo e(route('admin.fundrise.edit',['slug'=>@$don->campaign->slug,'id'=>@$don->campaign->id])); ?>"><?php echo e(shortDescription(@$don->campaign->title,20)); ?></a>
                              </td>
                              <td data-label="<?php echo app('translator')->get('Full Name'); ?>"><?php echo e($don->fullname); ?></td>
                              <td data-label="<?php echo app('translator')->get('Country'); ?>"><?php echo e($don->country); ?></td>
                              <td data-label="<?php echo app('translator')->get('Email'); ?>"><?php echo e($don->email); ?></td>
                              <td data-label="<?php echo app('translator')->get('Mobile'); ?>"><?php echo e($don->mobile); ?></td>
                              <td data-label="<?php echo app('translator')->get('Donation'); ?>"><?php echo e($general->cur_sym); ?> <?php echo e($don->donation); ?></td>
                              <td data-label="<?php echo app('translator')->get('Payment Method'); ?>">
                                <?php echo e(@App\Deposit::where('donation_id',$don->id)->first()->gateway->alias); ?>

                              </td>
                              <td data-label="<?php echo app('translator')->get('Payment Date'); ?>"><?php echo e($don->created_at->diffForHumans()); ?></td>
                              <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                <span class="text--small badge font-weight-normal <?php echo e($don->payment_status ? 'badge--success':'badge--danger'); ?>"><?php echo e($don->payment_status ? 'Complete':'Not Paid'); ?></span>
                                
                              </td>
                             
                              
                          </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <tr>
                              <td colspan="100%" class="text-muted text-center"><?php echo e($empty_message); ?></td>
                          </tr>
                      <?php endif; ?>
                      </tbody>
                  </table>

                  
              </div>
          </div>
     <?php if($donor->hasPages()): ?>
          <div class="card-footer py-4">
            <?php echo e($donor->links('admin.partials.paginate')); ?>

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
          <p class="font-weight-bold"><?php echo app('translator')->get('Are you Sure to delete'); ?> ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
          <a  class="btn btn--danger text-light"><?php echo app('translator')->get('Delete'); ?></a>
        </div>
      </div>
    </div>
  </div>
  
  
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>

    
      <div class="d-flex flex-row-reverse bd-highlight ">
        <div class="p-2 bd-highlight">
          <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Search Donation by Trx'); ?>" value="" id="myInput">
            <div class="input-group-append" >
                <span class="bg--primary px-3"><i class="fa fa-search mt-2"></i></span>
            </div>
        </div>
        </div>
        
      </div>
   
<?php $__env->stopPush(); ?>  


<?php $__env->startPush('script'); ?>

    <script>
      'use strict';

      $('.deactivateBtn').on('click',function(){
        $('#modalDelete').find('a').attr('href',$(this).data('src'));
        $('#modalDelete').modal('show');


      })
      $("#myInput").on("keyup", function() {

    var value = $(this).val().toLowerCase();

    $("#myTable .filt").filter(function() {
      
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\setu\situ_foundation\core\resources\views/admin/donation/donation.blade.php ENDPATH**/ ?>