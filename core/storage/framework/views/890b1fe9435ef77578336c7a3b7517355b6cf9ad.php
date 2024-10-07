<?php $__env->startSection('content'); ?>

    <!-- login section start -->
    <section class="pt-90 pb-90">
        <div class="container">
            <div class="row justify-content-center margin--top-adjustment">

                <div class="col-lg-10 shadow p-5">
                    <div class="login-area">
                        <form class="action-form" action="<?php echo e(route('volunteer')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row justify-content-center ">
                                <div class="form-group col-md-7 mb-5 text-center ">
                                    <label class=""><?php echo app('translator')->get('Upload Your Image'); ?></label>
                                    <div class="image-prev">
                                        <img src="<?php echo e(getImage('/', '200x200')); ?>" alt="" id="prev" class="w-100 h-100">
                                    </div>
                                    <input class="custom-file-input" type="file" name="image" required />
                                    <button type="button" class="btn btn-danger remove"><?php echo app('translator')->get('Remove'); ?></button>

                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label><?php echo app('translator')->get('Firstname'); ?></label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="las la-user"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('First Name'); ?>"
                                            name="firstname" required value=<?php echo e(old('firstname')); ?>>
                                    </div>
                                </div><!-- form-group end -->
                                <div class="form-group col-md-6 mb-2">
                                    <label><?php echo app('translator')->get('lastname'); ?></label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="las la-user"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Last Name'); ?>"
                                            name="lastname" required value=<?php echo e(old('lastname')); ?>>
                                    </div>
                                </div><!-- form-group end -->
                                <div class="form-group col-md-6 mb-2">
                                    <label><?php echo app('translator')->get('Email'); ?></label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="las la-at"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Email'); ?>" name="email"
                                            required value=<?php echo e(old('email')); ?>>
                                    </div>
                                </div><!-- form-group end -->
                                <div class="form-group col-md-6 mb-2">
                                    <label class="" for="country"><?php echo e(__('Country')); ?></label>
                                    <select name="country" id="country" class="form-control w-100">
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-mobile_code="<?php echo e($country->dial_code); ?>"
                                                value="<?php echo e($country->country); ?>" data-code="<?php echo e($key); ?>">
                                                <?php echo e(__($country->country)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for=""><?php echo app('translator')->get('Phone'); ?></label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mobile-code">

                                            </span>
                                            <input type="hidden" name="mobile_code">
                                            <input type="hidden" name="country_code">
                                        </div>
                                        <input type="text" name="mobile" id="mobile" value="<?php echo e(old('mobile')); ?>"
                                            class="form-control" placeholder="<?php echo app('translator')->get('Your Phone Number'); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label><?php echo app('translator')->get('State'); ?></label>
                                    <input type="text" name="state" placeholder="<?php echo app('translator')->get('State'); ?>" class="form-control">
                                </div><!-- form-group end -->
                                <div class="form-group col-md-6 mb-2">
                                    <label><?php echo app('translator')->get('Zip'); ?></label>
                                    <input type="text" name="zip" placeholder="<?php echo app('translator')->get('Zip'); ?>" class="form-control">
                                </div><!-- form-group end -->
                                <div class="form-group col-md-6 mb-2">
                                    <label><?php echo app('translator')->get('City'); ?></label>
                                    <input type="text" name="city" placeholder="<?php echo app('translator')->get('city'); ?>" class="form-control">
                                </div><!-- form-group end -->
                                <div class="form-group col-md-12 mb-5">
                                    <label><?php echo app('translator')->get('address'); ?></label>
                                    <input type="text" name="address" placeholder="<?php echo app('translator')->get('address'); ?>" class="form-control">
                                </div><!-- form-group end -->

                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-success cmn-btn w-100">
                            </div>

                    </div>

                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- login section end -->


<?php $__env->stopSection(); ?>


<?php $__env->startPush('style'); ?>
    <style>
        .action-form .form-group+.form-group {
            margin-top: 0px;
        }

        .image-prev {
            height: 200px;
            width: 200px;
            border-radius: 50%;
            overflow: hidden;
            border: 1px solid #b9b9b9;
            margin: 0 auto;
            margin-top: -150px;
            margin-bottom: 20px;
        }
        .margin--top-adjustment{
            margin-top: 100px;
        }

        .custom-file-input {
            color: transparent;
            width: 100px;
            opacity: 1 !important;
            height: auto;

        }

        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
        }

        .custom-file-input::before {
            content: 'Upload File';
            display: inline-block;
            background: #198754 !important;
            border: 1px solid #999;
            border-radius: 3px;
            padding: 9px 8px;
            outline: none;
            white-space: nowrap;
            -webkit-user-select: none;
            cursor: pointer;
            text-shadow: 1px 1px #fff;
            font-weight: 700;
            font-size: 10pt;

        }


        .custom-file-input:active {
            outline: 0;
        }

        .custom-file-input:active::before {
            background: #198754;
        }

    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            "use strict";
            <?php if($mobile_code): ?>
                $(`option[data-code=<?php echo e($mobile_code); ?>]`).attr('selected','');
            <?php endif; ?>
            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            }).change();

            function showImagePreview(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#prev').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function removeImage() {
                var _empty = '';
                $('#prev').attr('src', "<?php echo e(route('placeholderImage', '200x200')); ?>");
                $('.custom-file-input').val(_empty);
            }

            $(".custom-file-input").change(function() {
                showImagePreview(this);
            });

            $('.remove').on('click', function() {
                removeImage();
            })
        })

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate.'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/volunteer.blade.php ENDPATH**/ ?>