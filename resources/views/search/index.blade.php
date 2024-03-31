@extends('layouts.app') 
@section('content')

@if(isset($breadcrumbs) && $breadcrumbs)
    <div class="flex items-center justify-between p-4 bg-white border-b border-gray-200">
        <div class="flex items-center space-x-2 text-sm">
            <a href="{{ route('post') }}" class="text-red-600 hover:underline">
                Chatter
            </a>
            @foreach($breadcrumbs as $breadcrumb)
                <span class="text-gray-400">
                    /
                </span>
                <a href="{{ $breadcrumb['url'] }}" class="text-red-600 hover:underline">
                    {{ $breadcrumb['name'] }}
                </a>
            @endforeach
        </div>
    </div>
@endif

<div class="md:flex">
    <div class="md:flex-1 flex-auto">
        @if($posts->count() > 0)
            @foreach ($posts as $post)
                <div class="flex p-8">
                    <div class="flex-none">
                        <a href="{{ route('user.profile', $post->user->profile->username ) }}">
                            @if($post->user->profile->avatar)
                                <img src="{{ asset($post->user->profile->avatar) }}" alt="{{ $post->user->name }}" class="w-12 h-12 shadow-xl rounded-full object-cover">
                            @else
                                <img src="{{ asset('images/avatar.jpg') }}" alt="{{ $post->user->name }}" class="w-12 h-12 shadow-xl rounded-full object-cover">
                            @endif
                        </a>
                    </div>
                    <div class="flex-auto ml-2" >
                        <div class="flex">
                            <div class="flex-auto">
                                <div class="font-semibold">
                                    <a href="{{ route('user.profile', $post->user->profile->username) }}" class="text-red-600 hover:underline">
                                        {{ $post->user->name }}
                                    </a>
                                </div>
                                <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <div class="text-sm my-2">
                            <a href="{{ route('post', $post->slug) }}" class="text-xl text-red-600">
                                {{ $post->title }}
                            </a>
                        </div>
                        @if($post->image)
                            <div class="flex-none h-96 " style="width: 90%">
                                <a href="{{ route('post', $post->slug) }}">
                                    <img src="{{ asset($post->image) }}" alt="" class="object-cover w-full h-full" >
                                </a>
                            </div>
                        @endif
                        <div class="text-sm my-4 " style="width: 90%">
                            {{ Str::limit($post->content, 180) }}
                        </div>
                        <div class="text-lg text-gray-500">
                            {{ $post->location }}
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center text-2xl text-red-500 p-4 font-semibold">
                No Post Found
            </div>
        @endif
    </div>
    <div class="w-1/3 border-2 border-gray-900">
        <div class="text-center">
            Advertisement
        </div>
    </div>

    <!-- show pagination links -->
</div>
<div class="md:flex-1 flex-auto" style="margin-top: 100px;">
    {{ $posts->links() }}
</div>

@endsection