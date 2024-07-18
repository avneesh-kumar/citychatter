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
    <div class="flex">
        <div class="flex-1">
            @yield('content')
        </div>
    </div>
</body>
</html>