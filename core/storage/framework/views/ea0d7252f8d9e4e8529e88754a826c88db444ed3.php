<?php 
 $content = getContent('overview.content', true);

?>
 <!-- overview section start -->
 <section>
    <div class="row no-gutters">
      <div class="col-xl-6 bg_img video-thumb-two min-height--block" data-background="<?php echo e(get_image('assets/images/frontend/overview/'.$content->data_values->image)); ?>">
      <a class="video-button" href="<?php echo e($content->data_values->vedio_Link); ?>" data-rel="lightcase:myCollection"><i class="las la-play"></i></a>
      </div>
      <div class="col-xl-6 pt-120 pb-120 position-relative bg--base text-md-left text-center">
      <div class="section-img"><img src="<?php echo e(get_image($activeTemplateTrue.'images/texture-3.jpg')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></div>
        <div class="overview-area position-relative">
        <h2 class="section-title text-white"><?php echo e($content->data_values->title); ?></h2>
        <p class="text-white"><?php echo e($content->data_values->description); ?></p>
          <div class="row mb-none-30 mt-50">
            <div class="col-md-3 col-6 mb-30">
              <div class="counter-card position-relative z-1">
              <div class="texture-bg"><img src="<?php echo e(get_image($activeTemplateTrue.'images/texture-1.png')); ?>" alt="<?php echo app('translator')->get('images'); ?>"></div>
                <div class="counter-card__content">
                  <span class="count-num color--1">421</span>
                  <p class="text-dark"><?php echo app('translator')->get('Campaigns'); ?></p>
                </div>
              </div>
            </div><!-- counter-card end -->
            <div class="col-md-3 col-6 mb-30">
              <div class="counter-card position-relative z-1">
                <div class="texture-bg"><img src="<?php echo e(asset($activeTemplateTrue.'images/texture-1.png')); ?>" alt="<?php echo app('translator')->get('images'); ?>"></div>
                <div class="counter-card__content">
                  <span class="count-num color--2">29</span>
                  <p class="text-dark"><?php echo app('translator')->get("Country"); ?></p>
                </div>
              </div>
            </div><!-- counter-card end -->
            <div class="col-md-3 col-6 mb-30">
              <div class="counter-card position-relative z-1">
                <div class="texture-bg"><img src="<?php echo e(get_image($activeTemplateTrue.'images/texture-1.png')); ?>" alt="<?php echo app('translator')->get('images'); ?>"></div>
                <div class="counter-card__content">
                  <span class="count-num color--3">2M</span>
                  <p class="text-dark"><?php echo app('translator')->get('People Helped'); ?></p>
                </div>
              </div>
            </div><!-- counter-card end -->
            <div class="col-md-3 col-6 mb-30">
              <div class="counter-card position-relative z-1">
                <div class="texture-bg"><img src="<?php echo e(get_image($activeTemplateTrue.'images/texture-1.png')); ?>" alt="<?php echo app('translator')->get('images'); ?>"></div>
                <div class="counter-card__content">
                  <span class="count-num color--4">12</span>
                  <p class="text-dark"><?php echo app('translator')->get('Award'); ?></p>
                </div>
              </div>
            </div><!-- counter-card end -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- overview section end  -->


<?php $__env->startPush('style'); ?>

  <style>
    /* overview section css start */
.min-height--block {
    min-height: 550px;
}

.video-thumb-two {
    position: relative;
}

.video-thumb-two::before {
    position: absolute;
    content: '';
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #001d4a;
    opacity: 0.65;
}

.video-thumb-two .video-button {
    top: 50%;
    left: 50%;
    margin-left: -50px;
    margin-top: -50px;
}

.overview-area {
    padding-left: 100px;
    padding-right: 250px;
}

@media (max-width: 1750px) {
    .overview-area {
        padding-right: 120px;
    }
}

@media (max-width: 1450px) {
    .overview-area {
        padding-left: 50px;
        padding-right: 50px;
    }
}

@media (max-width: 1199px) {
    .overview-area {
        padding-left: 100px;
        padding-right: 100px;
    }
}

@media (max-width: 767px) {
    .overview-area {
        padding-left: 50px;
        padding-right: 50px;
    }
}

@media (max-width: 575px) {
    .overview-area {
        padding-left: 30px;
        padding-right: 30px;
    }
}

.overview-area .section-title {
    color: #ffffff;
}

.overview-area p {
    color: #e6e6e6;
}

.counter-card {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding: 35px 10px;
    text-align: center;
}

.counter-card__content span {
    font-size: 36px;
    font-family: "Baloo Tammudu 2", cursive;
    font-weight: 700;
    line-height: 1;
}

.counter-card__content p {
    font-size: 16px;
    line-height: 1;
}

.texture-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
}

.texture-bg img {
    width: 100%;
    height: 100%;
}

/* overview section css end */
  </style>
    
<?php $__env->stopPush(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/sections/overview.blade.php ENDPATH**/ ?>