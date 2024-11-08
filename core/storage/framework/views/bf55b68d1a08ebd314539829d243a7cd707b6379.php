<!-- navbar-wrapper start -->
<nav class="navbar-wrapper">
    <form class="navbar-search" onsubmit="return false;">
        <button type="submit" class="navbar-search__btn">
            <i class="las la-search"></i>
        </button>
        <input type="search" name="navbar-search__field" id="navbar-search__field"
               placeholder="Search...">
        <button type="button" class="navbar-search__close"><i class="las la-times"></i></button>

        <div id="navbar_search_result_area">
            <ul class="navbar_search_result"></ul>
        </div>
    </form>

    <div class="navbar__left">
        <button class="res-sidebar-open-btn"><i class="las la-bars"></i></button>
        <button type="button" class="fullscreen-btn">
            <i class="fullscreen-open las la-compress" onclick="openFullscreen();"></i>
            <i class="fullscreen-close las la-compress-arrows-alt" onclick="closeFullscreen();"></i>
        </button>
    </div>

    <div class="navbar__right">
        <ul class="navbar__action-list">
            <li>
                <button type="button" class="navbar-search__btn-open">
                    <i class="las la-search"></i>
                </button>
            </li>


            <li class="dropdown">
                <button type="button" class="" data-toggle="dropdown" data-display="static" aria-haspopup="true"
                        aria-expanded="false">


          <span class="navbar-user">
            <span class="navbar-user__thumb"><img
                    src="<?php echo e(getImage('assets/admin/images/profile/'. auth()->guard('admin')->user()->image)); ?>"
                    alt="image"></span>

            <span class="navbar-user__info">
              <span class="navbar-user__name"><?php echo e(auth()->guard('admin')->user()->username); ?></span>
            </span>
            <span class="icon"><i class="las la-chevron-circle-down"></i></span>
          </span>
                </button>
                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-right">
                    <?php if(Route::has('admin.profile')): ?>
                        <a href="<?php echo e(route('admin.profile')); ?>"
                           class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                            <i class="dropdown-menu__icon las la-user-circle"></i>
                            <span class="dropdown-menu__caption"><?php echo app('translator')->get('Profile'); ?></span>
                        </a>
                    <?php endif; ?>

                    <?php if(Route::has('admin.profile')): ?>
                        <a href="<?php echo e(route('admin.password')); ?>"
                           class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                            <i class="dropdown-menu__icon las la-key"></i>
                            <span class="dropdown-menu__caption"><?php echo app('translator')->get('Password'); ?></span>
                        </a>
                    <?php endif; ?>

                    <?php if(Route::has('admin.logout')): ?>
                        <a href="<?php echo e(route('admin.logout')); ?>"
                           class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                            <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                            <span class="dropdown-menu__caption"><?php echo app('translator')->get('Logout'); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- navbar-wrapper end -->
<?php /**PATH C:\laragon\www\setu-github\setu\core\resources\views/admin/partials/topnav.blade.php ENDPATH**/ ?>