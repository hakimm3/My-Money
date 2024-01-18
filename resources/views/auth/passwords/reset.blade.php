
@extends('layout.auth-template')
@section('content')
    {{-- <form method="POST" action="{{ route('password.update') }}">
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
            </div>
        </div>
    </form> --}}

    <div class="w-full max-w-xl p-6 space-y-8 bg-white rounded-lg shadow sm:p-8 dark:bg-gray-800">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            Reset your password
        </h2>
        <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                <input type="email" name="email" id="email" value="{{ $email ?? old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="name@company.com" required>
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                @error('password_confirmation')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Reset password</button>
        </form>
    </div>
@endsection
