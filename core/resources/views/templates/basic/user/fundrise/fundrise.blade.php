@extends($activeTemplate.'layouts.master')


@section('content')

    <section class="pt-90 pb-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 p-5 shadow">

                    <h2 class="text-center mb-5">@lang('Create Your Campaign')</h2>
                    <div class="login-area mt-3">
                        <form action="" class="action-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">


                                <div class="col">
                                    <div class="form-group create_fundrise">
                                        <label>@lang('Select Category')</label>
                                        <div class="input-group mb-2">

                                            <div class="input-group-append">
                                                <label class="input-group-text" for="inputGroupSelect02"><i
                                                        class="fas fa-align-justify"></i></label>
                                            </div>

                                            <select name="category_id" id="create_fundrise" required>
                                                <option value="">@lang('Select Category')</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div><!-- form-group end -->
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>@lang('Campaign Goal')</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{ $general->cur_sym }}</div>
                                            </div>
                                            <input type="number" name="goal" required placeholder="@lang('Your goal')"
                                                value="{{ old('goal') }}" class="form-control">
                                        </div>
                                    </div><!-- form-group end -->
                                </div>

                            </div>



                            <div class="form-group mt-3">
                                <label>@lang('Title')</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-heading"></i></div>
                                    </div>
                                    <input type="text" name="title" required placeholder="@lang('Title')" value="{{ old('title') }}"
                                        class="form-control">
                                </div>

                            </div><!-- form-group end -->

                            <div class="row mt-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label>@lang('Deadline')</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                            <input type="date" name="deadline" required placeholder="@lang('Date')"
                                                value="{{ old('Date') }}" class="form-control">
                                        </div>
                                    </div><!-- form-group end -->
                                </div>

                            </div>

                            <div class="form-group">
                                <label>@lang('Description')</label>

                                <textarea name="description" id="" cols="30" rows="10" required class="form-control mb-2"
                                    placeholder="@lang('Write your Description for Fundrise')">{{ old('details') }}</textarea>

                            </div><!-- form-group end -->




                            <div class="row mt-3">

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>@lang('Image')</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-images"></i></div>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input"
                                                    id="validatedCustomFile" required>
                                                <label class="custom-file-label" for="validatedCustomFile">@lang('Choose
                                                    file')...</label>
                                            </div>
                                        </div>
                                    </div><!-- form-group end -->
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>@lang('Relevent Images and Documents (pdf)')</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-images"></i></div>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="attachments[]" class="custom-file-input"
                                                    id="inputAttachments" required>
                                                <label class="custom-file-label" for="validatedCustomFile">@lang('Choose
                                                    file')...</label>
                                            </div>

                                        </div>
                                        <div id="fileUploadsContainer"></div>
                                    </div><!-- form-group end -->
                                </div>

                                <div class="col-md-1 mt-3">
                                    <a href="javascript:void(0)" class="btn btn-danger btn-round"
                                        onclick="extraTicketAttachment()">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <input type="submit" value="@lang('Create Fundrise')" class="form-control custom-button">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('style')

    <style>
        #create_fundrise{
            width: 86% !important;
        }
        .nice-select {
            width: 85%;
        }

        .custom-check {
            width: 20px;
        }

        .margin--top {
            margin-top: 1.9rem !important;
        }

        a.btn.btn-danger.btn-round {
            margin-top: 21px;
        }

        .custom-button {
            background: #109452;
            color: #ffffff;
            font-weight: 600;
        }

    </style>

@endpush


@push('script')
    <script>
        'use strict';
        
        $('input[type=checkbox]').val(0);
        $(document).on("change", '.custom-file-input', function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        function extraTicketAttachment() {
            $("#fileUploadsContainer").append(`
                <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-images"></i></div>
                              </div>
                              <div class="custom-file">
                                <input type="file" name="attachments[]" class="custom-file-input" id="inputAttachments-1" required>
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                              </div>
                              

                            </div>
                `);


        }

        $('input[type=checkbox]').on('change', function() {
            if ($(this).val() == 1) {
                $(this).val(0);
            } else {
                $(this).val(1);
            }

        })

         $(document).on('click', '.removeBtn', function () {
            $(this).closest('.user-data').remove();
        });

    </script>


@endpush
