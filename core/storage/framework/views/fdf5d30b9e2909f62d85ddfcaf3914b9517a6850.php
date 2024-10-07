<?php $__env->startSection('panel'); ?>

  <div class="row">
    <div class="col-lg-12">
     
      <div class="card">
          <div class="card-body p-0">

              <div class="table-responsive--md table-responsive">
                        <table class=" table align-items-center table--light" id="myTable">
                      <thead>
                      <tr>
                          <th><?php echo app('translator')->get('Serial'); ?></th>
                          <th><?php echo app('translator')->get('Category'); ?></th>
                          <th><?php echo app('translator')->get('Title'); ?></th>
                          <th><?php echo app('translator')->get('Image'); ?></th>
                          <th><?php echo app('translator')->get('Action'); ?></th>
                      </tr>
                      </thead>
                      <tbody class="list">
                      <?php $__empty_1 = true; $__currentLoopData = $success; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                          <tr class="filt">
                              <td data-label="<?php echo app('translator')->get('Serial'); ?>"><?php echo e(++$key); ?></td>
                              <td data-label="<?php echo app('translator')->get('Category'); ?>"><?php echo e(@$story->category->name); ?></td>
                              <td data-label="<?php echo app('translator')->get('Title'); ?>"><?php echo e(shortDescription($story->title,30)); ?></td>
                              <td data-label="<?php echo app('translator')->get('User'); ?>">
                                <div class="user">
                                    <div class="thumb"><img src="<?php echo e(asset(imagePath()['success']['path']).'/'.$story->image); ?>" alt="image"></div>
                                   
                                </div>
                            </td>
                              <td data-label="<?php echo app('translator')->get('Action'); ?>">
                              
                              <a href="<?php echo e(route('admin.success.details',['slug'=>$story->slug, 'id' => $story->id])); ?>" class="icon-btn editmodal mr-1" title="Details" data-original-title="Details" >
                                  <i class="las la-desktop text--shadow"></i>
                              </a>

                              <a href="<?php echo e(route('admin.success.edit',['slug'=>$story->slug, 'id' => $story->id])); ?>" class="icon-btn editmodal" title="Edit" data-original-title="Edit">
                                    <i class="las la-pen text--shadow"></i>
                                </a>

                            <a href="javascript:void(0)" data-src="<?php echo e(route('admin.success.delete',$story->slug)); ?>" class="icon-btn editmodal ml-1 bg-danger delete" title="Delete" data-original-title="delete">
                                    <i class="las la-trash text--shadow"></i>
                                </a>

                              </td>
                              
                          </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <tr>
                              <td colspan="100%" class="text-muted text-center"><?php echo app('translator')->get('No shortcode available'); ?></td>
                          </tr>
                      <?php endif; ?>
                      </tbody>
                  </table>

                  
              </div>
          </div>

          <div class="card-footer py-4">
            <?php echo e($success->links('admin.partials.paginate')); ?>

        </div>
      </div><!-- card end -->
  </div>
  </div>


  <div class="modal fade" tabindex="-1" role="dialog" id="modalDelete">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo app('translator')->get('Delete Success Story'); ?></h5>
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


<?php $__env->startPush('style'); ?>
    <style>
      table .user {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        justify-content: center;
    }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<div class="d-flex flex-row-reverse bd-highlight ">
  <div class="p-2 bd-highlight">
    <div class="input-group has_append">
      <input type="text" name="search" class="form-control" placeholder="Search Success story" value="" id="myInput">
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

      $('.delete').on('click',function(){
        $('#modalDelete').find('a').attr('href',$(this).data('src'));
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\setu\situ_foundation\core\resources\views/admin/success/showall.blade.php ENDPATH**/ ?>