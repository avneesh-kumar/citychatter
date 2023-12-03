<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"  rel="stylesheet" />
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div>
            @include('layouts.nav')
            <div class=" p-2 ">
                <div class="p-4">
                    <div class="p-4 rounded-lg dark:border-gray-700 mt-14">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    </body>
</html>
