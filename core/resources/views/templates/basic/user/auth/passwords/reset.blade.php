@extends($activeTemplate.'layouts.frontend')


@section('content')
<div class="container">

    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.password.update') }}">
                        @csrf

                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>


                            <a href="{{ route('user.login') }}" >@lang('Login Here')</a>
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
        .card-header {
            background: mediumseagreen;
            color: aliceblue;
        }

        .btn-primary{
            background: mediumseagreen;
            color: aliceblue;
            border: none;
        }

        .btn-primary:hover{
            background: mediumseagreen;
            color: aliceblue;
            border: none;
        }
    </style>
@endpush