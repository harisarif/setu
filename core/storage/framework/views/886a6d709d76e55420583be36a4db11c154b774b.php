<?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6 col-lg-4 mb-30">
        <div class="event-card hover--effect-1 has-link">
            <div class="<?php echo e(isset($type) ? strtolower($type) : 'feature'); ?>">
                <?php echo e(isset($type) ? $type : $campaign->category->name); ?></div>
            <a href="<?php echo e(route('user.campaign.details', ['slug' => $campaign->slug, 'id' => $campaign->id])); ?>"
                class="item-link"></a>
            <div class="event-card__thumb">
                <img src="<?php echo e(asset(imagePath()['campaign']['path'] . '/' . $campaign->image)); ?>" alt="image"
                    class="w-100">
            </div>

            <div class="event-card__content">
                <h4 class="title"><?php echo e(Str::limit($campaign->title, 50)); ?></h4>
                <span class="days-left mb-3 font-italic" data-deadline=<?php echo e($campaign->deadline); ?>>
                    <span class="day"></span>
                    <span class="hour"></span>
                    <span class="minute"></span>
                    <span class="sec"></span>

                </span>
                <p><?php echo e(Str::limit($campaign->description, 120)); ?></p>
                <div class="event-bar-item">
                    <div class="skill-bar">
                        <?php
                            $percent = ($campaign->donation->where('payment_status', 1)->sum('donation') * 100) / $campaign->goal;
                        ?>
                        <div class="progressbar" data-perc="<?php echo e($percent > 100 ? '100' : $percent); ?>%">
                            <div class="bar"></div>
                            <span class="label"><?php echo e(number_format($percent > 100 ? '100' : $percent, 2)); ?>%</span>
                        </div>
                    </div>
                </div><!-- event-bar-item end -->
                <div class="amount-status">
                    <div class="left"><?php echo app('translator')->get('Raised'); ?> - <b><?php echo e($general->cur_sym); ?>

                            <?php echo e($campaign->donation->where('payment_status', 1)->sum('donation')); ?></b></div>
                    <div class="right"><?php echo app('translator')->get('Goal'); ?> - <b><?php echo e($general->cur_sym); ?> <?php echo e($campaign->goal); ?></b>
                    </div>
                </div>
            </div>
        </div><!-- event-card end -->
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php $__env->startPush('style'); ?>
    <style>
        #overlay {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes  sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }

        .is-hide {
            display: none;
        }

    </style>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/campaign.blade.php ENDPATH**/ ?>