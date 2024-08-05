@extends('layouts.guest')

@section('title', 'Lost Password')

@section('content')

    <section class="rounded-lg">
        <div class="mx-auto">
            <div class="flex justify-center items-center">
                <div class="w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="text-center p-1 mt-2">
                            <span class="text-red-600 text-sm font-semibold ">{{ $errors->first('error') }}</span>
                        </div>
                    @endif
                    <h2 class="text-2xl text-red-500 font-bold border-b-2 border-red-600">
                        Lost Password
                    </h2>
                    <form method="post" action="{{ route('lost-password.email') }}" class="mt-8 space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email
                                <span class="text-red-500"> *</span>
                            </label>
                            <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="Enter your email" required>
                            @if ($errors->has('email'))
                                <span class="text-red-600 text-sm">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center bg-red-500 hover:bg-red-600 text-white font-semibold p-3 rounded-lg tracking-wide shadow-lg cursor-pointer transition ease-in duration-500">
                                Send Password Reset Link
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection