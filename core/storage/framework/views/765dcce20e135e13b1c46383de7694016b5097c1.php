<?php if(\App\Extension::where('act', 'google-analytics')->where('status', 1)->first()): ?>
    <?php echo  analytics() ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\setu\situ_foundation\core\resources\views/partials/analytics.blade.php ENDPATH**/ ?>