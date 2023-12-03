@extends('layouts.guest')

@section('content')

    <section class="rounded-lg">
        <div class="mx-auto">
            <div class="flex  justify-center">
                <div class="w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white  dark:bg-gray-800">
                    <h2 class="text-2xl text-red-500 font-bold border-b-2 border-red-600">
                        Register
                    </h2>
                    <form method="post" action="{{ route('register.store') }}" class="mt-8 space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name
                                <span class="text-red-500"> *</span>
                            </label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Enter your name" required>
                            @if ($errors->has('name'))
                                <span class="text-red-600 text-sm">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email
                                <span class="text-red-500"> *</span>
                            </label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Enter your email id" required>
                            @if ($errors->has('email'))
                                <span class="text-red-600 text-sm">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password
                                <span class="text-red-500"> *</span>
                            </label>
                            <input type="password" name="password" id="password" placeholder="Enter password for your account" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" required>
                            @if ($errors->has('password'))
                                <span class="text-red-600 text-sm">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password
                                <span class="text-red-500"> *</span>
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password for your account" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" required>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-red-600 text-sm">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <label for="agreement" class="">
                                    <input id="agreement" aria-describedby="agreement" name="agreement" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-red-300 dark:focus:ring-red-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required>
                                    I agree to the <a href="#" class="text-red-600 hover:underline dark:text-red-500">privacy policy</a>
                                </label>
                            </div>
                        </div>
                        <div class="flex items-end">
                            <p>If you have account, <a href="{{ route('login') }}" class="text-red-600">login</a> here </p>
                        </div>
                        <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 sm:w-auto dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection