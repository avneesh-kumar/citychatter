@extends('layouts.app')

@section('content')

    <div class="w-full lg:w-1/2">
        <form action="{{ route('post.store') }}" method="post" class="space-y-4" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name
                </label>
                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required autocomplete="off" value="{{ old('name') ? old('name') : $user->name }}" />
                @if ($errors->has('name'))
                    <span class="text-red-600 text-sm">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                </label>
                <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required autocomplete="off" value="{{ old('email') ? old('email') : $user->email }}" />
                @if ($errors->has('email'))
                    <span class="text-red-600 text-sm">{{ $errors->first('email') }}</span>
                @endif
            </div>
        
        </form>
    </div>
    
@endsection