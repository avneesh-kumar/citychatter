<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
            @if(isset($title))
                {{ $title }} | {{ config('app.name') }}
            @else
                {{ config('app.name') }}
            @endif
        </title>
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    </head>
    <body>
        <style>
            ::-moz-selection {
                color: white;
                background: #f05252;
            }

            ::selection {
                color: white;
                background: #f05252;
            }
        </style>
        <div class="h-16 bg-white w-full shadow-lg">
            <div class="mx-6 h-full flex items-center">
                <div class="flex-1 text-left">
                    <a href="{{ route('admin.category') }}" class="text-red-600 text-2xl font-bold">{{ config('app.name') }}</a>
                </div>
                <div class="flex-1 text-right">
                    <a href="{{ url(env('APP_URL')) }}" target="_blank" class="text-red-600 text-xl font-bold">Website</a>
                </div>
            </div>
        </div>
        <div class="flex">
            <div class="flex-3">
                @include('admin::layouts.nav')
            </div>
            <div class="flex-1">
                <div class="m-4 p-4">
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
    </body>
</html>