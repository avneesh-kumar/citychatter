@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
    <section class="rounded-lg">
        <div class="mx-auto">
            <div class="flex  justify-center">
                <div class="w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white  dark:bg-gray-800">
                    <h2 class="text-2xl text-red-500 font-bold border-b-2 border-red-600">
                        Reset Password
                    </h2>
                    <form action="{{ route('reset-password.store') }}" method="post" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="reset_token" value="{{ $user->token }}">
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
            </div>
        </div>
    </section>
@endsection