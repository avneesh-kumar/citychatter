<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
        <title>@yield('title', env('APP_NAME'))</title>
        <meta name="description" content="@yield('description', env('APP_NAME'))">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"  rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&libraries=places" ></script>

        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <link rel="apple-touch-icon" href="favicon.png">
        
    </head>
    <body class="font-sans antialiased">
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
        <div class="">
            @include('layouts.nav')
            @include('layouts.sidebar')
            <div class="p-2 mt-8 lg:mt-0 ">
                <div class="lg:p-4 sm:ml-64 min-h-screen ">
                    <div class="p-4 rounded-lg mt-6 min-h-full" >
                        @yield('content')
                    </div>
                    @include('layouts.footer')
                </div>
            </div>
        </div>
        <div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    </body>
</html>
