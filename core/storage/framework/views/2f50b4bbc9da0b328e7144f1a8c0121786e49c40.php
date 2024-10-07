<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <?php echo $__env->make('partials.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <title><?php echo e($general->sitename(trans($page_title))); ?></title>

<!-- Bootstrap CSS -->
   <!-- bootstrap 4  -->
  <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'/css/vendor/bootstrap.min.css')); ?>">
  <!-- fontawesome 5  -->
  <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'/css/all.min.css')); ?>">
  <!-- line-awesome webfont -->
  <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'/css/line-awesome.min.css')); ?>">
  <!-- image and videos view on page plugin -->
  <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'/css/lightcase.css')); ?>">
  
  <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'/css/vendor/animate.min.css')); ?>">
  <!-- custom select css -->
  <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'/css/vendor/nice-select.css')); ?>">
  <!-- slick slider css -->
  <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'/css/vendor/slick.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'/css/bootstrap-fileinput.css')); ?>">
  
  <!-- dashdoard main css -->
  <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'/css/main.css')); ?>">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'/css/bootstrap-fileinput.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset($activeTemplateTrue.'css/custom.css')); ?>">
    <?php echo $__env->yieldPushContent('style-lib'); ?>


    <?php echo $__env->yieldPushContent('style'); ?>
</head>
<body>
    

    <div class="preloader">
        <div class="dl">
          <div class="dl__container">
            <div class="dl__corner--top"></div>
            <div class="dl__corner--bottom"></div>
          </div>
          <div class="dl__square"></div>
        </div>
      </div>
<?php
$contact = getContent('contact_us.content',true);
?>
      <header class="header">
        <div class="header__top">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-sm-6">
                <div class="left d-flex align-items-center">
                  <a href="tel:<?php echo e($contact->data_values->contact_number); ?>"><i class="las la-phone-volume"></i> <?php echo app('translator')->get('Help Center'); ?></a>
                  <div class="language">
                    <i class="las la-globe-europe"></i>
                    <select id="language">
                      <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($lang->code); ?>" <?php echo e(session('lang') == $lang->code ? 'selected':''); ?>><?php echo e(__($lang->name)); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <?php if(auth()->guard()->check()): ?>
                <div class="right text-sm-right text-center">
                  <a href="<?php echo e(route('user.home')); ?>"><i class="las la-sign-in-alt"></i> <?php echo app('translator')->get('Dashboard'); ?></a>
                  
                </div>    
                <?php endif; ?>
                <?php if(auth()->guard()->guest()): ?>
                <div class="right text-sm-right text-center">
                  <a href="<?php echo e(route('user.login')); ?>"><i class="las la-sign-in-alt"></i> <?php echo app('translator')->get('Login'); ?></a>
                  <a href="<?php echo e(route('user.register')); ?>"><i class="las la-user-plus"></i> <?php echo app('translator')->get('Registration'); ?></a>
                </div>    
                <?php endif; ?>
               
              </div>
            </div>
          </div>
        </div>
        <div class="header__bottom">
          <div class="container">
            <nav class="navbar navbar-expand-xl p-0 align-items-center">
            <a class="site-logo site-title" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(get_image(imagePath()['logoIcon']['path'] .'/logo.png')); ?>" alt="site-logo"><span class="logo-icon"><i class="flaticon-fire"></i></span></a>
              <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="menu-toggle"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if(auth()->guard()->check()): ?>
                    
                
                <ul class="navbar-nav main-menu ml-auto">
                  

                  <li class="menu_has_children"><a href="javascript:void(0)"><?php echo app('translator')->get('Campaign'); ?></a>
                    <ul class="sub-menu">
                      <li><a class="dropdown-item" href="<?php echo e(route('user.fundrise')); ?>"><?php echo app('translator')->get('Create Campaign'); ?></a></li>
                      <li><a class="dropdown-item" href="<?php echo e(route('user.fundrise.approved')); ?>"><?php echo app('translator')->get('Approved Campaign'); ?></a></li>
                      <li><a class="dropdown-item" href="<?php echo e(route('user.fundrise.pending')); ?>"><?php echo app('translator')->get('Pending Campaign'); ?></a></li>
                      <li><a class="dropdown-item" href="<?php echo e(route('user.fundrise.rejected')); ?>"><?php echo app('translator')->get('Rejected Campaign'); ?></a></li>
                      <li><a class="dropdown-item" href="<?php echo e(route('user.fundrise.complete')); ?>"><?php echo app('translator')->get('Successfull Campaign'); ?></a></li>
                    </ul>
                  </li>

                  <li class="menu_has_children"><a href="#0"><?php echo app('translator')->get('Withdraw Money'); ?></a>
                    <ul class="sub-menu">
                      <li><a class="dropdown-item" href="<?php echo e(route('user.withdraw')); ?>"><?php echo app('translator')->get('Withdraw Money'); ?></a></li>
                      <li><a class="dropdown-item" href="<?php echo e(route('user.withdraw.history')); ?>"><?php echo app('translator')->get('Withdraw Log'); ?></a></li>
                    </ul>
                  </li>
                    <li class="menu_has_children"><a href="#0"><?php echo app('translator')->get('Ticket'); ?></a>
                        <ul class="sub-menu">
                         <li> <a class="dropdown-item" href="<?php echo e(route('ticket.open')); ?>"><?php echo app('translator')->get('Create New'); ?></a></li>
                         <li><a class="dropdown-item" href="<?php echo e(route('ticket')); ?>"><?php echo app('translator')->get('My Ticket'); ?></a></li>
                        </ul>
                    </li>

                  
                  <li class="menu_has_children"><a href="#0"> <i class="fa fa-user mr-2"></i><?php echo e(@Auth::user()->fullname); ?></a>
                    <ul class="sub-menu">
                        <li><a class="dropdown-item" href="<?php echo e(route('user.change-password')); ?>">
                            <?php echo app('translator')->get('Change Password'); ?>
                        </a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('user.profile-setting')); ?>">
                            <?php echo app('translator')->get('Profile Setting'); ?>
                        </a></li>

                        <li><a class="dropdown-item" href="<?php echo e(route('user.twofactor')); ?>">
                            <?php echo app('translator')->get('2FA Setting'); ?>
                        </a></li>
                       


                        <li><a class="dropdown-item" href="<?php echo e(route('user.logout')); ?>">
                            <?php echo e(__('Logout')); ?>

                        </a></li>
                    </ul>
                  </li>
                </ul>
                <?php endif; ?>
                <?php if(auth()->guard()->guest()): ?>

                <ul class="navbar-nav main-menu ml-auto">
                  <li> <a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
                  <li><a href="<?php echo e(route('user.about')); ?>"><?php echo app('translator')->get('About'); ?></a></li>
                  <li class="menu_has_children"><a href="<?php echo e(route('user.campaigns')); ?>"><?php echo app('translator')->get('Campaigns'); ?></a>
                      
                    </li>
                  <li class="menu_has_children"><a href="<?php echo e(route('user.success.archive')); ?>"><?php echo app('translator')->get('Success Story'); ?></a>
                     
                    </li>
                   
                  </ul>

                <div class="nav-right">
                    <a href="<?php echo e(route('contact')); ?>" class="cmn-btn style--three"><?php echo app('translator')->get('Contact'); ?></a>
                  </div> 
                <?php endif; ?>

                
                
              </div>
            </nav>
          </div>
        </div>
      </header>

      <?php echo $__env->make($activeTemplate.'sections.breadcumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




<?php echo $__env->yieldContent('content'); ?>



<?php echo $__env->make($activeTemplate.'sections.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo e(asset($activeTemplateTrue.'js/vendor/jquery-3.5.1.min.js')); ?>"></script>
<script src="<?php echo e(asset($activeTemplateTrue.'js/vendor/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset($activeTemplateTrue.'js/vendor/jquery.nice-select.min.js')); ?>"></script>
<script src="<?php echo e(asset($activeTemplateTrue.'js/vendor/lightcase.js')); ?>"></script>
<script src="<?php echo e(asset($activeTemplateTrue.'js/vendor/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset($activeTemplateTrue.'js/vendor/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset($activeTemplateTrue.'js/contact.js')); ?>"></script>
<script src="<?php echo e(asset($activeTemplateTrue.'js/app.js')); ?>"></script>

<script src="<?php echo e(asset($activeTemplateTrue.'/js/bootstrap-fileinput.js')); ?>"></script>

<?php echo $__env->yieldPushContent('script-lib'); ?>



<?php echo $__env->make('admin.partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->yieldPushContent('script'); ?>


<script>
  'use strict';

    $('#language').on("change", function() {

window.location.href = "<?php echo e(url('/')); ?>/change/"+$(this).val() ;

});
</script>


<?php
    echo analytics();
?>

</body>
</html>
<?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/layouts/master.blade.php ENDPATH**/ ?>