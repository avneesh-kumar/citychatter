@extends('layouts.app')

@section('title', 'Profile')

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
                        <a href="{{ route('user.profile', $user->profile->username ) }}" target="_blank">Profile
                        </a>
                    </h1>
                </div>
                <form action="{{ route('profile.store') }}" method="post" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name
                        </label>
                        <input type="text" readonly name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" autocomplete="off" value="{{ old('name') ? old('name') : $user->name }}" />
                        @if ($errors->has('name'))
                            <span class="text-red-600 text-sm">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email
                        </label>
                        <input type="email" readonly name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" autocomplete="off" value="{{ old('email') ? old('email') : $user->email }}" />
                        @if ($errors->has('email'))
                            <span class="text-red-600 text-sm">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div>
                        <label for="optional_email" class="block mb-2 text-sm font-medium text-gray-900 ">Business Email <span class="text-gray-400 text-sm">(optional)</span>
                        </label>
                        <input type="email" name="optional_email" id="optional_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" autocomplete="off" value="{{ old('optional_email') ? old('optional_email') : $user->profile->optional_email }}" />
                        @if ($errors->has('optional_email'))
                            <span class="text-red-600 text-sm">{{ $errors->first('optional_email') }}</span>
                        @endif
                    </div>

                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username/Business Name 
                        </label>
                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"  autocomplete="off" value="{{ old('username') ? old('username') : $user->profile->username }}" required />
                        <div id="username-check">

                        </div>
                        @if ($errors->has('username'))
                            <span class="text-red-600 text-sm">{{ $errors->first('username') }}</span>
                        @endif
                    </div>

                    <div>
                        <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 ">Bio
                        </label>
                        <textarea type="text" name="bio" id="bio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" autocomplete="off" >{{ old('bio') ? old('bio') : $user->profile->bio }}</textarea>
                        @if ($errors->has('bio'))
                            <span class="text-red-600 text-sm">{{ $errors->first('bio') }}</span>
                        @endif
                        <div id="bio-length"></div>
                    </div>

                    <div>
                        <label for="avatar" class="block mb-2 text-sm font-medium text-gray-900 ">Avatar
                        </label>
                        <input type="file" name="avatar" id="avatar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" >
                        @if ($user->profile->avatar)
                            <img src="{{ asset($user->profile->avatar) }}" alt="{{ $user->name }}" class="mt-2 w-20 h-20 rounded-full object-cover">
                        @endif
                        @if ($errors->has('avatar'))
                            <span class="text-red-600 text-sm">{{ $errors->first('avatar') }}</span>
                        @endif
                    </div>

                    <div>
                        <label for="cover" class="block mb-2 text-sm font-medium text-gray-900 ">Cover
                        </label>
                        <input type="file" name="cover" id="cover" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" >
                        @if ($user->profile->cover)
                            <img src="{{ asset($user->profile->cover) }}" alt="{{ $user->name }}" class="mt-2 w-20 h-20 object-cover">
                        @endif
                        @if ($errors->has('cover'))
                            <span class="text-red-600 text-sm">{{ $errors->first('cover') }}</span>
                        @endif
                    </div>

                    <div>
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 ">Location
                        </label>
                        <input type="text" name="location" id="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"  autocomplete="off" value="{{ old('location') ? old('location') : $user->profile->location }}" />
                        <input type="hidden" name="latitude" value="{{ $user->profile->latitude }}" />
                        <input type="hidden" name="longitude" value="{{ $user->profile->longitude }}" />
                        @if ($errors->has('location'))
                            <span class="text-red-600 text-sm">{{ $errors->first('location') }}</span>
                        @endif
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-medium py-2.5 px-5 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Save</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="w-1/3"></div>
    </div>
    
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&libraries=places"></script>
    
    <script>
        $('document').ready(function() {
            $('#bio').on('keyup', function() {
                var bio = $(this).val();
                if(bio.length > 400) {
                    $('#bio').val(bio.substring(0, 400));
                    $('#bio-length').html('<span class="text-red-600 text-sm">Bio must be less than 400 characters</span>');
                } else {
                    $('#bio-length').html('<span class="text-green">Characters left: ' + (400 - bio.length) + '</span>');
                }
            });

            var input = document.getElementById('location');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                $('input[name="latitude"]').val(place.geometry.location.lat());
                $('input[name="longitude"]').val(place.geometry.location.lng());
            });

            $('#username').on('keyup', function() {
                var username = $(this).val();
                if(username.length < 3) {
                    $('#username-check').html('<span class="text-red-600 text-sm">Username must be at least 3 characters</span>');
                    return;
                }
                
                $.ajax({
                    url: "{{ route('username') }}",
                    method: "GET",
                    data: {
                        username: username
                    },
                    success: function(data) {
                        if(data.status == 'success') {
                            $('#username-check').html('<span class="text-green-600 text-sm">' + data.message + '</span>');
                        } else {
                            $('#username-check').html('<span class="text-red-600 text-sm">' + data.message + '</span>');
                        }
                    }
                })
            })
        })
    </script>
@endsection