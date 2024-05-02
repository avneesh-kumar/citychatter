@extends('admin::layouts.guest')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="w-full m-4 md:w-1/4 md:m-0">
            <div class="bg-white shadow-xl rounded px-8 pt-6 pb-8 mb-4">
                <h1 class="text-center mb-4">
                    <a href="{{ route('admin.login') }}" class="text-2xl text-red-600 font-bold">
                        {{ config('app.name') }}
                    </a>
                </h1>
                @if($errors->has('invalid'))
                    <p class="text-red-500 text-sm italic mb-4 text-center">
                        {{ $errors->first('invalid') }}
                    </p>
                @endif

                <form action="{{ route('admin.login.post') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input
                            class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('email') ? 'border-red-500' : '' }}"
                            id="email"
                            name="email"
                            type="email"
                            placeholder="Enter your email"
                            value="{{ old('email') }}"
                            required
                        >
                        @if ($errors->has('email'))
                            <p class="text-red-500 text-sm italic mt-4">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input
                            class="shadow appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('password') ? 'border-red-500' : '' }}"
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Enter your password"
                            required
                        >
                        @if ($errors->has('password'))
                            <p class="text-red-500 text-sm italic mt-4">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>

                    <!-- create button for login -->
                    <div class="text-right">
                        <button
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit"
                        >
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection