@extends('layouts.app')

@section('content')
    <style>
        @keyframes bounce {
            0%, 100% {
                transform: translateY(-25%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }
            50% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }
        .bounce {
            animation: bounce 1s infinite;
        }
    </style>
    <div class="flex flex-col items-center justify-center h-screen ">
        <div class="text-center space-y-8">
            <h1 class="text-9xl font-bold bounce text-red-500">404</h1>
            <p class="text-2xl md:text-3xl font-light text-red-500">Sorry, the page you are looking for cannot be found.</p>
            <a href="/" class="inline-block px-6 py-2 bg-red-600 text-white rounded-md text-lg hover:bg-red-700 transition-all duration-300 transform hover:scale-110 hover:shadow-lg">Go To Posts</a>
        </div>
    </div>

@endsection
