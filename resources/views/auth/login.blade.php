@extends('layout.auth-template')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="login-form-head">
            <h4>Sign In</h4>
            <p>Hello there, Sign in and start managing your Admin Dasboard</p>
        </div>
        <div class="login-form-body">
            <form action="">
                <div class="form-gp">
                    <input type="email" id="exampleInputEmail1" name=email placeholder="Email" value="{{ old('email') }}">
                    <i class="ti-email"></i>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-gp">
                    <input type="password" id="exampleInputPassword1" name="password" required placeholder="Password">
                    <i class="ti-lock"></i>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row mb-4 rmber-area">
                    <div class="col-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="remember" name="remeber">
                            <label class="custom-control-label" for="customControlAutosizing">Remember
                                Me</label>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                </div>
                <div class="submit-btn-area">
                    <button type="submit">Submit <i class="ti-arrow-right"></i></button>
                    <div class="login-other row mt-4">
                        <div class="col-6">
                            <a class="fb-login" href="{{ route('auth.facebook') }}">Log in with <i class="fa fa-facebook"></i></a>
                        </div>
                        <div class="col-6">
                            <a class="google-login" href="{{ route('redirectToGoogle') }}">Log in with <i class="fa fa-google"></i></a>
                        </div>
                    </div>
                </div>
                <div class="form-footer text-center mt-5">
                    <p class="text-muted">Don't have an account? <a href="{{ route('register') }}">Sign
                            up</a></p>
                </div>
            </form>
        </div>
    </form>
@endsection
