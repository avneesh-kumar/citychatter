@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ url()->previous() }}" class="text-red-600 hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </div>
    <div class="h-auto mb-4">
        <div class="p-6">
            @if($userProfile->cover)
                <div class="bg-cover bg-center max-h-96 rounded-md" style="background-image: url({{ asset($userProfile->cover) }})">
            @else
                <div>
            @endif
                <div class="flex items-center justify-center">
                    <div class="w-56 h-56">
                        @if($userProfile->avatar)
                            <img src="{{ asset($userProfile->avatar) }}" alt="{{ $userProfile->user->name }}" class="shadow-xl rounded-full object-cover w-full h-full">
                        @else
                            <img src="{{ asset('images/avatar.jpg') }}" alt="{{ $userProfile->user->name }}" class="shadow-xl rounded-full object-cover w-full h-full">
                        @endif
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <div class="text-center">
                        @if(auth()->user()->id !== $userProfile->user->id)
                            <div class="mt-4">
                                @if($isFollowing)
                                    <button type="button" data-user-id="{{ $userProfile->user_id}}" class="unfollowBtn bg-red-300 hover:bg-red-400 text-white font-bold py-2 px-4 rounded">
                                        Following
                                    </button>
                                    <button type="button" data-user-id="{{ $userProfile->user_id}}" class="hidden followBtn bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                        Follow
                                    </button>
                                @else
                                    <button type="button" data-user-id="{{ $userProfile->user_id}}" class="followBtn bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                        Follow
                                    </button>
                                    <button type="button" data-user-id="{{ $userProfile->user_id}}" class="hidden unfollowBtn bg-red-300 hover:bg-red-400 text-white font-bold py-2 px-4 rounded">
                                        Following
                                    </button>
                                @endif
                            </div>
                        @endif
                        <h1 class="text-lg font-bold text-red-500 dark:text-gray-100 mt-4">
                            <!-- {{ '@' . $userProfile->username }} -->
                            {{ $userProfile->user->name }}
                        </h1>
                        <p class="text-gray-700 dark:text-gray-300">
                            <!-- <a href="mailto:{{ auth()->user()->email }}">
                                {{ $userProfile->user->email }}
                            </a> -->
                        </p>
                        <p>
                            {{ $userProfile->bio }}
                        </p>
                    </div>
                </div>
            </div>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <h1 class="text-2xl text-center">
                Your Feeds
            </h1>
            <div class="md:flex mt-16 justify-center">
                <div class="w-2/3 " style="margin: auto;">
                    <div class="grid grid-cols-1 gap-28 mb-4">
                        @foreach($userProfile->user->posts as $feed)
                        <div class="h-auto mb-4 shadow-lg mr-8">
                            <div class="items-center justify-center h-56 bg-gray-50">
                                <a href="{{ route('post', $feed['slug']) }}">
                                    <img class="object-cover w-full h-full" src="{{ asset($feed['image'] )}}" alt="{{ $feed['title'] }}" />
                                </a>
                            </div>
                            <div class="p-2">
                                <div class="mt-2">
                                    <a href="{{ route('post', $feed['slug']) }}">
                                        <h1 class="text-xl font-bold text-red-500 hover:underline">
                                                {{ $feed["title"] }}
                                        </h1>
                                    </a>
                                    <p class="text-gray-700 dark:text-gray-300">
                                    {!! nl2br(implode(' ', array_slice(explode(' ', $feed['content']), 0, 20))) !!}...
                                    </p>
                                </div>
                                <div class="my-4">
                                    <div class="grid grid-cols-2">
                                        <div class="text-left">
                                            <span class="text-gray-400 ">
                                                {{ $feed['location'] }}
                                            </span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-gray-400 ">
                                                {{ date('d M Y h:m:i', strtotime($feed['created_at']))  }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- add edit and delete button -->
                                <div class="my-4">
                                    <div class="grid grid-cols-2">
                                        <div class="text-left">
                                            <span class="text-gray-400 cursor-pointer ">
                                                <a href="{{ route('post.create', $feed['id']) }}">
                                                    Edit
                                                </a>
                                            </span>
                                        </div>
                                        @if(auth()->user()->id == $feed['user_id'])
                                            <div class="text-right">
                                                <span class="text-red-400 cursor-pointer">
                                                    Delete
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-1/3 border- text-center">
                    <div class="mb-4">
                        <h1 class="text-2xl font-bold text-red-500 dark:text-gray-100">
                            Followers
                        </h1>
                    </div>
                    @if(count($followers) != 0)
                        @foreach($followers as $follower)
                            <div class="mb-4">
                                <div class="flex flex-row justify-between">
                                    <div class="flex flex-row">
                                        <div class="w-12 h-12">
                                            @if($follower->followedBy->profile->avatar)
                                                <img src="{{ asset($follower->followedBy->profile->avatar) }}" alt="{{ $follower->followedBy->name }}" class="shadow-xl rounded-full object-cover w-full h-full">
                                            @else
                                                <img src="{{ asset('images/avatar.jpg') }}" alt="{{ $follower->followedBy->name }}" class="shadow-xl rounded-full object-cover w-full h-full">
                                            @endif
                                        </div>
                                        <div class="ml-4 mt-2 text-left">
                                            <h1 class="text-lg font-bold text-red-500 dark:text-gray-100">
                                                <a href="{{ route('user.profile', $follower->followedBy->profile->username) }}">
                                                    {{ $follower->followedBy->name }}
                                                </a>
                                            </h1>
                                            <p class="text-gray-700 dark:text-gray-300">
                                                <a href="{{ route('user.profile', $follower->followedBy->profile->username) }}">
                                                    {{ '@' . $follower->followedBy->profile->username }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        @if($follower->followedBy->id !== auth()->user()->id)
                                            <button type="button" data-user-id="{{ $follower->followedBy->id }}" class="followBtn bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                                Follow
                                            </button>
                                            <button type="button" data-user-id="{{ $follower->followedBy->id }}" class="hidden unfollowBtn bg-red-300 hover:bg-red-400 text-white font-bold py-2 px-4 rounded">
                                                Following
                                            </button>
                                        @else
                                            <button type="button" data-user-id="{{ $follower->followedBy->id }}" class="unfollowBtn bg-red-300 hover:bg-red-400 text-white font-bold py-2 px-4 rounded">
                                                Following
                                            </button>
                                            <button type="button" data-user-id="{{ $follower->followedBy->id }}" class="hidden followBtn bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                                Follow
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div>
                            <p class="text-gray-700 dark:text-gray-300">
                                No other followers yet.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.followBtn').click(function() {
                let $this = this;
                var id = $(this).data('user-id');
                $.ajax({
                    url: '{{ route('user.follow') }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(response) {
                        if(response.status == 'success') {
                            $($this).next().removeClass('hidden');
                            $($this).addClass('hidden');
                        }
                    }
                });
            });

            $('.unfollowBtn').click(function() {
                let $this = this;
                var id = $(this).data('user-id');
                $.ajax({
                    url: '{{ route('user.unfollow') }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(response) {
                        if(response.status == 'success') {
                            $($this).prev().removeClass('hidden');
                            $($this).addClass('hidden');
                        }
                    }
                });
            });
        });
    </script>
@endsection