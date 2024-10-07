<?php $__env->startSection('content'); ?>

  <!-- login section start -->
  <section class="pt-90 pb-90">
    <div class="container">
      <div class="row justify-content-center" >

        <div class="col-md-6 pr-0 pl-0">
          <div class="content-area bg_img" data-background="<?php echo e(asset($activeTemplateTrue.'images/login.jpg')); ?>">
             
          </div>
          <div class="overlay">

          </div>
        </div>

        <div class="col-lg-6 shadow p-5">
          <div class="login-area">
          <h2 class="title mb-3"><?php echo app('translator')->get('Hi. welcome to'); ?> <?php echo e(__($general->sitename)); ?></h2>
            <p><?php echo app('translator')->get('Please Provide Your Valid Credentials'); ?></p>
            <form class="action-form mt-50" action="<?php echo e(route('user.login')); ?>" onsubmit="return submitUserForm()" method="POST">
                <?php echo csrf_field(); ?>
              <div class="form-group">
                <label><?php echo app('translator')->get('Username'); ?></label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="las la-user"></i></div>
                  </div>
                  <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Username'); ?>" name="username" required value=<?php echo e(old('username')); ?>>
                </div>
              </div><!-- form-group end -->
              <div class="form-group">
                <label><?php echo app('translator')->get('Password'); ?></label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="las la-key"></i></div>
                  </div>
                  <input type="password" class="form-control" placeholder="<?php echo app('translator')->get('Password'); ?>" name="password">
                </div>
              </div><!-- form-group end -->

                  <?php echo $__env->make($activeTemplate.'partials.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <?php echo $__env->make($activeTemplate.'partials.custom-captcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
            </div>
            

            <div class="form-group row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember"
                               id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                        <label class="form-check-label" for="remember">
                            <?php echo e(__('Remember Me')); ?>

                        </label>
                    </div>
                </div>

                <div class="col-md-6">
                    <?php if(Route::has('user.password.request')): ?>
                        <a class="btn btn-link float-right" href="<?php echo e(route('user.password.request')); ?>">
                                <?php echo e(__('Forgot Your Password?')); ?>

                                </a>
                    <?php endif; ?>
                </div>
            </div>
            
              <div class="form-group text-center">
                <button type="submit" class="cmn-btn rounded-0 w-100"><?php echo app('translator')->get('Login Now'); ?></button>
                <p class="mt-20"><?php echo app('translator')->get("Haven't an account?"); ?> <a href="<?php echo e(route('user.register')); ?>"><?php echo app('translator')->get('Sign Up'); ?></a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- login section end -->


   
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
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


<?php $__env->startPush('style'); ?>
    <style>
      .content-area{
        z-index: -1;
        height: 100%;
      }
      .overlay{
               background: rgb(34 59 96 / .3);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
      }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate.'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/user/auth/login.blade.php ENDPATH**/ ?>