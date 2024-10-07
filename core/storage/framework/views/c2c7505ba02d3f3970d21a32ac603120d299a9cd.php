<?php $__env->startSection('panel'); ?>

    <div class="row">
        <div class="col-lg-7 shadow p-2">
            <div class="event-details-wrapper">
                <div class="event-details-thumb">
                    <img src="<?php echo e(asset(imagePath()['campaign']['path'] . '/' . $campaign->image)); ?>" alt="<?php echo app('translator')->get('image'); ?>">
                </div>
            </div><!-- event-details-wrapper end -->
            <div class="event-details-area mt-50">
                <ul class="nav nav-tabs nav-tabs--style" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab"
                            aria-controls="description" aria-selected="true"><?php echo app('translator')->get('Description'); ?></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab"
                            aria-controls="gallery" aria-selected="false"><?php echo app('translator')->get('Relevent Image'); ?></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video"
                            aria-selected="false"><?php echo app('translator')->get('Relevent Document'); ?></a>
                    </li>

                </ul>
                <div class="tab-content mt-4" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                        aria-labelledby="description-tab">
                        <p class="text-justify" id="description"><?php echo e($campaign->description); ?></p>

                    </div><!-- tab-pane end -->

                    <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                        <div class="row mb-none-30">
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php if(explode('.', $prof)[1] == 'pdf'): ?>

                                <?php else: ?>

                                    <div class="col-lg-4 col-sm-6 mb-30">
                                        <div class="gallery-card">
                                            <a href="<?php echo e(asset(imagePath()['prof']['path'] . '/' . $prof)); ?>"
                                                class="view-btn" data-rel="lightcase:myCollection"><i
                                                    class="las la-plus"></i></a>
                                            <div class="gallery-card__thumb">
                                                <img src="<?php echo e(asset(imagePath()['prof']['path'] . '/' . $prof)); ?>"
                                                    alt="<?php echo app('translator')->get('image'); ?>">
                                            </div>
                                        </div><!-- gallery-card end -->
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div><!-- tab-pane end -->

                    <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if(explode('.', $prof)[1] == 'pdf'): ?>
                                <iframe width="100%" height="800"
                                    src="<?php echo e(asset(imagePath()['prof']['path'] . '/' . $prof)); ?>" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            <?php else: ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </div><!-- tab-pane end -->
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-lg-0 mt-5">
            <div class="donation-sidebar">
                <div class="donation-widget shadow">
                    <h3 class="pb-4"><?php echo e($campaign->title); ?></h3>
                    <div class="skill-bar mt-4">
                        <div class="progressbar" data-perc="<?php echo e($percent >= 100 ? '100' : $percent); ?>%">
                            <div class="bar"></div>
                            <span class="label"><?php echo e(number_format($percent >= 100 ? '100' : $percent, 2)); ?>%</span>
                        </div>
                    </div>
                    <div class="row mt-2 justify-content-between">
                        <div class="col-sm-6">
                            <b><?php echo e(number_format($percent >= 100 ? '100' : $percent, 2)); ?>%</b> <?php echo app('translator')->get('Donated'); ?>
                        </div>
                        <div class="col-sm-6">
                            <?php echo app('translator')->get('Goal Amount'); ?> <b><?php echo e($general->cur_sym); ?> <?php echo e($campaign->goal); ?></b>
                        </div>
                    </div>
                    <div class="row mt-50 mb-none-30">
                        <div class="col-6 donate-item text-center mb-30">
                            <h4 class="amount text-light"><?php echo e($donor); ?></h4>
                            <p class="text-light"><?php echo app('translator')->get('Donors'); ?></p>
                        </div>
                        <div class="col-6 donate-item text-center mb-30">
                            <h4 class="amount text-light"><?php echo e($general->cur_sym); ?> <?php echo e($donate); ?></h4>
                            <p class="text-light"><?php echo app('translator')->get('Donated'); ?></p>
                        </div>
                    </div>
                </div><!-- donation-widget end -->


                <div class="donation-widget shadow">
                    <form class="vent-details-form">
                        <div class="form-group  col-md-12  col-sm-12 col-12">
                            <label class="form-control-label font-weight-bold"><?php echo app('translator')->get('Make Featured'); ?></label>
                            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                data-toggle="toggle" data-id="<?php echo e($campaign->id); ?>" data-on="Featured"
                                data-off="Non Featured" name="tv" <?php if($campaign->featured): ?>
                            checked <?php endif; ?>
                            >
                        </div>
                    </form>
                </div><!-- donation-widget end -->


                <div class="donation-widget shadow">
                    <form class="vent-details-form">
                        <h3 class="mb-2"><?php echo app('translator')->get('Category'); ?></h3>
                        <div class="form-group col-lg-12">
                            <td><span class="badge badge-danger font-weight-normal"><?php echo e($campaign->category->name); ?></span>
                            </td>
                        </div>
                        <h3 class="mb-2"><?php echo app('translator')->get('Deadline'); ?></h3>
                        <div class="form-row align-items-center">
                            <div class="col-lg-12 form-group">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><?php echo e($campaign->deadline); ?></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <h3 class="mb-2 mt-30"><?php echo app('translator')->get('Personal Information'); ?></h3>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Full Name'); ?> :</label>
                                <span class="text-light"><?php echo e($campaign->user->firstname); ?>

                                    <?php echo e($campaign->user->lastname); ?></span>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Email'); ?> :</label>
                                <span class="text-light"><?php echo e($campaign->user->email); ?> </span>
                            </div>

                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Mobile'); ?> :</label>
                                <span class="text-light"><?php echo e($campaign->user->mobile); ?> </span>
                            </div>

                            <div class="form-group col-lg-12">
                                <label class="font-weight-bold"><?php echo app('translator')->get('Address'); ?> :</label>
                                <span class="text-light"><?php echo e($campaign->address); ?> </span>
                            </div>


                        </div>
                    </form>
                </div><!-- donation-widget end -->
                <?php if(0 == $campaign->approval && $campaign->rejected == 0): ?>
                    <div class="donation-widget offline-donate base--bg text-center">
                        <h3 class="text-dark"><?php echo app('translator')->get('Do You Want to Approve'); ?>?</h3>

                        <div class="row mt-5">
                            <div class="col">
                                <a href="javascript:void(0)" class="btn btn--success approve"
                                    data-action=<?php echo e(route('admin.fundrise.edit', ['slug' => $campaign->slug, 'id' => $campaign->id])); ?>><i
                                        class="fa fa-check"></i> <?php echo app('translator')->get('Approve'); ?></a>
                            </div>
                            <div class="col">
                                <a href="javascript:void(0)" class="btn btn--danger reject"
                                    data-action=<?php echo e(route('admin.fundrise.edit', ['slug' => $campaign->slug, 'id' => $campaign->id])); ?>>
                                    <i class="fa fa-times"></i> <?php echo app('translator')->get('Reject'); ?></a>
                            </div>
                        </div>

                    </div><!-- donation-widget end -->
                <?php else: ?>

                    <div class="donation-widget shadow">
                        <h4 class="mb-4 text-light"><?php echo app('translator')->get('Latest Donor'); ?></h4>
                        <ul class="donor-small-list">
                            <?php if($campaign->donation->count() == null): ?>

                                <li class="single text-light">
                                    <?php echo app('translator')->get('No Donation Found'); ?>
                                </li>

                            <?php else: ?>
                                <?php $__currentLoopData = $donorList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $don): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="single">
                                        <div class="thumb"><i class="fa fa-user"></i></div>
                                        <div class="content">
                                            <h6 class="text-light"><?php echo e($don->fullname); ?></h6>
                                            <p class="text-light"><?php echo app('translator')->get('Amount'); ?> : $ <?php echo e($don->donation); ?></p>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class=" mt-4 d-block">
                                    <a href="<?php echo e(route('admin.donor', ['campaign' => $campaign->slug, 'counter' => $campaign->id])); ?>"
                                        class="btn btn-light"><?php echo app('translator')->get('View All'); ?></a>
                                </div>
                            <?php endif; ?>

                        </ul>
                    </div><!-- donation-widget end -->
                <?php endif; ?>


            </div>
        </div>
    </div>





    <!-- Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Approval Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <?php echo app('translator')->get('Are You Sure To Approve This Campaign'); ?> ?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <form method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn--primary"><?php echo app('translator')->get('Approve'); ?></button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    

    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Reject Confirmation'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <?php echo app('translator')->get('Are You Sure To Reject This Campaign'); ?> ?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <form method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <button type="submit" class="btn btn--primary"><?php echo app('translator')->get('Reject'); ?></button>
                    </form>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <div class="d-flex flex-row-reverse bd-highlight ">
        <div class="p-2 bd-highlight">
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn--primary"> <i class="fas fa-reply"></i> <?php echo app('translator')->get('Back'); ?></a>
        </div>

    </div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/lightcase.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/animate.css')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <style>
        .btn-primary {
            background: #7367F0;
            border: 1px solid #7367F0;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background: #7367F0;
            border: 1px solid #7367F0;
        }

        .input-group-text {
            background: none;
            border: none;
            color: #ffffff;
        }

        .badge-danger {
            padding: 8px 10px;
            border-radius: 10px;
        }

        .progressbar {
            position: relative;
            display: block;
            width: 100%;
            height: 10px;
            background-color: #eeeeee;
            border-radius: 999px;
            -webkit-border-radius: 999px;
            -moz-border-radius: 999px;
            -ms-border-radius: 999px;
            -o-border-radius: 999px;
        }

        .progressbar .bar {
            position: absolute;
            width: 0px;
            height: 100%;
            top: 0;
            left: 0;
            background: #13c366;
            overflow: hidden;
            border-radius: 999px;
            -webkit-border-radius: 999px;
            -moz-border-radius: 999px;
            -ms-border-radius: 999px;
            -o-border-radius: 999px;
        }

        .progressbar .label {
            position: absolute;
            top: -40px;
            left: 0;
            padding: 2px 8px;
            height: 30px;
            display: block;
            background-color: #ffffff;
            line-height: 28px;
            text-align: center;
            color: #7367F0;
            font-size: 14px;
            -webkit-transform: translateX(-22px);
            -ms-transform: translateX(-22px);
            transform: translateX(-22px);
            border-radius: 3px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            -ms-border-radius: 3px;
            -o-border-radius: 3px;
        }

        .progressbar .label::before {
            position: absolute;
            content: '';
            bottom: -10px;
            left: 50%;
            -webkit-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
            width: 10px;
            height: 10px;
            border-top: 6px solid #ffffff;
            border-bottom: 5px solid transparent;
            border-right: 5px solid transparent;
            border-left: 5px solid transparent;
            font-weight: 800;
        }

        /* event details css start */
        .event-details-wrapper {
            width: 75%;
            padding: 30px;
            background-color: #ffffff;
            border: 5px solid #f1f1f1;
        }

        @media (max-width: 767px) {
            .event-details-wrapper {
                padding: 15px;
            }
        }

        .event-details-thumb img {
            width: 100%;

        }

        .vent-details-form label {
            font-size: 14px;
            text-transform: uppercase;
        }

        .text-small {
            font-size: 12px !important;
        }

        .single-review {
            padding: 15px 0;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            border-bottom: 1px solid #e5e5e5;
        }

        .single-review:first-child {
            padding-top: 0;
        }

        .single-review:last-child {
            padding-bottom: 0;
            border-bottom: none;
        }

        .single-review .thumb {
            width: 120px;
        }

        .single-review .content {
            width: calc(100% - 120px);
            padding-left: 20px;
        }

        @media (max-width: 575px) {
            .single-review .content {
                width: 100%;
                padding-left: 0;
                margin-top: 20px;
            }
        }

        .single-review .ratings {
            float: right;
            margin-top: -28px;
        }

        @media (max-width: 575px) {
            .single-review .ratings {
                float: none;
                margin-top: 10px;
            }
        }

        .single-review .ratings i {
            color: #ffb560;
            font-size: 13px;
        }

        .single-review .date {
            font-size: 14px;
            font-style: italic;
        }

        .nav-tabs--style {
            border: none;
            margin: -3px -10px;
        }

        .nav-tabs--style .nav-item {
            margin: 3px 10px;
        }

        .nav-tabs--style .nav-item .nav-link {
            padding: 14px 30px;
            border: none;
            color: #6f6f6f;
            border-radius: 0;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            -ms-border-radius: 0;
            -o-border-radius: 0;
            position: relative;
            background-color: #f1f1f1;
        }

        .nav-tabs--style .nav-item .nav-link.active {
            background-color: #7367F0;
            color: #ffffff;
        }

        .donation-widget+.donation-widget {
            margin-top: 50px;
        }

        .donation-widget {
            padding: 40px 30px;
            background-color: #7367F0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            color: #ffffff;
        }

        .donation-widget h3 {
            color: #ffffff !important;
        }

        .donation-widget .donate-item {
            border-right: 1px solid #e5e5e5;
        }

        .donation-widget .donate-item:last-child {
            border-right: none;
        }

        .donation-widget .donate-item .amount {
            line-height: 1;
        }

        .donation-widget.offline-donate .mail-address {
            font-size: 24px;
        }

        .donor-small-list .single {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #e5e5e5;
        }

        .donor-small-list .single:first-child {
            padding-top: 0;
        }

        .donor-small-list .single:last-child {
            padding-bottom: 0;
            border-bottom: none;
        }

        .donor-small-list .single .thumb {
            width: 70px;
        }

        .donor-small-list .single .thumb img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            object-fit: cover;
            -o-object-fit: cover;
            object-position: center;
            -o-object-position: center;
        }

        .donor-small-list .single .content {
            width: calc(100% - 70px);
            padding-left: 20px;
        }

        .donor-small-list .single .content p {
            color: #13c366;
            font-size: 14px;
            text-transform: uppercase;
        }

        .gallery-card {
            position: relative;
        }

        .gallery-card:hover .view-btn {
            opacity: 1;
            visibility: visible;
        }

        .gallery-card .view-btn {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.65);
            color: #ffffff;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            font-size: 42px;
            opacity: 0;
            visibility: none;
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }

        .thumb i {
            color: #ffffff;
            font-size: 32px;
        }


        /* event details css end */

    </style>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/admin/js/vendor/lightcase.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/wow.js')); ?>"></script>

    <script>
        'use strict';

        $('a[data-rel^=lightcase]').lightcase();

        $(".progressbar").each(function() {
            $(this).find(".bar").animate({
                "width": $(this).attr("data-perc")
            }, 3000);
            $(this).find(".label").animate({
                "left": $(this).attr("data-perc")
            }, 3000);
        });

        new WOW().init();


        $('.approve').click(function() {
            $('#approveModal').attr('action', $(this).data('action'));
            $('#approveModal').modal('show');
        });


        $('.reject').click(function() {

            $('#rejectModal').attr('action', $(this).data('action'));
            $('#rejectModal').modal('show');
        });

        $("input[type=checkbox]").on('change', function() {

            var id = $(this).data('id');
            var status = 0
            if ($(this).prop('checked')) {
                status = 1;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                data: {
                    status: status,
                    id: id
                },
                url: "<?php echo e(route('admin.make.featured')); ?>",
                success: function(response) {
                    console.log(response);
                }
            })
        })

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\setu\situ_foundation\core\resources\views/admin/fundrise/editfund.blade.php ENDPATH**/ ?>