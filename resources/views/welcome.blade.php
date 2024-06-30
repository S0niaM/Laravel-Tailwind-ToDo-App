@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-purple-400 via-pink-500 to-red-500">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-200 p-4 text-center text-xl font-bold">
                {{ __('Welcome') }}
            </div>

            <div class="p-6">
                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <p class="text-center mb-6">{{ __('Welcome to our application! Please log in or register to continue.') }}</p>

                <div class="flex justify-between">
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Login') }}
                    </a>
                    <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Register') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
