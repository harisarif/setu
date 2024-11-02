<?php if(\App\Extension::where('act', 'google-analytics')->where('status', 1)->first()): ?>
    <?php echo  analytics() ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\setu-github\setu\core\resources\views/partials/analytics.blade.php ENDPATH**/ ?>