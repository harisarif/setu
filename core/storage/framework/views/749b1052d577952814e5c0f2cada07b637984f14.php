

<?php $__env->startSection('panel'); ?>
    <?php if($general->sys_version): ?>
        <div class="row">
            <div class="col-md-12">

                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <h3 class="card-title"> <?php echo app('translator')->get('New Version Available'); ?> <button class="btn btn--dark float-right"><?php echo app('translator')->get('Version'); ?> <?php echo e(json_decode($general->sys_version)->version); ?></button> </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-dark"><?php echo app('translator')->get('What is the Update ?'); ?></h5>
                        <p><pre  class="font-20"><?php echo e(@json_decode($general->sys_version)->details); ?></pre></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--primary b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e($widget['total_users']); ?></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Users'); ?></span>
                    </div>
                    <a href="<?php echo e(route('admin.users.all')); ?>" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--cyan b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e($widget['verified_users']); ?></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Verified Users'); ?></span>
                    </div>
                    <a href="<?php echo e(route('admin.users.active')); ?>" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--orange b-radius--10 box-shadow ">
                <div class="icon">
                    <i class="la la-envelope"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e($widget['email_unverified_users']); ?></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Email Unverified Users'); ?></span>
                    </div>

                    <a href="<?php echo e(route('admin.users.emailUnverified')); ?>" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--pink b-radius--10 box-shadow ">
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e($widget['sms_unverified_users']); ?></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total SMS Unverified Users'); ?></span>
                    </div>

                    <a href="<?php echo e(route('admin.users.smsUnverified')); ?>" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->


        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--gradi-44 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-globe"></i>
                </div>
                 <div class="details">
                    <div class="numbers">
                        <span class="status"></span>
                    <span class="amount"><?php echo e($widget['total_campaign']); ?></span>
                        <span class="currency-sign"></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Campaign'); ?></span>
                    </div>

                <a href="<?php echo e(route('admin.fundrise.approved')); ?>" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--gradi-7 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-globe"></i>
                </div>
               <div class="details">
                    <div class="numbers">
                        <span class="status"></span>
                    <span class="amount"></span>
                    <span class="currency-sign"><?php echo e($widget['total_donation']); ?> <?php echo e($general->cur_sym); ?></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Donation'); ?></span>
                    </div>

                    <a href="<?php echo e(route('admin.donor')); ?>" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--purple  b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-bar-chart"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                    <span class="amount"><?php echo e($widget['total_donor']); ?></span>
                        <span class="currency-sign"></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Donor'); ?></span>
                    </div>

                <a href="<?php echo e(route('admin.donor')); ?>" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--gradi-50 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-comments"></i>
                </div>
               <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e(number_format($widget['total_withdraw'],2)); ?></span>
                    <span class="currency-sign"><?php echo e($general->cur_sym); ?></span>
                    </div>
                    <div class="desciption">
                        <span class="text--small"><?php echo app('translator')->get('Total Withdraw'); ?></span>
                    </div>

                <a href="<?php echo e(route('admin.withdraw.log')); ?>" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                </div>
            </div>
        </div><!-- dashboard-w1 end -->
    </div><!-- row end-->

    <div class="row mt-50 mb-none-30">
        <div class="col-xl-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo app('translator')->get('Monthly  Deposit & Withdraw  Report'); ?></h5>
                    <div id="apex-bar-chart"> </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-30">
            <div class="row mb-none-30">
                <div class="col-lg-6 col-sm-6 mb-30">
                    <div class="widget-three box--shadow2 b-radius--5 bg--white">
                        <div class="widget-three__icon b-radius--rounded bg--primary box--shadow2">
                            <i class="las la-wallet "></i>
                        </div>
                        <div class="widget-three__content">
                            <h2 class="numbers"><?php echo e($payment['total_deposit']); ?></h2>
                            <p  class="text--small"><?php echo app('translator')->get('Number Of Donation'); ?></p>
                        </div>
                    </div><!-- widget-two end -->
                </div>
                <div class="col-lg-6 col-sm-6 mb-30">
                    <div class="widget-three box--shadow2 b-radius--5 bg--white">
                        <div class="widget-three__icon b-radius--rounded bg--pink  box--shadow2">
                            <i class="las la-money-bill "></i>
                        </div>
                        <div class="widget-three__content">
                            <h2 class="numbers"><?php echo e(getAmount($payment['total_deposit_amount'])); ?> <?php echo e($general->cur_text); ?></h2>
                            <p class="text--small"><?php echo app('translator')->get('Total Donation'); ?></p>
                        </div>
                    </div><!-- widget-two end -->
                </div>
                <div class="col-lg-6 col-sm-6 mb-30">
                    <div class="widget-three box--shadow2 b-radius--5 bg--white">
                        <div class="widget-three__icon b-radius--rounded bg--teal box--shadow2">
                            <i class="las la-money-check"></i>
                        </div>
                        <div class="widget-three__content">
                            <h2 class="numbers"><?php echo e(getAmount($payment['total_deposit_charge'])); ?> <?php echo e($general->cur_text); ?></h2>
                            <p class="text--small"><?php echo app('translator')->get('Total Donation Charge'); ?></p>
                        </div>
                    </div><!-- widget-two end -->
                </div>
                <div class="col-lg-6 col-sm-6 mb-30">
                    <div class="widget-three box--shadow2 b-radius--5 bg--white">
                        <div class="widget-three__icon b-radius--rounded bg--green  box--shadow2">
                            <i class="las la-money-bill-wave "></i>
                        </div>
                        <div class="widget-three__content">
                            <h2 class="numbers"><?php echo e($payment['total_deposit_pending']); ?></h2>
                            <p class="text--small"><?php echo app('translator')->get('Pending Donation'); ?></p>
                        </div>
                    </div><!-- widget-two end -->
                </div>
            </div>
        </div>
    </div><!-- row end -->


    <div class="row mt-50 mb-none-30">
        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--19 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e($paymentWithdraw['total_withdraw']); ?></span>
                    </div>
                    <div class="desciption">
                        <span><?php echo app('translator')->get('Total Withdraw'); ?></span>
                    </div>
                    <a href="<?php echo e(route('admin.withdraw.method.index')); ?>" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--3 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-hand-holding-usd"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e(getAmount($paymentWithdraw['total_withdraw_amount'])); ?></span>
                        <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                    </div>
                    <div class="desciption">
                        <span><?php echo app('translator')->get('Total Withdraw'); ?></span>
                    </div>
                    <a href="<?php echo e(route('admin.withdraw.approved')); ?>" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--12 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-money-bill-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e(getAmount($paymentWithdraw['total_withdraw_charge'])); ?> </span>
                        <span class="currency-sign"><?php echo e($general->cur_text); ?></span>
                    </div>
                    <div class="desciption">
                        <span><?php echo app('translator')->get('Total Withdraw Charge'); ?></span>
                    </div>

                    <a href="<?php echo e(route('admin.withdraw.approved')); ?>" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--6 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-spinner"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount"><?php echo e($paymentWithdraw['total_withdraw_pending']); ?></span>
                    </div>
                    <div class="desciption">
                        <span><?php echo app('translator')->get('Withdraw Pending'); ?></span>
                    </div>

                    <a href="<?php echo e(route('admin.withdraw.pending')); ?>" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3"><?php echo app('translator')->get('View All'); ?></a>
                </div>
            </div>
        </div>
    </div>


    <div class="row mb-none-30 mt-5">

        <div class="col-xl-6 mb-30">
            <div class="card ">
                <div class="card-header">
                    <h6 class="card-title mb-0"><?php echo app('translator')->get('New User list'); ?></h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('User'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Username'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Email'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $latestUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td data-label="<?php echo app('translator')->get('User'); ?>">
                                        <div class="user">
                                            <div class="thumb"><img src="<?php echo e(getImage('assets/images/user/profile/'. $user->image,'350x300')); ?>" alt="image"></div>
                                            <span class="name"><?php echo e($user->fullname); ?></span>
                                        </div>
                                    </td>
                                    <td data-label="<?php echo app('translator')->get('Username'); ?>"><a href="<?php echo e(route('admin.users.detail', $user->id)); ?>"><?php echo e($user->username); ?></a></td>
                                    <td data-label="<?php echo app('translator')->get('Email'); ?>"><?php echo e($user->email); ?></td>
                                    <td data-label="<?php echo app('translator')->get('Action'); ?>">
                                        <a href="<?php echo e(route('admin.users.detail', $user->id)); ?>" class="icon-btn" data-toggle="tooltip" title="" data-original-title="<?php echo app('translator')->get('Details'); ?>">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%"><?php echo app('translator')->get('User Not Found'); ?></td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>

        <div class="col-xl-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo app('translator')->get('Last 30 days Withdraw History'); ?></h5>
                    <div id="withdraw-line"></div>
                </div>
            </div>
        </div>


    </div>

    <div class="row mb-none-30 mt-5">
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <h5 class="card-title"><?php echo app('translator')->get('Login By Browser'); ?></h5>
                    <canvas id="userBrowserChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo app('translator')->get('Login By OS'); ?></h5>
                    <canvas id="userOsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo app('translator')->get('Login By Country'); ?></h5>
                    <canvas id="userCountryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

    <script src="<?php echo e(asset('assets/admin/js/vendor/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/chart.js.2.8.0.js')); ?>"></script>


    <script>
        'use strict';
            // apex-bar-chart js
            var options = {
                series: [{
                    name: 'Total Donation',
                    data: <?php echo json_encode($report['deposit_month_amount']->flatten(), 15, 512) ?>
                }, {
                    name: 'Total Withdraw',
                    data: <?php echo json_encode($report['withdraw_month_amount']->flatten(), 15, 512) ?>
                }],
                chart: {
                    type: 'bar',
                    height: 400,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: <?php echo json_encode($report['months']->flatten(), 15, 512) ?>,
                },
                yaxis: {
                    title: {
                        text: "<?php echo e($general->cur_sym); ?>",
                        style: {
                            color: '#7c97bb'
                        }
                    }
                },
                grid: {
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false
                        }
                    },
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "<?php echo e($general->cur_sym); ?>" + val + " "
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#apex-bar-chart"), options);
            chart.render();



    </script>


    <script>
        'use strict';
        // apex-line chart
        var options = {
            chart: {
                height: 430,
                type: "area",
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    enabledSeries: [0],
                    top: -2,
                    left: 0,
                    blur: 10,
                    opacity: 0.08
                },
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
            },
            dataLabels: {
                enabled: false
            },
            series: [
                {
                    name: "Series 1",
                    data: <?php echo json_encode($withdrawals['per_day_amount']->flatten(), 15, 512) ?>
                }
            ],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: <?php echo json_encode($withdrawals['per_day']->flatten(), 15, 512) ?>
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5
                },
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#withdraw-line"), options);

        chart.render();

    </script>



    <script>
        'use strict';

        var ctx = document.getElementById('userBrowserChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($chart['user_browser_counter']->keys(), 15, 512) ?>,
                datasets: [{
                    data: <?php echo e($chart['user_browser_counter']->flatten()); ?>,
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(231, 80, 90, 0.75)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                maintainAspectRatio: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });



        var ctx = document.getElementById('userOsChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($chart['user_os_counter']->keys(), 15, 512) ?>,
                datasets: [{
                    data: <?php echo e($chart['user_os_counter']->flatten()); ?>,
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(0, 0, 0, 0.05)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            },
        });


        // Donut chart
        var ctx = document.getElementById('userCountryChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($chart['user_country_counter']->keys(), 15, 512) ?>,
                datasets: [{
                    data: <?php echo e($chart['user_country_counter']->flatten()); ?>,
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(231, 80, 90, 0.75)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\setu-github\setu\core\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>