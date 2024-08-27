@extends('layouts.guest')

@section('title', 'Sign Up')

@section('content')

    <section class="rounded-lg">
        <div class="mx-auto">
            <div class="flex  justify-center">
                <div class="w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Success:</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="text-center p-1 mt-2">
                            <span class="text-red-600 text-sm font-semibold ">{{ $errors->first('error') }}</span>
                        </div>
                    @endif
                    <h2 class="text-2xl text-red-500 font-bold border-b-2 border-red-600">
                        Register
                    </h2>
                    <form method="post" id="recaptcha-form" action="{{ route('register.store') }}" class="mt-8 space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Your Name
                                <span class="text-red-500"> *</span>
                            </label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="Enter your name" required>
                            @if ($errors->has('name'))
                                <span class="text-red-600 text-sm">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Your email
                                <span class="text-red-500"> *</span>
                            </label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="Enter your email id" required>
                            @if ($errors->has('email'))
                                <span class="text-red-600 text-sm">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Your password
                                <span class="text-red-500"> *</span>
                            </label>
                            <input type="password" name="password" id="password" placeholder="Enter password for your account" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required>
                            @if ($errors->has('password'))
                                <span class="text-red-600 text-sm">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 ">Confirm password
                                <span class="text-red-500"> *</span>
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password for your account" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 " required>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-red-600 text-sm">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>

                        <x-recaptcha />
                        
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <label for="agreement" class="">
                                    <input id="agreement" aria-describedby="agreement" name="agreement" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-red-300 " required>
                                    I agree to the <span data-modal-target="privacy-policy-modal" data-modal-toggle="privacy-policy-modal" class="text-red-600 hover:underline  cursor-pointer">privacy policy</span>
                                </label>
                            </div>
                        </div>
                        <div class="flex items-end">
                            <p>If you have account, <a href="{{ route('login') }}" class="text-red-600">login</a> here </p>
                        </div>
                        <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-600 focus:ring-4 focus:ring-red-300 sm:w-auto ">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div id="privacy-policy-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow ">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                    <h3 class="text-xl font-semibold text-gray-900 ">
                        Privacy Policy
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="privacy-policy-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-gray-900 ">
                        {!! $privacyPolicy !!}
                    </p>
                </div>
            </div>
        </div>
    </div>


@endsection