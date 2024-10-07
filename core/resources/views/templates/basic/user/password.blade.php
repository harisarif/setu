@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-4">
            <div class="col-md-8 ">

                <div class="card shadow">

                    <div class="card-body">

                        <form action="" method="post" class="register">
                            @csrf
                            <div class="form-group">
                                <label for="password">@lang('Current password')</label>
                                <input id="password" type="password" class="form-control" name="current_password" required
                                       autocomplete="current-password">
                            </div>

                            <div class="form-group">
                                <label for="password">@lang('Password')</label>
                                <input id="password" type="password" class="form-control" name="password" required
                                       autocomplete="current-password">
                            </div>


                            <div class="form-group">
                                <label for="confirm_password">{{trans('Confirm password')}}</label>
                                <input id="password_confirmation" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="current-password">
                            </div>


                            <div class="form-group">
                                <input type="submit" class="mt-4 btn btn-success" value="{{trans('Change password')}}">
                            </div 
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


