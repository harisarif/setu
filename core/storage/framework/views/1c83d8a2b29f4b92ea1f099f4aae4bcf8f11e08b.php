<?php $__env->startSection('content'); ?>
<!-- blog-section start -->
<section class="pt-150 pb-150">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="row mb-none-30" id="appear">
            <?php $__empty_1 = true; $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-6 mb-30 ajaxDom" >
              <div class="blog-post hover--effect-1 has-link">
                <a href="<?php echo e(route('user.success.details',['slug'=>$bl->slug,'id'=>$bl->id])); ?>" class="item-link"></a>
                <div class="blog-post__thumb">
                <img src="<?php echo e(get_image(imagePath()['success']['path'].'/'.$bl->image)); ?>" alt="<?php echo app('translator')->get('image'); ?>" class="w-100">
                </div>
                <div class="blog-post__content">
                  <ul class="blog-post__meta mb-3">
                    <li>
                      <a href="#0"><?php echo app('translator')->get('Post by Admin'); ?></a>
                    </li>
                    <li>
                      <i class="las la-calendar-day"></i>
                    <span><?php echo e(Carbon\Carbon::parse($bl->created_at)->toFormattedDateString()); ?></span>
                    </li>
                  </ul>
                  <h4 class="blog-post__title"><?php echo __(shortDescription($bl->title,50)) ?></h4>
                  <p><?php echo __(shortDescription($bl->short_description,100)) ?></p>
                  <i class="blog-post__icon las la-arrow-right"></i>
                </div>
              </div>
            </div><!-- blog-post end -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-md-12 mb-30">
              <div class="card">
                <div class="card-body">
                  <p class="text-center text-danger"><?php echo app('translator')->get('No Success Story Found'); ?></p>
                </div>
              </div>
              
            </div>

            <?php endif; ?>
          </div><!-- row end -->
          <div class="row">
            <div class="col-lg-12">
              <div class=" py-4">
                <?php echo e($blog->links($activeTemplate.'partials.paginate')); ?>

            </div>
            </div>
          </div><!-- row end -->
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="sidebar">
              <div class="widget search--widget">
                <form class="search-form" method="GET" action="<?php echo e(route('user.success.ajax')); ?>">
                  <input type="search" name="search__field" id="search__field" placeholder="<?php echo app('translator')->get('Search here by Title'); ?> ...." class="form-control" required>
                  <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                </form>
              </div><!-- widget end -->
              <div class="widget p-0">
                <div class="widget-title">
                  <h5 class=""><?php echo app('translator')->get('Categories'); ?></h5>
                </div>
                <ul class="categories__list widget-body">
                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li class="categories__item"><a href="<?php echo e(route('user.success.archive',['category'=>$cat->name])); ?>"><?php echo e(__($cat->name)); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div><!-- widget end -->
              <div class="widget p-0">
                <div class="widget-title">
                      <h5 class=""><?php echo app('translator')->get('Archive'); ?></h5>
                </div>
               
                <ul class="archive__list widget-body">
                  <?php $__currentLoopData = $archive; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="archive__item"><a href="<?php echo e(route('user.success.archive',['month'=> $arch->Month , 'year'=>$arch->Year])); ?>"><?php echo e(__($arch->Month)); ?> <?php echo e(__($arch->Year)); ?></a></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div><!-- widget end -->
              <div class="widget p-0">
                <div class="widget-title">
                  <h5 class=""><?php echo app('translator')->get('recent post'); ?></h5>
                </div>
                <ul class="small-post-list widget-body">
              <?php $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $re): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="small-post">
                <div class="small-post__thumb"><img src="<?php echo e(asset(imagePath()['success']['path'].'/'.$re->image)); ?>" alt="<?php echo app('translator')->get('image'); ?>"></div>
                    <div class="small-post__content">
                    <h5 class="post__title"><a href="<?php echo e(route('user.success.details',['slug'=>$re->slug,'id'=>$re->id])); ?>"><?php echo e(shortDescription($re->title,30)); ?></a></h5>
                    </div>
                  </li><!-- small-post end -->
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul><!-- small-post-list end -->
              </div><!-- widget end -->
             
            </div><!-- sidebar end -->
          </div>
    </div>
  </section>
  <!-- blog-section end -->

  <?php $__env->stopSection(); ?>

  <?php $__env->startPush('style'); ?>
      <style>
        .widget-title{
            padding: 10px;
            background: #13c366;
            line-height: 1.5;
        }

        .widget-title h5{
            color:#fff;
        }
        .widget-body{
            padding: 30px;
        }
      </style>
  <?php $__env->stopPush(); ?>


<?php echo $__env->make($activeTemplate.'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/sections/allblog.blade.php ENDPATH**/ ?>