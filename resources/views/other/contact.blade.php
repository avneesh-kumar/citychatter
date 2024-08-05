@extends('layouts.guest')

@section('title', 'Contact Us')

@section('content')

    <section class="rounded-lg">
        <div class="mx-auto">
            <div class="flex justify-center w-full text-center p-6 space-y-8 sm:p-8 bg-white">
                <h2 class="text-2xl text-red-500 font-bold border-b-2 border-red-600">
                    Contact Us
                </h2>
            </div>
            <div class="mx-4 lg:mx-72 relative lg:flex">
                <div class="flex-1 w-1/2 p-2 py-8 lg:p-8 text-justified">
                    <div class="w-full text-left">
                        <h3 class="text-2xl font-bold text-red-500">Contact Information</h3>

                        <div class="mt-8 text-left">
                            @if($address)
                                <p class="text-lg font-semibold text-gray-900 ">Address</p>
                                <p class="text-gray-600 ">{{ $address }}</p>
                            @endif

                            @if($phone)
                                <p class="text-lg font-semibold text-gray-900  mt-4">Phone</p>
                                <p class="text-gray-600 ">{{ $phone }}</p>
                            @endif

                            @if($email)
                                <p class="text-lg font-semibold text-gray-900  mt-4">Email</p>
                                <p class="text-gray-600 ">
                                    <a href="mailto:{{ $email }}">
                                        {{ $email }}
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex-1 w-/1/2 p-2 py-8 lg:p-8">
                    @if (session('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('message') }}</span>
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="text-center p-1 mt-2">
                        <span class="text-red-600 text-sm font-semibold ">{{ $errors->first('error') }}</span>
                    </div>
                    @endif
                    <h3 class="text-2xl font-bold text-red-500">Send us a message</h3>
                    <form method="post" action="{{ route('contact.store') }}" class="mt-8 space-y-6 w-full">
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
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 ">Your message
                                <span class="text-red-500"> *</span>
                            </label>
                            <textarea name="message" id="message" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="Enter your message" required></textarea>
                            @if ($errors->has('message'))
                                <span class="text-red-600 text-sm">{{ $errors->first('message') }}</span>
                            @endif
                        </div>

                        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">

                        <div>
                            <button type="submit" class="bg-red-500 text-white rounded-lg px-4 py-2 hover:bg-red-600">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
                        