@extends('layouts.app')

@section('content')

    <div class="w-full lg:w-1/2">
        <div>
            <h1 class="text-2xl font-semibold text-red-600 hover:underline">
                Reset Password
            </h1>
        </div>
        <form action="{{ route('account.reset-password.store') }}" method="post" class="space-y-4" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="old_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Old Password
                </label>
                <input type="password" name="old_password" id="old_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" autocomplete="off"  />
                @if ($errors->has('old_password'))
                    <span class="text-red-600 text-sm">{{ $errors->first('old_password') }}</span>
                @endif
            </div>
            <div>
                <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password
                </label>
                <input type="password" name="new_password" id="new_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" autocomplete="off"  />
                @if ($errors->has('new_password'))
                    <span class="text-red-600 text-sm">{{ $errors->first('new_password') }}</span>
                @endif
            </div>
            <div>
                <label for="new_password_confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password
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

@endsection