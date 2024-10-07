<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center my-4">
            <div class="col-md-12">

                <div class="card shadow">

                    <div class="card-body">

                        <form class="register" action="" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>


                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="InputFirstname" class="col-form-label"><?php echo app('translator')->get('First Name:'); ?></label>
                                    <input type="text" class="form-control" id="InputFirstname" name="firstname"
                                           placeholder="<?php echo app('translator')->get('First Name'); ?>" value="<?php echo e($user->firstname); ?>" >
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="lastname" class="col-form-label"><?php echo app('translator')->get('Last Name:'); ?></label>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                           placeholder="<?php echo app('translator')->get('Last Name'); ?>" value="<?php echo e($user->lastname); ?>">
                                </div>

                            </div>


                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="email" class="col-form-label"><?php echo app('translator')->get('E-mail Address:'); ?></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo app('translator')->get('E-mail Address'); ?>" value="<?php echo e($user->email); ?>" required="" readonly>
                                </div>

                                <div class="form-group col-sm-6">
                                    <input type="hidden" id="track" name="country_code">
                                    <label for="phone" class="col-form-label"><?php echo app('translator')->get('Mobile Number'); ?></label>
                                    <input type="tel" class="form-control pranto-control" id="phone" name="mobile" value="<?php echo e($user->mobile); ?>" placeholder="<?php echo app('translator')->get('Your Contact Number'); ?>" required readonly>
                                </div>
                                <input type="hidden" name="country" id="country" class="form-control d-none" value="<?php echo e($user->address->country); ?>" >
                            </div>



                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="address" class="col-form-label"><?php echo app('translator')->get('Address:'); ?></label>
                                    <input type="text" class="form-control" id="address" name="address"
                                           placeholder="<?php echo app('translator')->get('Address'); ?>" value="<?php echo e($user->address->address); ?>" required="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="state" class="col-form-label"><?php echo app('translator')->get('State:'); ?></label>
                                    <input type="text" class="form-control" id="state" name="state" placeholder="<?php echo app('translator')->get('state'); ?>" value="<?php echo e($user->address->state); ?>" required="">
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="zip" class="col-form-label"><?php echo app('translator')->get('Zip Code:'); ?></label>
                                    <input type="text" class="form-control" id="zip" name="zip" placeholder="<?php echo app('translator')->get('Zip Code'); ?>" value="<?php echo e($user->address->zip); ?>" required="">
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="city" class="col-form-label"><?php echo app('translator')->get('City:'); ?></label>
                                    <input type="text" class="form-control" id="city" name="city"
                                           placeholder="<?php echo app('translator')->get('City'); ?>" value="<?php echo e($user->address->city); ?>" required="">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new " data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style=""
                                                 data-trigger="fileinput">
                                                <img  src="<?php echo e(getImage('assets/images/user/profile/'. $user->image,'400x400')); ?>" alt="<?php echo app('translator')->get('image'); ?>">

                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>

                                            <div class="img-input-div">
                                            <span class="btn btn-info btn-file">
                                                <span class="fileinput-new "> <?php echo app('translator')->get('Select image'); ?></span>
                                                <span class="fileinput-exists"> <?php echo app('translator')->get('Change'); ?></span>
                                                <input type="file" name="image" accept="image/*">
                                            </span>
                                                <a href="#" class="btn btn-danger fileinput-exists"
                                                   data-dismiss="fileinput"> <?php echo app('translator')->get('Remove'); ?></a>
                                            </div>

                                            <code><?php echo app('translator')->get('Image size 800*800'); ?></code>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row pt-5">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-block btn-success btn-custom"><?php echo app('translator')->get('Update Profile'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('style'); ?>

    <style>
        .thumbnail{
            width: 200px; 
            height: 150px;
        }

        .fileinput-preview.thumbnail{
            max-width: 200px; 
            max-height: 150px
        }
        span.btn.btn-info.btn-file {
            background: #16C26B;
            border: none;
        }

        span.fileinput-new {
            color: #fff;
        }
        .btn-custom{
            background:#16C26B;
            border:none;
        }
    </style>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/user/profile-setting.blade.php ENDPATH**/ ?>