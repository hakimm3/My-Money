

@extends('layout.auth-template')
@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="login-form-head">
            <h4>Reset Password</h4>
        </div>
        <div class="login-form-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="form-gp">
                <input type="email" id="exampleInputEmail1" name="email" value="{{ old('email') }}" required
                    autocomplete="email" placeholder="Email">
                <i class="ti-email"></i>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="submit-btn-area">
                <button id="form_submit" type="submit">Send Password Link <i class="ti-arrow-right"></i></button>
                <div class="login-other row mt-4">
                    <div class="col-6">
                        <a class="fb-login" href="#">Sign up</a>
                    </div>
                    <div class="col-6">
                        <a class="google-login" href="#">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
