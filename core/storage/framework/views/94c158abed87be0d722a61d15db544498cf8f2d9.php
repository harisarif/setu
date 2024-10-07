<?php $__env->startSection('panel'); ?>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                  <div class="col-md-4">
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
                                  <input type="file" class="profilePicUpload" id="profilePicUpload1" accept=".png, .jpg, .jpeg" name="file" required>
                                  <label for="profilePicUpload1" class="bg-primary"><?php echo app('translator')->get('Upload Story Image'); ?> </label>
                              </div>
                          </div>
                      </div>

                  </div>
                  </div>



                  <div class="col-md-8">

                    <div class="form-group">
                      <label for=""><?php echo app('translator')->get('Select Category For Blog'); ?></label>
                      <select class="form-control" name="category" id="" required>
                          <option value="" selected>--<?php echo app('translator')->get('Select Category'); ?>--</option>
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for=""><?php echo app('translator')->get('Title For Success'); ?></label>
                      <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="Title for Blog" required>
                      
                    </div>

                    <div class="form-group">
                      <label for="description"><?php echo app('translator')->get('Short Description'); ?></label>
                      <textarea class="form-control" name="short_description" id="" rows="5" placeholder="Short Description"></textarea>
                    </div>

                    <div class="form-group">
                      <label for="description"><?php echo app('translator')->get('Description'); ?></label>
                      <textarea class="form-control nicEdit" name="description" id="" rows="8"></textarea>
                    </div>

                  </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="form-control btn btn--primary"><?php echo app('translator')->get('Create Success Story'); ?></button>
                </div>

            </form>
              
          </div>
      </div><!-- card end -->
  </div>
  </div>

  
  
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/admin/success/create.blade.php ENDPATH**/ ?>