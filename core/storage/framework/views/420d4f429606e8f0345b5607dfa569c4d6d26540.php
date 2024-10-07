<?php if(\App\Extension::where('act', 'google-analytics')->where('status', 1)->first()): ?>
    <?php echo  analytics() ?>
<?php endif; ?>
<?php /**PATH /home/setu.foundation/public_html/core/resources/views/partials/analytics.blade.php ENDPATH**/ ?>