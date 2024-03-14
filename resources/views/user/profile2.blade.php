@extends('layouts.app')

@section('content')
    <!-- <div>
        <a href="{{ url()->previous() }}" class="text-red-600 hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </div> -->
    <div class="h-auto mb-4">
        <div class="p-6">
            @if($userProfile->cover)
                <div class="bg-cover bg-center max-h-96 rounded-md h-96" style="background-image: url({{ asset($userProfile->cover) }})"></div>
            @else
                <div class="bg-cover bg-center max-h-96 rounded-md shadow-lg h-96"></div>
            @endif
            <div class="flex h-64 ">
                <div class=" w-96 ">
                    <div class="relative">
                        <div class="absolute w-56 h-56" style="top:-55px; left: 35%">
                            @if($userProfile->avatar)
                            <img src="{{ asset($userProfile->avatar) }}" alt="{{ $userProfile->user->name }}" class="absolute shadow-xl rounded-full object-cover w-full h-full " >
                            @else
                            <img src="{{ asset('images/avatar.jpg') }}" alt="{{ $userProfile->user->name }}" class="absolute shadow-xl rounded-full object-cover w-full h-full " >
                            @endif
                            <div class="w-full h-72 flex justify-center items-end">
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
                            </div>
                        </div>
                    </div>
                    
                    <!-- <div class="relative h-full w-full">
                        @if($userProfile->avatar)
                        <img src="{{ asset($userProfile->avatar) }}" alt="{{ $userProfile->user->name }}" class="absolute shadow-xl rounded-full object-cover w-56 h-56 " style="top:-15%; left: 35%">
                        @else
                        <img src="{{ asset('images/avatar.jpg') }}" alt="{{ $userProfile->user->name }}" class="absolute shadow-xl rounded-full object-cover w-56 h-56 " style="top:-15%; left: 35%">
                        @endif

                        <div class="absolute " style="top:65%; left: 50%">
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
                        </div>
                    </div> -->
                </div>
                <div class="w-full px-16">
                    <div class="text-left">
                        <h1 class="text-lg font-bold text-red-500 dark:text-gray-100 mt-4">
                            {{ $userProfile->user->name }} {{ $userProfile->username ? "(" . $userProfile->username . ")" : '' }}
                        </h1>
                        <p class="text-gray-700 dark:text-gray-300">
                            @if($userProfile->show_email)
                                <a href="mailto:{{ $userProfile->user->email }}">
                                    {{ $userProfile->user->email }}
                                </a> <br />
                                @if($userProfile->optional_email)
                                    Business Email :
                                    <a href="mailto:{{ $userProfile->optional_email }}">
                                        {{ $userProfile->optional_email }}
                                    </a>
                                @endif
                            @endif
                        </p>
                        <p class="w-full text-justify mt-2 p-2">
                            {{ $userProfile->bio }}
                        </p>
                    </div>
                </div>
            </div>
            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
            <h1 class="text-2xl text-left">
                Posts
            </h1>
            <div class="md:flex mt-8 justify-center">
                <div class="w-full " style="margin: auto;">
                    <div class="mb-4">
                        @foreach($userProfile->user->posts as $feed)
                        <div class="h-auto mb-4 shadow-lg rounded-lg mr-8" id="post-{{ $feed->id }}">
                            <div class="items-center justify-center h-80 bg-gray-50">
                                @if($feed['image'])
                                    <a href="{{ route('post', $feed['slug']) }}">
                                        <img class="object-cover w-full h-full rounded-t-lg " src="{{ asset($feed['image'] )}}" alt="{{ $feed['title'] }}" class="w-full h-full" />
                                    </a>
                                @endif
                            </div>
                            <div class="p-2">
                                <div class="mt-2">
                                    <a href="{{ route('post', $feed['slug']) }}">
                                        <h1 class="text-xl text-red-500 hover:underline">
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
                                @if(auth()->user()->id == $feed['user_id'])
                                    <div class="my-4">
                                        <div class="text-right">
                                            <div class="inline-block text-right">
                                                <span class="text-gray-400 cursor-pointer ">
                                                    <a href="{{ route('post.create', $feed['id']) }}">
                                                        Edit
                                                    </a>
                                                </span>
                                            </div>
                                            <div class="inline-block text-right">
                                                <span class="text-red-400 cursor-pointer postDeleteBtn" data-post-id="{{ $feed->id }}">
                                                    Delete
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-1/3 text-left">
                    <div class="mb-4">
                        <h1 class="text-2xl text-red-500 dark:text-gray-100">
                            Followers
                        </h1>
                    </div>
                    @if(count($followers) != 0)
                        @foreach($followers as $follower)
                            <div class="mb-1">
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
                                            <h1 class="text-sm text-red-500 dark:text-gray-100">
                                                <a href="{{ route('user.profile', $follower->followedBy->profile->username) }}">
                                                    {{ $follower->followedBy->name }}
                                                </a>
                                            </h1>
                                            <!-- <p class="text-gray-700 dark:text-gray-300">
                                                <a href="{{ route('user.profile', $follower->followedBy->profile->username) }}">
                                                    {{ '@' . $follower->followedBy->profile->username }}
                                                </a>
                                            </p> -->
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        @if(!in_array($follower->followedBy->id, $follows))
                                            <button type="button" data-user-id="{{ $follower->followedBy->id }}" class="hidden unfollowBtn bg-red-300 hover:bg-red-400 text-white p-1 rounded text-sm">
                                                Following
                                            </button>
                                            <button type="button" data-user-id="{{ $follower->followedBy->id }}" class="followBtn bg-red-500 hover:bg-red-600 text-white p-1 rounded text-sm">
                                                Follow
                                            </button>
                                        @else
                                            <button type="button" data-user-id="{{ $follower->followedBy->id }}" class="unfollowBtn bg-red-300 hover:bg-red-400 text-white p-1 rounded text-sm">
                                                Following
                                            </button>
                                            <button type="button" data-user-id="{{ $follower->followedBy->id }}" class="hidden followBtn bg-red-500 hover:bg-red-600 text-white p-1 rounded text-sm">
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
                            $($this).prev().removeClass('hidden');
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
                            $($this).next().removeClass('hidden');
                            $($this).addClass('hidden');
                        }
                    }
                });
            });

            $('.postDeleteBtn').click(function() {
                let $this = this;
                var id = $(this).data('post-id');
                var confirmation = confirm('Are you sure you want to delete this post?');
                if(confirmation) {
                    $.ajax({
                        url: '{{ route('post.delete') }}',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id,
                        },
                        success: function(response) {
                            if(response.success) {
                                $('#post-'+id).remove();
                                location.reload();
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection