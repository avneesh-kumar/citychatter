@extends('admin::layouts.app')

@section('content')
    <div class="flex">
        <div class="flex-1">
            <h1 class="text-gray-700 text-lg font-semibold pb-2 border-b border-gray-700">
                {{ $title }}
            </h1>
        </div>
        <div class="flex-1 items-end text-right">
            <a href="{{ $backUrl }}" class="float-right hover:bg-red-700 bg-red-600 text-white font-bold py-2 px-4  rounded text-xs">
                Back
            </a>
        </div>
    </div>

    <div class="flex">
        <div class="flex-auto mt-8">
            <form action="{{ route('admin.account.store') }}" method="post">
                @csrf
                <div class="mb-4 w-1/2">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                        Name
                    </label>
                    <input type="text" name="name" id="name" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" value="{{ auth()->guard('admin')->user()->name ? auth()->guard('admin')->user()->name : old('name') }}" />
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                        Email
                    </label>
                    <input type="email" name="email" id="email" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" value="{{ auth()->guard('admin')->user()->email ? auth()->guard('admin')->user()->email : old('email') }}" readonly />
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                        Password
                    </label>
                    <input type="password" name="password" id="password" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" />
                    @error('password')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">
                        Confirm Password
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" />
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-xs">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
    
@endsection