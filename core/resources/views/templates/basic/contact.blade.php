@extends($activeTemplate.'layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8 shadow p-5">
            <h3 class="text-center pb-4">{{__($page_title)}}</h3>
            <form method="post" action="">
                @csrf

                <div class="form-group">
                    <input name="name" type="text" placeholder="@lang('Your Name')" class="form-control"
                           value="{{old('name')}}" required>
                </div>
                <div class="form-group">
                    <input name="email" type="text" placeholder="@lang('Enter E-Mail Address')" class="form-control"
                           value="{{old('email')}}" required>
                </div>

                <div class="form-group">
                    <input name="subject" type="text" placeholder="@lang('Write your subject')" class="form-control"
                           value="{{old('subject')}}" required>
                </div>


                <div class="form-group">
                    <textarea name="message" wrap="off" placeholder="@lang('Write your message')"
                              class="form-control">{{old('message')}}</textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">@lang('Create Ticket')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
