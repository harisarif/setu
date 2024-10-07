<?php
    $data = getContent('terms.element',false);
?>

<?php $__env->startSection('content'); ?>



<!-- registration section start -->
<section class="pt-90 pb-90">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 shadow p-3">
          <div class="login-area">
          <h2 class="title mb-3"><?php echo app('translator')->get('Hi. welcome to'); ?> <?php echo e($general->sitename); ?></h2>
            <p><?php echo app('translator')->get('Please provide your valid infomations to get the benefits form our site.'); ?></p>
            <form class="action-form mt-50" action="" method="post" onsubmit="return submitUserForm();"> 
                <?php echo csrf_field(); ?>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('First name'); ?></label>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="las la-user"></i></div>
                              </div>
                            <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('First name'); ?>" name="firstname" required value="<?php echo e(old('firstname')); ?>">
                            </div>
                          </div><!-- form-group end -->
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Last name'); ?></label>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="las la-user"></i></div>
                              </div>
                            <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Last name'); ?>" name="lastname" required value="<?php echo e(old('lastname')); ?>">
                            </div>
                          </div><!-- form-group end -->
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('User name'); ?></label>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="las la-user"></i></div>
                              </div>
                            <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('User name'); ?>" name="username" required value="<?php echo e(old('username')); ?>">
                            </div>
                          </div><!-- form-group end -->
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Email address'); ?></label>
                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="las la-at"></i></div>
                              </div>
                            <input type="email" class="form-control" placeholder="<?php echo app('translator')->get('Email address'); ?>" name="email" required value="<?php echo e(old('email')); ?>">
                            </div>
                          </div><!-- form-group end -->
                    </div>
                </div> 

                <div class="row mb-3">
                  <div class="form-group col-md-6">

                    <label for="mobile" class="text-md-right"><?php echo e(__('Mobile')); ?></label>

                    <div class=" country-code">

                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                <select name="country_code" >
                                  <?php echo $__env->make('partials.country_code', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </select>
                              </span>
                          </div>
                        <input type="text" name="mobile" class="form-control" placeholder="<?php echo app('translator')->get('Your Phone Number'); ?>">
                        </div>
                    </div>


                  </div>

                  <div class="form-group col-md-6 mt-0">
                    <label for="email" class="text-md-right"><?php echo e(__('Country')); ?></label>
                    <input type="text" name="country" class="form-control" readonly>
                  </div>
                </div>
              

              <div class="row mb-3">
                  <div class="col">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('Password'); ?></label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="las la-key"></i></div>
                          </div>
                          <input type="password" class="form-control" placeholder="<?php echo app('translator')->get('Password'); ?>" name="password" required>
                        </div>
                      </div><!-- form-group end -->
                  </div>
                  <div class="col">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('Confirm Password'); ?></label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="las la-key"></i></div>
                          </div>
                          <input type="password" class="form-control" placeholder="<?php echo app('translator')->get('Confirm Password'); ?>" required name="password_confirmation">
                        </div>
                      </div><!-- form-group end -->
                  </div>
              </div>

              

            <?php echo $__env->make($activeTemplate.'partials.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make($activeTemplate.'partials.custom-captcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <div class="form-group">
                <div class="input-group my-3 d-flex flex-wrap align-items-center">
                  <input type="checkbox" placeholder="Checkbox" required name="check" id="check">
                  <label for="" class="mt-2 ml-2"><?php echo app('translator')->get('I Accept All'); ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <a href="<?php echo e(route('user.site',$item->data_values->pagename)); ?>"><?php echo e($item->data_values->pagename); ?></a>
                       <?php echo e($loop->last ? '': '&'); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </label>
                </div>
              </div><!-- form-group end -->

              <div class="form-group text-center">
                <button type="submit" class="cmn-btn rounded-0 w-100"><?php echo app('translator')->get('Signup Now'); ?></button>
              <p class="mt-20"><?php echo app('translator')->get('Already i have an account in here'); ?> <a href="<?php echo e(route('user.login')); ?>"><?php echo app('translator')->get('Sign In'); ?></a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- registration section end -->




<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>

    <style>
      

       .country-code .input-group-prepend .input-group-text {
          background: #e9ecef !important;
          padding: 0;
          border: none;
      }
      .country-code select{
          border: none;
      }
      .country-code select:focus{
          border: none;
          outline: none;
      }

      .select option{
        background: #fff !important;
      }

    
    </style>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script'); ?>
    <script>
       'use strict';

        <?php if($country_code): ?>
        var t = $(`option[data-code=<?php echo e($country_code); ?>]`).attr('selected','');
      <?php endif; ?>
        $('select[name=country_code]').change(function(){
            $('input[name=country]').val($('select[name=country_code] :selected').data('country'));
        }).change();
    </script>


    <script>
      'use strict';
      
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;"><?php echo app('translator')->get("Captcha field is required."); ?></span>';
                return false;
            }
            return true;
        }

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate.'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/user/auth/register.blade.php ENDPATH**/ ?>