@if(\App\Extension::where('act', 'custom-captcha')->where('status', 1)->first())
    <div class="form-group row">
        <div class="col-md-6 mb-2">
            @php echo  getCustomCaptcha(46,100,'#13c366','','#ffffff',32) @endphp
        </div>
        <div class="col-md-6">
            <input type="text" name="captcha" placeholder=" Enter Code" class="form-control">
        </div>
    </div>
@endif
