@extends('admin::layouts.app')

<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
@section('content')
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
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
            <form action="{{ route('admin.configuration.store') }}" method="post">
                @csrf
                <div class="mb-4 w-1/2">
                    <label for="postperpage" class="block text-gray-700 text-sm font-bold mb-2">
                        Posts Per Page
                    </label>
                    <input type="number" name="postperpage" id="postperpage" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" value="@if(isset($configData['postperpage'])){{$configData['postperpage']}}@endif" >
                    @error('postperpage')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="address" class="block text-gray-700 text-sm font-bold mb-2">
                        Contact Address
                    </label>
                    <input type="text" name="address" id="address" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" value="@if(isset($configData['address'])){{$configData['address']}}@endif" >
                    @error('address')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4 w-1/2">
                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">
                        Phone
                    </label>
                    <input type="text" name="phone" id="phone" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" value="@if(isset($configData['phone'])){{$configData['phone']}}@endif" >
                    @error('phone')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4 w-1/2">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                        Email
                    </label>
                    <input type="email" name="email" id="email" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" value="@if(isset($configData['email'])){{$configData['email']}}@endif" >
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4 w-1/2">
                    <label for="aboutus" class="block text-gray-700 text-sm font-bold mb-2">
                        About us
                    </label>
                    <textarea name="aboutus" id="aboutus" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg h-96" style="min-height: 150px;" >@if(isset($configData['aboutus'])){{$configData['aboutus']}}@endif</textarea>
                    @error('aboutus')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="terms" class="block text-gray-700 text-sm font-bold mb-2">
                        Terms
                    </label>
                    <textarea name="terms" id="terms" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg h-96" style="min-height: 150px;" >@if(isset($configData['terms'])){{$configData['terms']}}@endif</textarea>
                    @error('terms')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="mission" class="block text-gray-700 text-sm font-bold mb-2">
                        Mission
                    </label>
                    <textarea name="mission" id="mission" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg h-96" style="min-height: 150px;" >@if(isset($configData['terms'])){{$configData['terms']}}@endif</textarea>
                    @error('mission')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                        Privacy Policy
                    </label>
                    <textarea name="privacypolicy" id="privacypolicy" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg h-96" style="min-height: 150px;" >@if(isset($configData['privacypolicy'])){{$configData['privacypolicy']}}@endif</textarea>
                    @error('privacypolicy')
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

    <script>
        ClassicEditor.create( document.querySelector( '#aboutus' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor.create( document.querySelector( '#terms' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor.create( document.querySelector( '#mission' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor.create( document.querySelector( '#privacypolicy' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
@endsection