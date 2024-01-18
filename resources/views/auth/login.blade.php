@extends('layout.auth-template')
@section('content')
<div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
        Sign in to platform 
    </h2>
    <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="name@company.com" required>
            @error('email')
                <p class="text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
            <input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
            @error('password')
                <p class="text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
            </div>
            <div class="ml-3 text-sm">
            <label for="remember" class="font-medium text-gray-900 dark:text-white">Remember me</label>
            </div>
            <a href="{{ route('password.request') }}" class="ml-auto text-sm text-primary-700 hover:underline dark:text-primary-500">Lost Password?</a>
        </div>
        <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login to your account</button>
        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
            Not registered? <a href="{{ route('register') }}" class="text-primary-700 hover:underline dark:text-primary-500">Create account</a>
        </div>
    </form>
</div>
@endsection