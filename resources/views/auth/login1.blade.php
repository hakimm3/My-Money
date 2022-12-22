@extends('layout.auth-template')
@section('content')
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="login-form-head">
            <h4>reset Password</h4>
            <p>Hey! Reset Your Password and comeback again</p>
        </div>
        <div class="login-form-body">
            <div class="form-gp">
                <input type="email" id="exampleInputEmail1" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
                <i class="ti-email"></i>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-gp">
                <input type="password" id="exampleInputPassword1" name="password" required autocomplete="new-password" placeholder="Password">
                <i class="ti-lock"></i>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-gp">
                <input type="password" id="exampleInputPassword2" name="password_confirmation" required autocomplete="new-password" placeholder="Password Confirmation">
                <i class="ti-lock"></i>
                @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="submit-btn-area">
                <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                <div class="login-other row mt-4">
                    <div class="col-6">
                        <a class="fb-login" href="#">Sign up with <i class="fa fa-facebook"></i></a>
                    </div>
                    <div class="col-6">
                        <a class="google-login" href="#">Sign up with <i class="fa fa-google"></i></a>
                    </div>
                </div>
            </div>
            <div class="form-footer text-center mt-5">
                <p class="text-muted">Don't have an account? <a href="{{ route('login') }}">Sign in</a></p>
            </div>
        </div>
    </form>
@endsection
