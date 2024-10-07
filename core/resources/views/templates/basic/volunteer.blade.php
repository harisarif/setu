@extends($activeTemplate.'layouts.frontend')

@section('content')

    <!-- login section start -->
    <section class="pt-90 pb-90">
        <div class="container">
            <div class="row justify-content-center margin--top-adjustment">

                <div class="col-lg-10 shadow p-5">
                    <div class="login-area">
                        <form class="action-form" action="{{ route('volunteer') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center ">
                                <div class="form-group col-md-7 mb-5 text-center ">
                                    <label class="">@lang('Upload Your Image')</label>
                                    <div class="image-prev">
                                        <img src="{{ getImage('/', '200x200') }}" alt="" id="prev" class="w-100 h-100">
                                    </div>
                                    <input class="custom-file-input" type="file" name="image" required />
                                    <button type="button" class="btn btn-danger remove">@lang('Remove')</button>

                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label>@lang('Firstname')</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="las la-user"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="@lang('First Name')"
                                            name="firstname" required value={{ old('firstname') }}>
                                    </div>
                                </div><!-- form-group end -->
                                <div class="form-group col-md-6 mb-2">
                                    <label>@lang('lastname')</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="las la-user"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="@lang('Last Name')"
                                            name="lastname" required value={{ old('lastname') }}>
                                    </div>
                                </div><!-- form-group end -->
                                <div class="form-group col-md-6 mb-2">
                                    <label>@lang('Email')</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="las la-at"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="@lang('Email')" name="email"
                                            required value={{ old('email') }}>
                                    </div>
                                </div><!-- form-group end -->
                                <div class="form-group col-md-6 mb-2">
                                    <label class="" for="country">{{ __('Country') }}</label>
                                    <select name="country" id="country" class="form-control w-100">
                                        @foreach ($countries as $key => $country)
                                            <option data-mobile_code="{{ $country->dial_code }}"
                                                value="{{ $country->country }}" data-code="{{ $key }}">
                                                {{ __($country->country) }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="">@lang('Phone')</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mobile-code">

                                            </span>
                                            <input type="hidden" name="mobile_code">
                                            <input type="hidden" name="country_code">
                                        </div>
                                        <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}"
                                            class="form-control" placeholder="@lang('Your Phone Number')">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label>@lang('State')</label>
                                    <input type="text" name="state" placeholder="@lang('State')" class="form-control">
                                </div><!-- form-group end -->
                                <div class="form-group col-md-6 mb-2">
                                    <label>@lang('Zip')</label>
                                    <input type="text" name="zip" placeholder="@lang('Zip')" class="form-control">
                                </div><!-- form-group end -->
                                <div class="form-group col-md-6 mb-2">
                                    <label>@lang('City')</label>
                                    <input type="text" name="city" placeholder="@lang('city')" class="form-control">
                                </div><!-- form-group end -->
                                <div class="form-group col-md-12 mb-5">
                                    <label>@lang('address')</label>
                                    <input type="text" name="address" placeholder="@lang('address')" class="form-control">
                                </div><!-- form-group end -->

                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-success cmn-btn w-100">
                            </div>

                    </div>

                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- login section end -->


@endsection


@push('style')
    <style>
        .action-form .form-group+.form-group {
            margin-top: 0px;
        }

        .image-prev {
            height: 200px;
            width: 200px;
            border-radius: 50%;
            overflow: hidden;
            border: 1px solid #b9b9b9;
            margin: 0 auto;
            margin-top: -150px;
            margin-bottom: 20px;
        }
        .margin--top-adjustment{
            margin-top: 100px;
        }

        .custom-file-input {
            color: transparent;
            width: 100px;
            opacity: 1 !important;
            height: auto;

        }

        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
        }

        .custom-file-input::before {
            content: 'Upload File';
            display: inline-block;
            background: #198754 !important;
            border: 1px solid #999;
            border-radius: 3px;
            padding: 9px 8px;
            outline: none;
            white-space: nowrap;
            -webkit-user-select: none;
            cursor: pointer;
            text-shadow: 1px 1px #fff;
            font-weight: 700;
            font-size: 10pt;

        }


        .custom-file-input:active {
            outline: 0;
        }

        .custom-file-input:active::before {
            background: #198754;
        }

    </style>
@endpush

@push('script')
    <script>
        $(function() {
            "use strict";
            @if ($mobile_code)
                $(`option[data-code={{ $mobile_code }}]`).attr('selected','');
            @endif
            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            }).change();

            function showImagePreview(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#prev').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function removeImage() {
                var _empty = '';
                $('#prev').attr('src', "{{ route('placeholderImage', '200x200') }}");
                $('.custom-file-input').val(_empty);
            }

            $(".custom-file-input").change(function() {
                showImagePreview(this);
            });

            $('.remove').on('click', function() {
                removeImage();
            })
        })

    </script>
@endpush
