<?php
    $data = getContent('campaign.content',true);
    $now = Carbon\Carbon::now();

    $campaign = App\Campaign::where('stop_status',0)->where('approval',1)->where('complete_status',0)->where('deadline','>',$now)->latest()->take(6)->get();

?>
<!-- event section start -->
<section class="pt-150 pb-150 position-relative base--bg">
    <div class="section-img"><img src="<?php echo e(get_image($activeTemplateTrue.'images/texture-3.jpg')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></div>
    <div class="bottom-shape"><img src="<?php echo e(asset($activeTemplateTrue.'images/top-shape.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-8">
          <div class="section-header text-center">
          <h2 class="section-title text-white"><?php echo e(__($data->data_values->title)); ?></h2>
          <p class="text-white"><?php echo e(__($data->data_values->description)); ?></p>
          </div>
        </div>
      </div><!-- row end -->
      <div class="row mb-none-30">
        <?php $__currentLoopData = $campaign; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $camp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-6 mb-30">
          <div class="event-card hover--effect-1 has-link">
          <a href="<?php echo e(route('user.campaign.details',['slug' => $camp->slug, 'id' => $camp->id])); ?>" class="item-link"></a>
            <div class="event-card__thumb">
            <img src="<?php echo e(get_image(imagePath()['campaign']['path'].'/'.$camp->image)); ?>" alt="<?php echo app('translator')->get('image'); ?>" class="w-100">
            </div>
            <div class="event-card__content">
            <h4 class="title"><?php echo e(Str::limit($camp->title,50)); ?></h4>

            <span class="days-left mb-3 font-italic" data-deadline = <?php echo e($camp->deadline); ?>>
              <span class="day"></span>
              <span class="hour"></span>
              <span class="minute"></span>
              <span class="sec"></span>

            </span>
              <p class="text-justify"><?php echo e(Str::limit($camp->description,120)); ?></p>
              <div class="event-bar-item">
                <div class="skill-bar">
                  <?php
                    $percent = ($camp->donation->where('payment_status',1)->sum('donation') * 100) / $camp->goal;
                  ?>
                  <div class="progressbar" data-perc="<?php echo e($percent > 100 ? '100': $percent); ?>%">
                    <div class="bar"></div>
                    <span class="label"><?php echo e(number_format(($percent > 100 ? '100': $percent),2)); ?>%</span>
                  </div>
                </div>
              </div><!-- event-bar-item end -->
              <div class="amount-status">
              <div class="left"><?php echo app('translator')->get('Raised'); ?> - <b><?php echo e($general->cur_sym); ?>  <?php echo e($camp->donation->where('payment_status',1)->sum('donation')); ?></b></div>
              <div class="right"><?php echo app('translator')->get('Goal'); ?> - <b><?php echo e($general->cur_sym); ?> <?php echo e($camp->goal); ?></b></div>
              </div>
            </div>
          </div><!-- event-card end -->
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

       <div class="col-md-12 mb-5 text-center">
       <a href="<?php echo e(route('user.campaigns')); ?>" class="cmn-btn"><?php echo app('translator')->get('Show All Campaign'); ?></a>
       </div>
      </div>

    </div>
  </section>
  <!-- event section end -->


<?php $__env->startPush('script'); ?>
      <script>

        'use strict';

         $(".progressbar").each(function(){
            $(this).find(".bar").animate({
              "width": $(this).attr("data-perc")
            },3000);
            $(this).find(".label").animate({
              "left": $(this).attr("data-perc")
            },3000);
        });


        var x = setInterval(function() {
          console.log('a');
          var deadline = $('.days-left').each(function(item){

              var countDownDate = new Date($(this).data('deadline')).getTime();
              // Get today's date and time
              var now = new Date().getTime();

              // Find the distance between now and the count down date
              var distance = countDownDate - now;

              // Time calculations for days, hours, minutes and seconds
              var days = Math.floor(distance / (1000 * 60 * 60 * 24));
              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);
              $(this).children('.day').text(days + 'D');
              $(this).children('.hour').text(hours + 'H');
              $(this).children('.minute').text(minutes + 'M');
              $(this).children('.sec').text(seconds + 'S');

              if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                  }

              });
                            // If the count down is finished, write some text

                }, 1000);


      </script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('style'); ?>

     <style>

       .btn--primary{
         background: #ffffff;
         margin-left: 50%;
         transform: translate(-50%, 30%);
       }
        h4.title {
          min-height: 60px;
        }

        .day{
          width: 50px;
          height: 50px;
          border: 2px dashed mediumseagreen;
          border-radius: 50%;
          margin-right: 4px;
          text-align: center;
          font-weight: bolder;
          color: mediumseagreen;
        }

        .hour{
          width: 50px;
          height: 50px;
          border: 2px dashed mediumseagreen;
          border-radius: 50%;
          margin-right: 4px;
          text-align: center;
          font-weight: bolder;
          color: mediumseagreen;
        }
        .minute{
          width: 50px;
          height: 50px;
          border: 2px dashed mediumseagreen;
          border-radius: 50%;
          margin-right: 4px;
          text-align: center;
          font-weight: bolder;
          color: mediumseagreen;
        }
        .sec{
          width: 50px;
          height: 50px;
          border: 2px dashed mediumseagreen;
          border-radius: 50%;
          margin-right: 4px;
          text-align: center;
          font-weight: bolder;
          color: mediumseagreen;
        }
        .days-left > span {
          display: inline-flex;
          align-items: center;
          justify-content: center;
        }
      </style>

<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\setu-github\setu\core\resources\views/templates/basic/sections/campaign.blade.php ENDPATH**/ ?>