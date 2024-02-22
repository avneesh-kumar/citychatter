@extends('layouts.app')

@section('content')
    <style>
        @media (max-width: 767px) {
            .form-container {
                width: 100%; /* Full width on mobile */
            }
        }
    </style>
    <div class="flex justify-center">
        <div class="form-container w-1/2">
            <div>
                <h1 class="text-2xl font-semibold text-red-600 hover:underline">
                    <a href="{{ route('user.profile', $user->profile->username ) }}" target="_blank">Profile
                    </a>
                </h1>
            </div>
            <form action="{{ route('profile.store') }}" method="post" class="space-y-4" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name
                    </label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" autocomplete="off" value="{{ old('name') ? old('name') : $user->name }}" />
                    @if ($errors->has('name'))
                        <span class="text-red-600 text-sm">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                    </label>
                    <input type="email" readonly name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" autocomplete="off" value="{{ old('email') ? old('email') : $user->email }}" />
                    @if ($errors->has('email'))
                        <span class="text-red-600 text-sm">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div>
                    <label for="optional_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Business Email
                    </label>
                    <input type="email" name="optional_email" id="optional_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" autocomplete="off" value="{{ old('optional_email') ? old('optional_email') : $user->profile->optional_email }}" />
                    @if ($errors->has('optional_email'))
                        <span class="text-red-600 text-sm">{{ $errors->first('optional_email') }}</span>
                    @endif
                </div>
                
                <div>
                    <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender
                    </label>
                    <select name="gender" id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                        <option value="male" {{ $user->profile->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $user->profile->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $user->profile->gender == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @if ($errors->has('gender'))
                        <span class="text-red-600 text-sm">{{ $errors->first('gender') }}</span>
                    @endif
                </div>

                <div>
                    <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bio
                    </label>
                    <textarea type="text" name="bio" id="bio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" autocomplete="off" >{{ old('bio') ? old('bio') : $user->profile->bio }}</textarea>
                    @if ($errors->has('name'))
                        <span class="text-red-600 text-sm">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username
                    </label>
                    <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"  autocomplete="off" value="{{ old('email') ? old('username') : $user->profile->username }}" />
                    <div id="username-check">

                    </div>
                    @if ($errors->has('username'))
                        <span class="text-red-600 text-sm">{{ $errors->first('username') }}</span>
                    @endif
                </div>

                <div>
                    <label for="avatar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Avatar
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
                    <label for="cover" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cover
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
                    <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location
                    </label>
                    <input type="text" name="location" id="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"  autocomplete="off" value="{{ old('location') ? old('location') : $user->profile->location }}" />
                    <input type="hidden" name="latitude" value="{{ $user->profile->latitude }}" />
                    <input type="hidden" name="longitude" value="{{ $user->profile->longitude }}" />
                    @if ($errors->has('location'))
                        <span class="text-red-600 text-sm">{{ $errors->first('location') }}</span>
                    @endif
                </div>

                <div>
                    <label for="show_username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Show username on the profile page
                    </label>
                    <select name="show_username" id="show_username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                        <option value="1" {{ $user->profile->show_username ? 'selected' : '' }}>Show</option>
                        <option value="0" {{ !$user->profile->show_username ? 'selected' : '' }}>Hide</option>
                    </select>
                    @if ($errors->has('show_username'))
                        <span class="text-red-600 text-sm">{{ $errors->first('show_username') }}</span>
                    @endif
                </div>

                <div>
                    <label for="show_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Show email on the profile page
                    </label>
                    <select name="show_email" id="show_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                        <option value="1" {{ $user->profile->show_email ? 'selected' : '' }}>Show</option>
                        <option value="0" {{ !$user->profile->show_email ? 'selected' : '' }}>Hide</option>
                    </select>
                    @if ($errors->has('show_email'))
                        <span class="text-red-600 text-sm">{{ $errors->first('show_email') }}</span>
                    @endif
                </div>

                <div>
                    <label for="sort_by" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sort By
                    </label>
                    <select name="sort_by" id="sort_by" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                        <option value="newest" {{ $user->profile->sort_by == 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="location" {{ $user->profile->sort_by == 'location' ? 'selected' : '' }}>Location</option>
                    </select>
                    @if ($errors->has('sort_by'))
                        <span class="text-red-600 text-sm">{{ $errors->first('sort_by') }}</span>
                    @endif
                </div>

                <div>
                    <label for="in_radius" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Feeds in Radius (Miles)
                    </label>
                    <input type="text" name="in_radius" id="in_radius" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"  autocomplete="off" value="{{ old('in_radius') ? old('in_radius') : $user->profile->in_radius }}" />
                    @if ($errors->has('in_radius'))
                        <span class="text-red-600 text-sm">{{ $errors->first('in_radius') }}</span>
                    @endif
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-medium py-2.5 px-5 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Save</button>
                </div>

            </form>
        </div>
    </div>
    
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&libraries=places"></script>
    
    <script>
        $('document').ready(function() {
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