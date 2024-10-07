<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo e($general->sitename($page_title ?? '500 | Internal Server Error')); ?></title>
  <link rel="shortcut icon" type="image/png" href="<?php echo e(getImage(imagePath()['logoIcon']['path'] .'/favicon.png')); ?>">
  <!-- bootstrap 4  -->
 <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'/css/vendor/bootstrap.min.css')); ?>">
  <!-- dashdoard main css -->
  <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'css/main.css')); ?>">
</head>
  <body>


  <!-- error-404 start -->
  <div class="error">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7 text-center">
           <img src="<?php echo e(asset('assets/images/404.svg')); ?>" alt="image">
          <h2 class="title"><b><?php echo app('translator')->get('500'); ?></b> <?php echo app('translator')->get('Internal Server Error'); ?></h2>
          <p><?php echo app('translator')->get('The server has been deserted for a while.'); ?></p>
          <p><?php echo app('translator')->get('Please be patient or try again later.'); ?></p>
          <a href="<?php echo e(route('home')); ?>" class="cmn-btn mt-4"><?php echo app('translator')->get('Go to Home'); ?></a>
        </div>
      </div>
    </div>
  </div>
  <!-- error-404 end -->

  
  </body>
</html><?php /**PATH D:\laragon\www\setu\situ_foundation\core\resources\views/errors/500.blade.php ENDPATH**/ ?>