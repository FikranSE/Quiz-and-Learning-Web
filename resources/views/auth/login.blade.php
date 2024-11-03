@extends('layouts.app')

@section('content')
    
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .login-header {
            background-color: #388da8;
            color: white;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .form-input {
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-input:focus {
            border-color: #388da8;
            box-shadow: #388ea865;
        }
        .forgot-password-link{
          color:#388da8;
        }
        .forgot-password-link:hover{
          color:#245a6a;
        }
        .btn-primary {
            background-color: #388da8;
            transition: background-color 0.15s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #296679;
        }
    </style>
<div class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto login-container">
            <div class="login-header p-4">
                <h2 class="text-xl font-bold text-center">Login</h2>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                        <input id="email" type="email" class="form-input w-full px-3 py-2 border rounded-md" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input id="password" type="password" class="form-input w-full px-3 py-2 border rounded-md" name="password" required autocomplete="current-password">
                        @error('password')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-600">Remember Me</span>
                        </label>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="btn-primary text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Login
                        </button>
                        @if (Route::has('password.request'))
                            <a class="forgot-password-link inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('password.request') }}">
                                Forgot Password?
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div> 
@endsection
