@extends('layouts.guest')

@section('title', 'Offline')

@section('content')
    <style>
        .animate-bounce-slow {
            animation: bounce 2s infinite;
        }
    </style>
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">You're Offline</h1>
        <p class="text-lg text-gray-600 mb-6">It seems like you have lost your internet connection. Please check your connection and try again.</p>
        <div class="flex items-center justify-center">
            <div class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg flex items-center animate-bounce-slow">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 1.5A9 9 0 1112 3v0a9 9 0 016 15.5"></path>
                </svg>
                <span class="animate-bounce">No Internet Connection</span>
            </div>
        </div>
    </div>

@endsection