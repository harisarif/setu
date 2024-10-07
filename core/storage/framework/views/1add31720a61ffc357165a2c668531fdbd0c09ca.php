
<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card b-radius--10 ">
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table--light style--two">
                    <tbody>
                      <tr>
                          <td><?php echo app('translator')->get('PHP Version'); ?></td>
                          <td><?php echo e($currentPHP); ?></td>
                      </tr>
                      <tr>
                          <td><?php echo app('translator')->get('Laravel Version'); ?></td>
                          <td><?php echo e($laravelVersion); ?></td>
                      </tr>
                      <tr>
                          <td><?php echo app('translator')->get('Server Software'); ?></td>
                          <td><?php echo e(@$serverDetails['SERVER_SOFTWARE']); ?></td>
                      </tr>
                      <tr>
                          <td><?php echo app('translator')->get('Server IP Address'); ?></td>
                          <td><?php echo e(@$serverDetails['SERVER_ADDR']); ?></td>
                      </tr>
                      <tr>
                          <td><?php echo app('translator')->get('Server Protocol'); ?></td>
                          <td><?php echo e(@$serverDetails['SERVER_PROTOCOL']); ?></td>
                      </tr>
                      <tr>
                          <td><?php echo app('translator')->get('HTTP Host'); ?></td>
                          <td><?php echo e(@$serverDetails['HTTP_HOST']); ?></td>
                      </tr>
                      <tr>
                          <td><?php echo app('translator')->get('Database Port'); ?></td>
                          <td><?php echo e(@$serverDetails['DB_PORT']); ?></td>
                      </tr>
                      <tr>
                          <td><?php echo app('translator')->get('App Environment'); ?></td>
                          <td><?php echo e(@$serverDetails['APP_ENV']); ?></td>
                      </tr>
                      <tr>
                          <td><?php echo app('translator')->get('App Debug'); ?></td>
                          <td><?php echo e(@$serverDetails['APP_DEBUG']); ?></td>
                      </tr>
                      <tr>
                          <td><?php echo app('translator')->get('Timezone'); ?></td>
                          <td><?php echo e(@$timeZone); ?></td>
                      </tr>
                    </tbody>
                  </table><!-- table end -->
                </div>
              </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
<style>
  td{
    font-size: 22px !important;
  }
  .table td {
      white-space: nowrap;
  }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/setu.foundation/public_html/core/resources/views/admin/info.blade.php ENDPATH**/ ?>