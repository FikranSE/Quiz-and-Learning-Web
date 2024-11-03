@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Arial', sans-serif;
        }
        .register-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .register-header {
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
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
        .btn-primary {
            background-color: #388da8;
            transition: background-color 0.15s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #276476;
        }
    </style>
<div class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto register-container">
            <div class="register-header p-4">
                <h2 class="text-xl font-bold text-center">Register</h2>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <input id="name" type="text" class="form-input w-full px-3 py-2 border rounded-md" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                        <input id="email" type="email" class="form-input w-full px-3 py-2 border rounded-md" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input id="password" type="password" class="form-input w-full px-3 py-2 border rounded-md" name="password" required autocomplete="new-password">
                        @error('password')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-input w-full px-3 py-2 border rounded-md" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="submit" class="btn-primary text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection
