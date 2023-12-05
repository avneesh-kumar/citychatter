@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ url()->previous() }}" class="text-red-600 hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </div>
    <div class="h-auto mb-4">
        <div class="p-6">
            <div class="">
                <div class="flex items-center justify-center">
                    <div class="w-56 h-56">
                        <img src="https://pixinvent.com/materialize-material-design-admin-template/app-assets/images/user/12.jpg" alt="" class="shadow-xl rounded-full">
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <div class="text-center">
                        <h1 class="text-lg font-bold text-red-500 dark:text-gray-100 mt-4">
                            @avneesh
                        </h1>
                        <p class="text-gray-700 dark:text-gray-300">
                            avneesh@roilift.com
                        </p>
                    </div>
                </div>
            </div>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <h1 class="text-2xl text-center">
                Your Feeds
            </h1>
            <div class="md:flex mt-16 justify-center">
                <div class="w-2/3 " style="margin: auto;">
                    <div class="grid grid-cols-1 gap-28 mb-4">
                        @foreach($feeds as $feed)
                        <div class="h-auto mb-4 shadow-lg">
                            <div class="items-center justify-center h-56 bg-gray-50">
                                <img class="object-cover w-full h-full" src="{{ asset($feed['image'] )}}" alt="{{ $feed['title'] }}" />
                            </div>
                            <div class="p-2">
                                <div class="mt-2">
                                    <a href="{{ route('post', $feed['slug']) }}">
                                    <h1 class="text-xl font-bold text-red-500 hover:underline">
                                            {{ $feed["title"] }}
                                    </h1>
                                    </a>
                                    <p class="text-gray-700 dark:text-gray-300">
                                    {{ implode(' ', array_slice(explode(' ', $feed['description']), 0, 20)) }}...
                                    </p>
                                </div>
                                <!-- <div class="my-4">
                                    <div class="grid grid-cols-3 gap-4">
                                    <div class="text-left">
                                        <span class="text-blue-400 cursor-pointer">
                                            Like
                                        </span>
                                    </div>
                                    <div class="text-center">
                                        <span class="text-blue-400 cursor-pointer">
                                            Comment
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-blue-400 cursor-pointer">
                                            Share
                                        </span>
                                    </div>
                                    </div>
                                </div> -->
                                <div class="my-4">
                                    <div class="grid grid-cols-2">
                                    <div class="text-left">
                                        <span class="text-gray-400 ">
                                            {{ $feed['location'] }}
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-gray-400 ">
                                            {{ date('d M Y h:m:i', strtotime($feed['created_at']))  }}
                                        </span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-1/3 border- text-center">
                    Other Information
                </div>
            </div>
        </div>
    </div>

@endsection