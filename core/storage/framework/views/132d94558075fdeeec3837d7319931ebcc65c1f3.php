<?php $__env->startSection('panel'); ?>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
            <input type="hidden" name="success" value="<?php echo e($success->id); ?>">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group ">
                  <div class="image-upload">
                      <div class="thumb">
                          <div class="avatar-preview">
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="profilePicPreview logoPicPrev" style="background-size: 100%;background-image: url(<?php echo e(getImage(imagePath()['success']['path'].'/'.$success->image)); ?>)">
                                          <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                      </div>
                                  </div>
                                 
                              </div>
                          </div>
                          <div class="avatar-edit">
                              <input type="file" class="profilePicUpload" id="profilePicUpload1" accept=".png, .jpg, .jpeg" name="file" >
                              <label for="profilePicUpload1" class="bg-primary"><?php echo app('translator')->get('Update Story Image'); ?> </label>
                          </div>
                      </div>
                  </div>

              </div>
              </div>


              <div class="col-md-8">

                <div class="form-group">
                  <label for=""><?php echo app('translator')->get('Select Category For Blog'); ?></label>
                  <select class="form-control" name="category" id="">
                      
                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php echo e($cat->id == $success->category_id ? 'selected':''); ?>><?php echo e($cat->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>


                <div class="form-group">
                  <label for=""><?php echo app('translator')->get('Title For Success'); ?></label>
                <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="Title for Blog" value="<?php echo e($success->title); ?>">
                  
                </div>

                <div class="form-group">
                      <label for="description"><?php echo app('translator')->get('Short Description'); ?></label>
                      <textarea class="form-control" name="short_description" id="" rows="5" placeholder="Short Description"><?php echo e($success->short_description); ?></textarea>
                  </div>

                <div class="form-group">
                  <label for="description"><?php echo app('translator')->get('Description'); ?></label>
                  <textarea class="form-control nicEdit" name="description" id=""><?php echo e($success->details); ?></textarea>
                </div>

              </div>
            </div>

                <div class="form-group">
                    <button type="submit" class="form-control btn btn--primary"><?php echo app('translator')->get('Update Success Story'); ?></button>
                </div>

            </form>
              
          </div>
      </div><!-- card end -->
  </div>
  </div>

  
  
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
      <style>
        .niceEdit-main{
          width: 1028px;
          margin: 4px;
          max-height: 175px !important; 
          overflow: scroll !important;
        }
      </style>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script'); ?>
<script>
  'use strict';
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});

$(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
   

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/admin/success/edit.blade.php ENDPATH**/ ?>