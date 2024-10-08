@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="container ">
        <div class="row justify-content-center my-4 ">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg--crowd">{{ __($page_title) }}

                        <a href="{{route('ticket') }}" class="btn btn-sm btn-success float-right btn--crowd">
                            @lang('My Support Ticket')
                        </a>
                    </div>

                    <div class="card-body">

                        <form  action="{{route('ticket.store')}}"  method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
                            @csrf
                            <div class="row ">
                                <div class="form-group col-md-6">
                                    <label for="name">@lang('Name')</label>
                                    <input type="text"  name="name" value="{{@$user->firstname . ' '.@$user->lastname}}" class="form-control form-control-lg" placeholder="@lang('Enter Name')" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">@lang('Email address')</label>
                                    <input type="email"  name="email" value="{{@$user->email}}" class="form-control form-control-lg" placeholder="@lang('Enter your Email')" required>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="website">@lang('Subject')</label>
                                    <input type="text" name="subject" value="{{old('subject')}}" class="form-control form-control-lg" placeholder="@lang('Subject')" >
                                </div>

                                <div class="col-12 form-group">
                                    <label for="inputMessage">@lang('Message')</label>
                                    <textarea name="message" id="inputMessage" rows="6" class="form-control form-control-lg">{{old('message')}}</textarea>
                                </div>
                            </div>

                            <div class="row form-group ">
                                <div class="col-sm-9 file-upload">
                                    <label for="inputAttachments">@lang('Attachments')</label>
                                    <input type="file" name="attachments[]" id="inputAttachments" class="form-control mb-2" />
                                    <div id="fileUploadsContainer"></div>
                                    <p class="ticket-attachments-message text-muted">
                                        @lang("Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx")
                                    </p>
                                </div>

                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-success btn-sm btn--red" onclick="extraTicketAttachment()">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row form-group justify-content-center">
                                <div class="col-md-12">
                                    <button class="btn btn-success" type="submit" id="recaptcha" ><i class="fa fa-paper-plane"></i>&nbsp;@lang('Submit')</button>
                                    <button class=" btn btn-danger" type="button" onclick="formReset()">&nbsp;@lang('Cancel')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
        <style>
            .bg--crowd{
                background: #16C26B;
                color: #ffffff;
            }

            .btn--crowd{
                background: #ffffff;
                color: #16C26B;
                border: none;
            }

            .btn--crowd:hover{
                background: #ffffff;
                color: #16C26B;
                border: none;
            }

            .btn--red{
                background: #DD3448;
                border: none;

            }

            .btn--red:hover{
                background: #DD3448;
                border: none;

            }

            .btn--red:focus{
                background: #DD3448;
                border: none;
                box-shadow: none;

            }

            .col-sm-1 {
                margin: auto 0;
            }
        </style>
@endpush

@push('script')
    <script>
        'use strict';
        
        function extraTicketAttachment() {
            $("#fileUploadsContainer").append('<input type="file" name="attachments[]" class="form-control my-3" required />')
        }
        function formReset() {
            window.location.href = "{{url()->current()}}"
        }
    </script>
@endpush
