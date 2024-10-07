<?php if(\App\Extension::where('act', 'custom-captcha')->where('status', 1)->first()): ?>
    <div class="form-group row">
        <div class="col-md-6 mb-2">
            <?php echo  getCustomCaptcha(46,100,'#13c366','','#ffffff',32) ?>
        </div>
        <div class="col-md-6">
            <input type="text" name="captcha" placeholder=" Enter Code" class="form-control">
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/setu.foundation/public_html/core/resources/views/templates/basic/partials/custom-captcha.blade.php ENDPATH**/ ?>