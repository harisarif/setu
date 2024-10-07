

<?php $__env->startSection('content'); ?>
 <!-- blog-details-section start -->
 <section class="blog-details-section pt-150 pb-150">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <div class="blog-details-wrapper">
            <div class="blog-details__thumb">
            <img src="<?php echo e(asset(imagePath()['success']['path'].'/'.$blog->image)); ?>" alt="image">
              <div class="post__date">
                <span class="date"><?php echo e(Carbon\Carbon::parse($blog->created_at)->day); ?></span>
                <span class="month"><?php echo e(Carbon\Carbon::parse($blog->created_at)->format('M')); ?></span>
              </div>
              <div class="post__date_right">
                <span class="date"><?php echo app('translator')->get('View'); ?></span>
                <span class="month"><?php echo e($blog->view); ?></span>
              </div>
            </div><!-- blog-details__thumb end -->
            <div class="blog-details__content">
            <h4 class="blog-details__title"><?php echo e(__($blog->title)); ?></h4>
            <p class="text-justify show-read-more"><?php echo e(__($blog->details)); ?></p>
              
            </div><!-- blog-details__content end -->
            <div class="comments-area">
              <h3 class="title"><?php echo e($comment->count()); ?> <?php echo app('translator')->get('comments'); ?></h3>
              <ul class="comments-list">
            <?php $__empty_1 = true; $__currentLoopData = $comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $com): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="single-comment">
                  <div class="single-comment__thumb">
                    <i class="fa fa-user"></i>
                  </div>
                  <div class="single-comment__content">
                  <h6 class="name"><?php echo e($com->name); ?></h6>
                  <span class="date"><?php echo e($com->created_at->diffForHumans()); ?></span>
                  <p class="text-justify"><?php echo e($com->messages); ?></p>
                  </div>
                </li><!-- single-review end -->
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <p><?php echo app('translator')->get('No Comment Have been Posted Yet'); ?></p>
             <?php endif; ?>
              </ul>
            </div><!-- comments-area end -->
            <div class="comment-form-area">
              <h3 class="title"><?php echo app('translator')->get('Leave a Comment'); ?></h3>
              <form class="comment-form" action="" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                  <div class="col-lg-6 form-group">
                    <input type="text" name="name" id="comment-name" placeholder="<?php echo app('translator')->get('Your Name'); ?>" class="form-control" required>
                  </div>
                  <div class="col-lg-6 form-group">
                    <input type="email" name="email" id="comment-email" placeholder="<?php echo app('translator')->get('Email Address'); ?>" class="form-control" required>
                  </div>
                 
                  <div class="col-lg-12 form-group">
                    <textarea name="message" id="message" placeholder="<?php echo app('translator')->get('Write Comment'); ?>" class="form-control" required></textarea>
                    <code class=""><?php echo app('translator')->get('Charecter Remaining'); ?> <span id="limit">400</span> </code>
                  </div>
                  <div class="col-lg-12">
                    <button type="submit" class="cmn-btn"><?php echo app('translator')->get('Post Comment'); ?></button>
                  </div>
                </div>
              </form>
            </div><!-- comment-form-area end -->
          </div><!-- blog-details-wrapper end -->
         
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="sidebar">
            <div class="widget search--widget">
            <form class="search-form" method="GET" action="<?php echo e(route('user.success.ajax')); ?>">
                <input type="search" name="search__field" id="search__field" placeholder="<?php echo app('translator')->get('Search here'); ?>..." class="form-control" required>
                <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
              </form>
            </div><!-- widget end -->


            <div class="widget p-0">
              <div class="widget-title">
                <h3 class="text-white"><?php echo app('translator')->get('Share Success Story'); ?></h3>
              </div>

              <div class="link-copy copy widget-body">
                <form>
                <input type="text" value="<?php echo e(route('user.success.details',['slug'=> $blog->slug,'id'=>$blog->id])); ?>" class="form-control">
                  <button type="button"><?php echo app('translator')->get('Copy'); ?></button>
                </form>
              </div>
              <ul class="social-links widget-body">
                <li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                <li class="twitter" ><a href="https://twitter.com/intent/tweet?text=Post and Share &amp;url=<?php echo e(urlencode(url()->current())); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                <li class="linkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(urlencode(url()->current())); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
              <li class="whatsapp"><a href="https://wa.me/?text=<?php echo e(urlencode(url()->current())); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
              </ul>
            </div><!-- donation-widget end -->



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
                <h5 class=""><?php echo app('translator')->get('Recent Post'); ?></h5>
              </div>
              <ul class="small-post-list widget-body">
            <?php $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $re): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="small-post">
              <div class="small-post__thumb"><img src="<?php echo e(asset(imagePath()['success']['path'].'/'.$re->image)); ?>" alt="image"></div>
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
    </div>
  </section>
  <!-- blog-details-section end -->

  <?php $__env->stopSection(); ?>


  <?php $__env->startPush('style'); ?>


    <style>

      .post__date_right{
        position: absolute;
        top: 0;
        right: 0;
        width: 75px;
        text-align: center;
      }

      .blog-details__thumb .post__date_right .date{
        font-size: 22px;
        font-weight: 700;
        color: #ffffff;
        background-color: #13c366;
        padding: 10px 5px;
        width: 100%;
        line-height: 1;
      }
      
      .blog-details__thumb .post__date_right .month{
        background: #fff;
        padding: 3px 5px;
        width: 100%;
        font-size: 22px;
        font-weight: 700;
      }
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


      .single-comment__thumb i{
        color: #13c366;
        font-size: 65px;
        margin-left:auto;
      }

      code{
        display: block;
        padding-top: 10px;
      }
       .show-read-more .more-text{
        display: none;
    }
      .social-links {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin: -5px -5px;
    }

    .social-links li {
        margin: 5px 5px;
        width: 45px;
        height: 45px;
        background-color: #13c366;
        text-align: center;
        line-height: 45px;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        -ms-border-radius: 3px;
        -o-border-radius: 3px;
  }

  .social-links li a {
    color: #ffffff;
    font-size: 18px;
}


.social-links li.facebook {
    background-color: #3b5998;
}
.social-links li.twitter {
    background-color: #55acee;
}
.social-links li.linkedin {
    background-color: #0077b5;
}


    .link-copy form{
          display: flex;
    }

    .link-copy form input{
          border-radius: 0;
    }

    .link-copy form button{
      background:#13c366;
      color: #ffffff;
      padding: 0px 10px;
    }

    
    </style>
      
  <?php $__env->stopPush(); ?>



  <?php $__env->startPush('script'); ?>
    
        <script>
          'use strict';

              $(document).ready(function(){

                  
                  var maxLength = 800;
                  $(".show-read-more").each(function(){
                      var myStr = $(this).text();
                      if($.trim(myStr).length > maxLength){
                          var newStr = myStr.substring(0, maxLength);
                          var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                          $(this).empty().html(newStr);
                          $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
                          $(this).append('<span class="more-text">' + removedStr + '</span>');
                      }
                  });
                  $(".read-more").click(function(){
                      $(this).siblings(".more-text").contents().unwrap();
                      $(this).remove();
                  });

                  $('#message').on('keyup paste',function(){
                    var text = $(this).val();
                  
                    $('#limit').text(400-text.length);

                    if(text.length >= 400){
                      var newStr = text.substring(0, 400);
                      $(this).val(newStr);
                      $('#limit').text(0);
                    }
                  })
              });



                var copyButton = document.querySelector('.copy button');
                var copyInput = document.querySelector('.copy input');
                copyButton.addEventListener('click', function(e) {
                  e.preventDefault();
                  var text = copyInput.select();
                  document.execCommand('copy');
                });
                copyInput.addEventListener('click', function() {
                  this.select();
                });

    
        </script>

  <?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate.'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/blogDetails.blade.php ENDPATH**/ ?>