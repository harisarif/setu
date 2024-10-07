<?php $__env->startSection('content'); ?>

    <!-- dashboard section start -->
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row mb-none-30">

                <?php if($campaign['expired'] > 0): ?>
                    <div class="offset-lg-9 col-md-3">
                        <div class="alert alert-warning alert-dismissible fade show shadow text-center" role="alert">
                            <a href="<?php echo e(route('user.fundrise.expired')); ?>" class="text-danger">
                              <?php echo app('translator')->get('Campaign Expired'); ?> (<?php echo e($campaign['expired']); ?>)
                            </a>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>

                <?php endif; ?>

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-one">
                        <div class="d-widget__icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white"><?php echo e($campaign['requested']); ?></h2>
                            <span class="caption text-white"><?php echo app('translator')->get('Total Campaign'); ?></span>
                        </div>
                        <a href="<?php echo e(route('user.fundrise.all')); ?>" class="view-btn"><?php echo app('translator')->get('View all'); ?></a>
                    </div><!-- d-widget end -->
                </div>

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-two">
                        <div class="d-widget__icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white"><?php echo e($general->cur_sym); ?>

                                <?php echo e(number_format($campaign['collectedFund'], 2)); ?></h2>
                            <span class="caption text-white"><?php echo app('translator')->get('Total Collected Fund'); ?></span>
                        </div>

                    </div><!-- d-widget end -->
                </div>

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-three">
                        <div class="d-widget__icon">
                            <i class="fas fa-donate"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white"><?php echo e($campaign['donateLog']); ?></h2>
                            <span class="caption text-white"><?php echo app('translator')->get('Total Donation'); ?></span>
                        </div>
                        <a href="<?php echo e(route('user.donation.log')); ?>" class="view-btn"><?php echo app('translator')->get('View all'); ?></a>
                    </div><!-- d-widget end -->
                </div>
                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-four">
                        <div class="d-widget__icon">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white"><?php echo e($campaign['pending']); ?></h2>
                            <span class="caption text-white"><?php echo app('translator')->get('Pending Campaign'); ?></span>
                        </div>
                        <a href="<?php echo e(route('user.fundrise.pending')); ?>" class="view-btn"><?php echo app('translator')->get('View all'); ?></a>
                    </div><!-- d-widget end -->
                </div>

                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-five">
                        <div class="d-widget__icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white"><?php echo e($campaign['completed']); ?></h2>
                            <span class="caption text-white"><?php echo app('translator')->get('Campaign Completed'); ?></span>
                        </div>
                        <a href="<?php echo e(route('user.fundrise.complete')); ?>" class="view-btn"><?php echo app('translator')->get('View all'); ?></a>
                    </div><!-- d-widget end -->
                </div>


                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-six">
                        <div class="d-widget__icon">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white"><?php echo e($campaign['rejectLog']); ?></h2>
                            <span class="caption text-white"><?php echo app('translator')->get('Campaign Rejected'); ?></span>
                        </div>
                        <a href="<?php echo e(route('user.fundrise.rejected')); ?>" class="view-btn"><?php echo app('translator')->get('View all'); ?></a>
                    </div><!-- d-widget end -->
                </div>


                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-seven">
                        <div class="d-widget__icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white"><?php echo e($general->cur_sym); ?>

                                <?php echo e(number_format($campaign['withdraw'], 2)); ?></h2>
                            <span class="caption text-white"><?php echo app('translator')->get('Total Withdraw'); ?></span>
                        </div>
                        <a href="<?php echo e(route('user.withdraw.history')); ?>" class="view-btn"><?php echo app('translator')->get('View all'); ?></a>
                    </div><!-- d-widget end -->
                </div>


                <div class="col-lg-3 col-sm-6 mb-30">
                    <div class="d-widget bg-eight">
                        <div class="d-widget__icon">
                            <i class="fab fa-btc"></i>
                        </div>
                        <div class="d-widget__content">
                            <h2 class="d-widget__number text-white"><?php echo e($general->cur_sym); ?>

                                <?php echo e(number_format($campaign['current_balance'], 2)); ?></h2>
                            <span class="caption text-white"><?php echo app('translator')->get('Current Balance'); ?></span>
                        </div>

                    </div><!-- d-widget end -->
                </div>


                <div class="col-md-6 mb-30">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo app('translator')->get('Monthly Donation report'); ?></h5>
                            <div id="apex-line"> </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-6 mb-30">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo app('translator')->get('Monthly Withdraw report'); ?></h5>
                            <div id="apex-line-withdraw"></div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>
    <!-- dashboard section end -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .bttn {
            padding: 5px 35px;
            color: #16c26b;

        }

        .bttn:hover {
            background: #16c26b;
            padding: 5px 35px;
            border-radius: 5px;
            color: aliceblue;

        }

        .feature-card {
            min-width: 383px;
        }

    </style>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/vendor/apexchart.js')); ?>" charset="utf-8"></script>
    <script>
        'use strict';
        // apex-line chart
        var options = {
            series: [{
                data: <?php echo json_encode($donations['per_day_amount'], 15, 512) ?>
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '15%',
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: <?php echo json_encode($donations['per_day'], 15, 512) ?>
            }
        };

        // withdraw Apex Chart

        var withdraw = {
            series: [{
                data: <?php echo json_encode($withdraws['per_day_amount'], 15, 512) ?>
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '10%',
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: <?php echo json_encode($withdraws['per_day'], 15, 512) ?>
            }
        };

        var chart = new ApexCharts(document.querySelector("#apex-line"), options);
        var chart2 = new ApexCharts(document.querySelector("#apex-line-withdraw"), withdraw);

        chart.render();
        chart2.render();

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate.'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/user/dashboard.blade.php ENDPATH**/ ?>