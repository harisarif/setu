<?php $__env->startSection('panel'); ?>

  <div class="row">
    <div class="col-lg-12">
     
      <div class="card">
          <div class="card-body p-0">

              <div class="table-responsive--md table-responsive">
                  <table class="table table--light style--two" id="myTable">
                      <thead>
                      <tr>
                          
                          <th scope="col"><?php echo app('translator')->get('Name'); ?></th>
                          <th scope="col"><?php echo app('translator')->get('Image'); ?></th>
                          <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                          <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                      </tr>
                      </thead>
                      <tbody class="list">
                      <?php $__empty_1 = true; $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                          <tr class="filt">
                              
                              <td data-label="<?php echo app('translator')->get('Name'); ?>"><?php echo e($cat->name); ?></td>
                              <td data-label="<?php echo app('translator')->get('Image'); ?>">
                                <div class="user justify-content-center">
                                    <div class="thumb"><img src="<?php echo e(asset(imagePath()['category']['path']).'/'.$cat->icon); ?>" alt="image"></div>
                                   
                                </div>
                            </td>
                              <td data-label="<?php echo app('translator')->get('Status'); ?>"><span class="text--small badge font-weight-normal <?php echo e($cat->mode ? 'badge--success':'badge--danger'); ?>"><?php echo e($cat->mode ? 'Active':'Inactive'); ?></span></td>
                              <td data-label="<?php echo app('translator')->get('Action'); ?>">
                              <a href="javascript:void(0)" class="icon-btn editmodal" title="" data-original-title="Edit" data-id = <?php echo e($cat->id); ?> data-name = <?php echo e($cat->name); ?> data-mode = <?php echo e($cat->mode); ?> data-slug = <?php echo e($cat->slug); ?> data-action = "<?php echo e(route('admin.category.update',$cat->slug)); ?>" data-style = "<?php echo e(asset(imagePath()['category']['path']).'/'.$cat->icon); ?>">
                                  <i class="las la-edit text--shadow"></i>
                              </a>
                              </td>
                          </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <tr>
                              <td colspan="100%" class="text-muted text-center"><?php echo app('translator')->get($empty_mesasage); ?></td>
                          </tr>
                      <?php endif; ?>
                      </tbody>
                  </table>

                  
              </div>
          </div>

        <?php if($category->hasPages()): ?>
          <div class="card-footer py-4">
            <?php echo e($category->links('admin.partials.paginate')); ?>

        </div>
        <?php endif; ?>
      </div><!-- card end -->
  </div>
  </div>



  
  <!-- Modal -->
  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo app('translator')->get('Add Category'); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
         <form action="" method="POST" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group ">
                <div class="image-upload">
                    <div class="thumb">
                        <div class="avatar-preview">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="profilePicPreview logoPicPrev" style="background-size: 100%;background-image: url(<?php echo e(getImage('image')); ?>)">
                                        <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="avatar-edit">
                            <input type="file" class="profilePicUpload" id="profilePicUpload" accept=".png, .jpg, .jpeg" name="icon" required>
                            <label for="profilePicUpload" class="bg-primary"><?php echo app('translator')->get('Upload Category Image'); ?> </label>
                            <small class="text-danger"><?php echo app('translator')->get('Image will resized'); ?> <?php echo e($size); ?> <?php echo app('translator')->get('px'); ?></small>
                        </div>
                    </div>
                </div>

              </div>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                  <label for=""><?php echo app('translator')->get('Name:'); ?></label>
                  <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                </div>


                <div class="form-group">
                  <label for=""><?php echo app('translator')->get('Status:'); ?></label>
                  <select name="mode"  required class="form-control">
                    <option value=""><?php echo app('translator')->get('Select Status'); ?></option>
                    <option value="0"><?php echo app('translator')->get('Inactive'); ?></option>
                    <option value="1"><?php echo app('translator')->get('Active'); ?></option>
    
                  </select>
                </div>
            </div>
          </div>

          <div class="form-group">
            <input type="submit" class="form-control btn btn--primary" value="Add Category">
          </div>

         </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
        </div>
      </div>
    </div>
  </div>


  



  
  <!-- Modal -->
  <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title"><?php echo app('translator')->get('Update Category'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
          <div class="container-fluid">
          <form  method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <?php echo method_field('PUT'); ?>
              <input name="slug" class="btn btn-primary" type="hidden">
            <div class="row">
              <div class="col-md-5">
                <div class="form-group ">
                  <div class="image-upload">
                      <div class="thumb">
                          <div class="avatar-preview">
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="profilePicPreview logoPicPrev" style="background-size: 100%">
                                        
                                          <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                      </div>
                                  </div>
                                 
                              </div>
                          </div>
                          <div class="avatar-edit">
                              <input type="file" class="profilePicUpload" id="profilePicUpload1" accept=".png, .jpg, .jpeg" name="icon">
                              <label for="profilePicUpload1" class="bg-primary"><?php echo app('translator')->get('Upload Category Image'); ?> </label>
                              <small class="text-danger"><?php echo app('translator')->get('Image will resized'); ?> <?php echo e($size); ?> <?php echo app('translator')->get('px'); ?></small>
                          </div>
                      </div>
                  </div>

                </div>
              </div>
              <div class="col-md-7">

                  <div class="form-group">
                    <label for=""><?php echo app('translator')->get('Name'); ?>:</label>
                    <input type="text" name="name"  class="form-control"  aria-describedby="helpId">
                  </div>
                

                <div class="form-group">
                  <label for=""><?php echo app('translator')->get('Change Status'); ?>:</label>
                  <select name="mode"  class="form-control">
                    <option value="1"><?php echo app('translator')->get('Active'); ?></option>
                    <option value="0"><?php echo app('translator')->get('Inactive'); ?></option>
                    
                  </select>
                </div>

              </div>

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

<?php $__env->startPush('style'); ?>
  <style>
    
    .image-upload .thumb .profilePicPreview {
    width: 100%;
    height: 192px;
    display: block;
    border: 3px solid #f1f1f1;
    box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.25);
    border-radius: 10px;
    background-size: cover!important;
    background-position: top;
    background-repeat: no-repeat;
    position: relative;
    overflow: hidden;
}
    </style>    
<?php $__env->stopPush(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>

  <div class="d-flex flex-row-reverse">
    <div class="ml-5 mt-1">
      <a href="javascript:void(0)" class="btn btn-sm btn--primary box--shadow1 text--small" id="addCategory"><i
        class="fa fa-fw fa-plus" ></i> <?php echo app('translator')->get('Add Category'); ?> </a>
    </div>

    <div>
      <div class="input-group has_append">
        <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->get('Search Category'); ?>" value="" id="myInput">
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
     
      $('#addCategory').on('click',function(){

        $('#modelId').modal('show');
      })


      $('.editmodal').on('click',function(){
        var modal = $('#editCategory');

        modal.find("input[name=slug]").val($(this).data('slug'));

        modal.find("input[name=name]").val($(this).data('name'));
        modal.find("select").val($(this).data('mode'));

        modal.find("form").attr('action',$(this).data('action'));
        var img = $(this).data('style');
        modal.find(".profilePicPreview").attr('style',"background-image:url("+ img +")");
        modal.modal('show');

      })


      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });


      $("#myInput").on("keyup", function() {
        
        var value = $(this).val().toLowerCase();
        
        $("#myTable .filt").filter(function() {
          if($(this).text().toLowerCase().indexOf(value) <= -1){
            console.log ($(this));
          };
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

        
      });




// Image Preview
      function showImagePreview(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $(".profilePicPreview").attr('style',"background-image:url("+ e.target.result +")")
                  
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

        $(".profilePicUpload").change(function(){
          showImagePreview(this);
        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\setu\situ_foundation\core\resources\views/admin/category/category.blade.php ENDPATH**/ ?>