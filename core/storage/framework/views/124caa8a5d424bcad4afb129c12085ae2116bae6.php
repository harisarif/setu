<?php $__env->startSection('panel'); ?>

<div class="row">
    <div class="col-lg-12">

      <div class="card">
          <div class="card-body p-0">

              <div class="table-responsive--md table-responsive">
                        <table class=" table align-items-center table--light" id="myTable">
                      <thead>
                      <tr>
                          
                          <th><?php echo app('translator')->get('Success Story'); ?></th>
                          <th><?php echo app('translator')->get('Name'); ?></th>
                          <th><?php echo app('translator')->get('Email'); ?></th>
                          <th><?php echo app('translator')->get('Details'); ?></th>
                          <th><?php echo app('translator')->get('Review Date'); ?></th>
                          <th><?php echo app('translator')->get('Status'); ?></th>
                          <th><?php echo app('translator')->get('Action'); ?></th>
                      </tr>
                      </thead>
                      <tbody class="list">
                      <?php $__empty_1 = true; $__currentLoopData = $comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $com): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                          <tr class="filt">
                             
                              <td data-label="<?php echo app('translator')->get('Success Story'); ?>">
                              <a href="<?php echo e(route('admin.success.details',['slug' => $com->blog->slug,'id'=>$com->blog->id])); ?>"><?php echo e(shortDescription($com->blog->title,20)); ?></a>  
                                </td>
                              <td data-label="<?php echo app('translator')->get('Name'); ?>"><?php echo e($com->name); ?></td>
                              <td data-label="<?php echo app('translator')->get('Email'); ?>"><?php echo e($com->email); ?></td>
                              <td data-label="<?php echo app('translator')->get('Details'); ?>"><?php echo e(Str::limit($com->messages,30)); ?></td>
                              <td data-label="<?php echo app('translator')->get('Review Date'); ?>"><?php echo e($com->created_at->diffForHumans()); ?></td>
                              <td data-label="<?php echo app('translator')->get('Status'); ?>">
                               
                                <span class="text--small badge font-weight-normal <?php echo e($com->status == 1 ? 'badge--success':($com->status == 2 ? "badge--danger":'badge--warning')); ?>"><?php echo e($com->status == 1 ? 'Published':($com->status == 2 ? 'Rejected': 'Pending')); ?></span>
                                
                                

                              </td>

                              <td data-label="<?php echo app('translator')->get('Action'); ?>">

                              <a href="javascript:void(0)" class="icon-btn btn--primary editbtn  ml-1" data-toggle="tooltip" title="" data-original-title="Edit" data-comment_id="<?php echo e($com->id); ?>" data-description="<?php echo e($com->messages); ?>" data-status = "<?php echo e($com->status); ?>" data-title = "<?php echo e($com->blog->title); ?>">
                                    <i class="la la-pen"></i>
                                </a>

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

          <div class="card-footer py-4">
            <?php echo e($comment->links('admin.partials.paginate')); ?>

        </div>
      </div><!-- card end -->
  </div>
  </div>



  
  
  <!-- Modal -->
  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
                  <div class="modal-header">
                          <h5 class="modal-title"></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                      </div>
              <div class="modal-body">
                  <div class="container-fluid">
                     <form action="" method="POST">
                         <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" id="comment_id">

                        <div class="form-group">
                            <label for="Description"><?php echo app('translator')->get('Comments Description'); ?></label>
                            <textarea name="details" cols="30" rows="10" class="form-control" readonly></textarea>
                        </div>


                        <div class="form-group">
                            <label for="Description"><?php echo app('translator')->get('Action For Comment'); ?></label>
                            <select name="status" id="" value="" class="form-control"> 
                                <option value="1"><?php echo app('translator')->get('Publised'); ?></option>
                                <option value="0"><?php echo app('translator')->get('Pending'); ?></option>
                                <option value="2"><?php echo app('translator')->get('Reject'); ?></option>
                            </select>
                        </div>


                        <div class="form-group">
                            <input type="submit" class="form-control btn btn--primary" value="Update">
                        </div>
                     </form>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
              </div>
          </div>
      </div>
  </div>
  
  

<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>
    
  <script>
      'use strict';
        $('.editbtn').on('click',function(){
            var modal = $('#modelId');
            modal.find("input[name=id]").val($(this).data('comment_id'));
            modal.find("select[name=status]").val($(this).data('status'));
            modal.find("textarea[name=details]").val($(this).data('description'));
            modal.find('.modal-title').text($(this).data('title'));
            modal.modal('show');
        })

        $("#myInput").on("keyup", function() {

            var value = $(this).val().toLowerCase();

            $("#myTable .filt").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
    });

  </script>

<?php $__env->stopPush(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>


<div class="d-flex flex-row-reverse bd-highlight ">
    <div class="p-2 bd-highlight">
      <div class="input-group has_append">
        <input type="text" name="search" class="form-control" placeholder="Search Review" value="" id="myInput">
        <div class="input-group-append" >
            <span class="bg--primary px-3"><i class="fa fa-search mt-2"></i></span>
        </div>
    </div>
    </div>
    
  </div>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/admin/success/review.blade.php ENDPATH**/ ?>