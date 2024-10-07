<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="<?php echo e(route('admin.gateway.automatic.update', $gateway->code)); ?>" method="POST"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="alias" value="<?php echo e($gateway->alias); ?>">
                    <input type="hidden" name="description" value="<?php echo e($gateway->description); ?>">


                    <div class="card-body">
                        <div class="payment-method-item">
                            <div class="payment-method-header d-flex flex-wrap">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"
                                             style="background-image: url('<?php echo e(getImage(imagePath()['gateway']['path'].'/'. $gateway->image,'800x800')); ?>')"></div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" name="image" class="profilePicUpload" id="image"
                                               accept=".png, .jpg, .jpeg"/>
                                        <label for="image" class="bg--primary"><i class="la la-pencil"></i></label>
                                    </div>
                                </div>

                                <div class="content">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="title"><?php echo e($gateway->name); ?></h3>
                                        <div class="input-group d-flex flex-wrap justify-content-end has_append width-375">
                                            <select class="newCurrencyVal ">
                                                <option value=""><?php echo app('translator')->get('Select currency'); ?></option>
                                                <?php $__empty_1 = true; $__currentLoopData = $supportedCurrencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency => $symbol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <option value="<?php echo e($currency); ?>"
                                                            data-symbol="<?php echo e($symbol); ?>"><?php echo e($currency); ?> </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <option value=""><?php echo app('translator')->get('No available currency support'); ?></option>
                                                <?php endif; ?>

                                            </select>


                                            <div class="input-group-append">
                                                <button type="button" class="btn btn--primary  newCurrencyBtn"
                                                        data-crypto="<?php echo e($gateway->crypto); ?>"
                                                        data-name="<?php echo e($gateway->name); ?>"><?php echo app('translator')->get('Add new'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <p><?php echo e($gateway->description); ?></p>
                                </div>
                            </div>

                            <?php if($gateway->code < 1000 && $gateway->extra): ?>
                                <div class="payment-method-body mt-2">
                                    <h4 class="mb-3"><?php echo app('translator')->get('Configurations'); ?></h4>
                                    <div class="row">
                                        <?php $__currentLoopData = $gateway->extra; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group col-lg-6">
                                                <label><?php echo e(@$param->title); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                           value="<?php echo e(route($param->value)); ?>" readonly/>

                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <span class="copyInput" data-toggle="tooltip" title="Copy"><i class="fa fa-copy"></i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="payment-method-body mt-2">
                                <h4 class="mb-3"><?php echo app('translator')->get('Global Setting for'); ?> <?php echo e($gateway->name); ?></h4>
                                <div class="row">
                                    <?php $__currentLoopData = $parameters->where('global', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-group col-lg-6">
                                            <label><?php echo e(@$param->title); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="global[<?php echo e($key); ?>]"
                                                   value="<?php echo e(@$param->value); ?>" required/>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <!-- payment-method-item start -->

                        <?php if(isset($gateway->currencies)): ?>
                            <?php $__currentLoopData = $gateway->currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway_currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="currency[<?php echo e($currency_idx); ?>][symbol]"
                                       value="<?php echo e($gateway_currency->symbol); ?>">
                                <div class="payment-method-item child--item">
                                    <div class="payment-method-header d-flex flex-wrap">

                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview"
                                                     style="background-image: url('<?php echo e(getImage(imagePath()['gateway']['path'].'/'. $gateway_currency->image,'800x800')); ?>')"></div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" name="currency[<?php echo e($currency_idx); ?>][image]"
                                                       id="image<?php echo e($currency_idx); ?>" class="profilePicUpload"
                                                       accept=".png, .jpg, .jpeg"/>
                                                <label for="image<?php echo e($currency_idx); ?>" class="bg-primary"><i
                                                        class="la la-pencil"></i
                                                    ></label>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="d-flex justify-content-between">
                                                <div class="form-group">
                                                    <h4 class="mb-3"><?php echo e($gateway->name); ?>

                                                        - <?php echo e($gateway_currency->currency); ?></h4>
                                                    <input type="text" class="form-control"
                                                           placeholder="Name for Gateway"
                                                           name="currency[<?php echo e($currency_idx); ?>][name]"
                                                           value="<?php echo e($gateway_currency->name); ?>" required/>
                                                </div>
                                                <div class="remove-btn">
                                                    <button type="button" class="btn btn--danger deleteBtn"
                                                            data-id="<?php echo e($gateway_currency->id); ?>"
                                                            data-name="<?php echo e($gateway_currency->currencyIdentifier()); ?>">
                                                        <i class="la la-trash-o mr-2"></i><?php echo app('translator')->get('Remove'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="payment-method-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <div class="card border--primary mt-2">
                                                    <h5 class="card-header bg--primary"><?php echo app('translator')->get('Range'); ?></h5>
                                                    <div class="card-body">
                                                        <div class="input-group mb-3">
                                                            <label class="w-100"><?php echo app('translator')->get('Minimum Amount'); ?> <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group-prepend">
                                                                <div
                                                                    class="input-group-text"><?php echo e($general->cur_text); ?></div>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                   name="currency[<?php echo e($currency_idx); ?>][min_amount]"
                                                                   value="<?php echo e(getAmount($gateway_currency->min_amount)); ?>"
                                                                   placeholder="0" required/>
                                                        </div>
                                                        <div class="input-group">
                                                            <label class="w-100"><?php echo app('translator')->get('Maximum Amount'); ?> <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group-prepend">
                                                                <div
                                                                    class="input-group-text"><?php echo e($general->cur_text); ?></div>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="0"
                                                                   name="currency[<?php echo e($currency_idx); ?>][max_amount]"
                                                                   value="<?php echo e(getAmount($gateway_currency->max_amount)); ?>"
                                                                   required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <div class="card border--primary mt-2">
                                                    <h5 class="card-header bg--primary"><?php echo app('translator')->get('Charge'); ?></h5>
                                                    <div class="card-body">
                                                        <div class="input-group mb-3">
                                                            <label class="w-100"><?php echo app('translator')->get('Fixed Charge'); ?> <span class="text-danger">*</span></label>
                                                            <div class="input-group-prepend">
                                                                <div
                                                                    class="input-group-text"><?php echo e($general->cur_text); ?></div>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="0"
                                                                   name="currency[<?php echo e($currency_idx); ?>][fixed_charge]"
                                                                   value="<?php echo e(getAmount($gateway_currency->fixed_charge)); ?>"
                                                                   required/>
                                                        </div>
                                                        <div class="input-group">
                                                            <label class="w-100"><?php echo app('translator')->get('Percent Charge'); ?> <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">%</div>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="0"
                                                                   name="currency[<?php echo e($currency_idx); ?>][percent_charge]"
                                                                   value="<?php echo e(getAmount($gateway_currency->percent_charge)); ?>"
                                                                   required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <div class="card border--primary mt-2">
                                                    <h5 class="card-header bg--primary"><?php echo app('translator')->get('Currency'); ?></h5>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-group mb-3">
                                                                    <label class="w-100"><?php echo app('translator')->get('Currency'); ?></label>
                                                                    <input type="text"
                                                                           name="currency[<?php echo e($currency_idx); ?>][currency]"
                                                                           class="form-control border-radius-5 "
                                                                           value="<?php echo e($gateway_currency->currency); ?>"
                                                                           readonly/>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group mb-3">
                                                                    <label class="w-100"><?php echo app('translator')->get('Symbol'); ?></label>
                                                                    <input type="text"
                                                                           name="currency[<?php echo e($currency_idx); ?>][symbol]"
                                                                           class="form-control border-radius-5 symbl"
                                                                           value="<?php echo e($gateway_currency->symbol); ?>"
                                                                           data-crypto="<?php echo e($gateway->crypto); ?>"
                                                                           required/>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <label class="w-100"><?php echo app('translator')->get('Rate'); ?> <span class="text-danger">*</span></label>
                                                            <div class="input-group-prepend">

                                                                <div class="input-group-text">1 <?php echo e($general->cur_text); ?>

                                                                    =
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="0"
                                                                   name="currency[<?php echo e($currency_idx); ?>][rate]"
                                                                   value="<?php echo e($gateway_currency->rate +0); ?>" required/>
                                                            <div class="input-group-append">

                                                                <div class="input-group-text"><span
                                                                        class="currency_symbol"><?php echo e($gateway_currency->baseSymbol()); ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <?php if($parameters->where('global', false)->count()  != 0 ): ?>
                                                <?php
                                                    $gateway_parameter = json_decode($gateway_currency->gateway_parameter);
                                                ?>
                                                <div class="col-lg-12">
                                                    <div class="card border--primary mt-4">
                                                        <h5 class="card-header bg--dark"><?php echo app('translator')->get('Configuration'); ?></h5>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <?php $__currentLoopData = $parameters->where('global', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-3">
                                                                            <label class="w-100"><?php echo e($param->title); ?>

                                                                                <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                   name="currency[<?php echo e($currency_idx); ?>][param][<?php echo e($key); ?>]"
                                                                                   value="<?php echo e($gateway_parameter->$key); ?>"
                                                                                   placeholder="---" required/>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            <?php $currency_idx++ ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <!-- payment-method-item end -->


                        <!-- **new payment-method-item start -->
                        <div class="payment-method-item child--item newMethodCurrency d-none">
                            <input disabled type="hidden" name="currency[<?php echo e($currency_idx); ?>][symbol]"
                                   class="currencySymbol">
                            <div class="payment-method-header d-flex flex-wrap">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"
                                             style="background-image: url('<?php echo e(getImage(imagePath()['gateway']['path'],'800x800')); ?>')">

                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input disabled type="file" accept=".png, .jpg, .jpeg" class="profilePicUpload"
                                               id="image<?php echo e($currency_idx); ?>"
                                               name="currency[<?php echo e($currency_idx); ?>][image]"/>
                                        <label for="image<?php echo e($currency_idx); ?>" class="bg-primary"><i
                                                class="la la-pencil"></i></label>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <h4 class="mb-3" id="payment_currency_name"><?php echo app('translator')->get('Name'); ?></h4>
                                            <input disabled type="text" class="form-control"
                                                   placeholder="Name for Gateway"
                                                   name="currency[<?php echo e($currency_idx); ?>][name]" required/>
                                        </div>
                                        <div class="remove-btn">
                                            <button type="button" class="btn btn-danger newCurrencyRemove">
                                                <i class="la la-trash-o mr-2"></i><?php echo app('translator')->get('Remove'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="payment-method-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="card border--primary mt-2">
                                            <h5 class="card-header bg--primary"><?php echo app('translator')->get('Range'); ?></h5>
                                            <div class="card-body">
                                                <div class="input-group mb-3">
                                                    <label class="w-100"><?php echo app('translator')->get('Minimum Amount'); ?> <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><?php echo e($general->cur_text); ?></div>
                                                    </div>
                                                    <input disabled type="text" class="form-control"
                                                           name="currency[<?php echo e($currency_idx); ?>][min_amount]"
                                                           placeholder="0" required/>
                                                </div>

                                                <div class="input-group">
                                                    <label class="w-100"><?php echo app('translator')->get('Maximum Amount'); ?> <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><?php echo e($general->cur_text); ?></div>
                                                    </div>

                                                    <input disabled type="text" class="form-control" placeholder="0"
                                                           name="currency[<?php echo e($currency_idx); ?>][max_amount]" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="card border--primary mt-2">
                                            <h5 class="card-header bg--primary"><?php echo app('translator')->get('Charge'); ?></h5>
                                            <div class="card-body">
                                                <div class="input-group mb-3">
                                                    <label class="w-100"><?php echo app('translator')->get('Fixed Charge'); ?> <span class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><?php echo e($general->cur_text); ?></div>
                                                    </div>
                                                    <input disabled type="text" class="form-control" placeholder="0"
                                                           name="currency[<?php echo e($currency_idx); ?>][fixed_charge]" required/>
                                                </div>
                                                <div class="input-group">
                                                    <label class="w-100"><?php echo app('translator')->get('Percent Charge'); ?> <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">%</div>
                                                    </div>
                                                    <input disabled type="text" class="form-control" placeholder="0"
                                                           name="currency[<?php echo e($currency_idx); ?>][percent_charge]"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="card border--primary mt-2">
                                            <h5 class="card-header bg--primary"><?php echo app('translator')->get('Currency'); ?></h5>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <label class="w-100"><?php echo app('translator')->get('Currency'); ?></label>
                                                            <input disabled type="text"
                                                                   class="form-control currencyText border-radius-5"
                                                                   name="currency[<?php echo e($currency_idx); ?>][currency]" readonly/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <label class="w-100"><?php echo app('translator')->get('Symbol'); ?></label>
                                                            <input type="text"
                                                                   name="currency[<?php echo e($currency_idx); ?>][symbol]"
                                                                   class="form-control border-radius-5 symbl"
                                                                   data-crypto="<?php echo e($gateway->crypto); ?>" disabled/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="input-group">
                                                    <label class="w-100"><?php echo app('translator')->get('Rate'); ?> <span class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <b>1 </b>&nbsp; <?php echo e($general->cur_text); ?>&nbsp; =
                                                        </div>
                                                    </div>
                                                    <input disabled type="text" class="form-control" placeholder="0"
                                                           name="currency[<?php echo e($currency_idx); ?>][rate]" required/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><span
                                                                class="currency_symbol"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if($parameters->where('global', false)->count()  != 0 ): ?>
                                        <div class="col-lg-12">
                                            <div class="card border--primary mt-4">
                                                <h5 class="card-header bg--dark"><?php echo app('translator')->get('Configuration'); ?></h5>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <?php $__currentLoopData = $parameters->where('global', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-6">
                                                                <div class="input-group mb-3">
                                                                    <label class="w-100"><?php echo e($param->title); ?> <span
                                                                            class="text-danger">*</span></label>
                                                                    <input disabled type="text" class="form-control"
                                                                           name="currency[<?php echo e($currency_idx); ?>][param][<?php echo e($key); ?>]"
                                                                           placeholder="---" required/>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <!-- **new payment-method-item end -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary btn-block py-2">
                            <?php echo app('translator')->get('Update Setting'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>


    </div>



    
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Gateway Currency Remove Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.gateway.automatic.remove', $gateway->code)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to delete'); ?> <span class="font-weight-bold name"></span> <?php echo app('translator')->get('gateway currency?'); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--danger"><?php echo app('translator')->get('Delete'); ?></button>
                        <button type="button" class="btn btn--dark" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>





<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('admin.gateway.automatic.index')); ?>" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="la la-fw fa-backward"></i><?php echo app('translator')->get('Go Back'); ?></a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
            "use strict";
        $(function () {

            $('.newCurrencyBtn').on('click', function () {
            var form = $('.newMethodCurrency');

            var getCurrencySelected = $('.newCurrencyVal').find(':selected').val();
            var currency = $(this).data('crypto') == 1 ? 'USD' : `${getCurrencySelected}`;

            if (!getCurrencySelected) return;
            form.find('input').removeAttr('disabled');
            var symbol = $('.newCurrencyVal').find(':selected').data('symbol');
            form.find('.currencyText').val(getCurrencySelected);
            form.find('.currency_symbol').text(currency);
            $('#payment_currency_name').text(`${$(this).data('name')} - ${getCurrencySelected}`);
            form.removeClass('d-none');
            $('html, body').animate({scrollTop: $('html, body').height()}, 'slow');

            $('.newCurrencyRemove').on('click', function () {
                form.find('input').val('');
                // form.addClass('d-none');
                form.remove();
            });

        });

        $('.deleteBtn').on('click', function () {
            var modal = $('#deleteModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('.name').text($(this).data('name'));
            modal.modal('show');
        });

        $('.symbl').on('input', function () {
            var curText = $(this).data('crypto') == 1 ? 'USD' : $(this).val();
            $(this).parents('.payment-method-body').find('.currency_symbol').text(curText);
        });

        $('.copyInput').on('click', function (e) {
            var copybtn = $(this);
            var input = copybtn.parent().parent().siblings('input');
            if (input && input.select) {
                input.select();
                try {
                    document.execCommand('SelectAll')
                    document.execCommand('Copy', false, null);
                    input.blur();
                    copybtn.addClass('copied');
                    setTimeout(function () {
                        copybtn.removeClass('copied');
                    }, 1000);
                } catch (err) {
                    alert('Please press Ctrl/Cmd + C to copy');
                }
            }
        });

        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\setu\situ_foundation\core\resources\views/admin/gateway/edit.blade.php ENDPATH**/ ?>