@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<style>
        @media (max-width: 767px) {
            .form-container {
                width: 100%; /* Full width on mobile */
            }
        }
    </style>
    <div class="relative lg:flex">
        <div class="w-full lg:w-3/4">
            <div class="form-container w-full p-2 lg:p-8">
                <div>
                    <h1 class="text-2xl font-semibold text-red-600 hover:underline">
                        Reset Password
                    </h1>
                </div>
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <form action="{{ route('account.reset-password.store') }}" method="post" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="old_password" class="block mb-2 text-sm font-medium text-gray-900 ">Old Password
                        </label>
                        <input type="password" name="old_password" id="old_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" autocomplete="off"  />
                        @if ($errors->has('old_password'))
                            <span class="text-red-600 text-sm">{{ $errors->first('old_password') }}</span>
                        @endif
                    </div>
                    <div>
                        <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 ">New Password
                        </label>
                        <input type="password" name="new_password" id="new_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" autocomplete="off"  />
                        @if ($errors->has('new_password'))
                            <span class="text-red-600 text-sm">{{ $errors->first('new_password') }}</span>
                        @endif
                    </div>
                    <div>
                        <label for="new_password_confirm" class="block mb-2 text-sm font-medium text-gray-900 ">Confirm New Password
                        </label>
                        <input type="password" name="new_password_confirm" id="new_password_confirm" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" autocomplete="off"  />
                        @if ($errors->has('new_password_confirm'))
                            <span class="text-red-600 text-sm">{{ $errors->first('new_password_confirm') }}</span>
                        @endif
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 text-sm text-left text-white bg-red-700 hover:bg-red-800 rounded-lg focus:ring-red-500 focus:border-red-500 font-medium">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-1/3">

        </div>
    </div>

@endsection