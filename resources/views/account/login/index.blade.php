@extends('layouts.guest')

@section('content')

    <section class="rounded-lg">
        <div class="mx-auto">
            <div class="flex  justify-center">
                <div class="w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white  dark:bg-gray-800">
                    <h2 class="text-2xl text-red-500 font-bold border-b-2 border-red-600">
                        Sign in
                    </h2>
                    @if ($errors->has('invalid'))
                        <div class="text-center p-1 mt-2">
                            <span class="text-red-600 text-sm font-semibold ">{{ $errors->first('invalid') }}</span>
                        </div>
                    @endif
                    <form class="mt-8 space-y-6" action="{{ route('login.authenticate') }}" method="post">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="name@company.com" required>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" required>
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-red-300 dark:focus:ring-red-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                            <div class="ms-3 text-sm">
                                <label for="remember" class="font-medium text-gray-500 dark:text-gray-400">Remember this device</label>
                            </div>
                            <a href="{{ route('lost-password') }}" class="ms-auto text-sm font-medium text-red-600 hover:underline dark:text-red-500">Lost Password?</a>
                        </div>

                        <div class="flex items-start">
                            <p>Don't have account, <a href="{{ route('register') }}" class="text-red-600">signup</a> here </p>
                        </div>
                        <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 sm:w-auto dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Login to your account</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection