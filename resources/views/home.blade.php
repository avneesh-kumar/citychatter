@extends('layouts.app')

@section('content')

<div class="container flex flex-col lg:flex-row">
    <div class="w-full lg:w-3/4">
        @if($feeds->count() > 0)
            @foreach ($feeds as $feed)
                <div class="flex p-2 lg:p-8">
                    <div class="flex-none">
                        <a href="{{ route('user.profile', $feed->user->profile->username) }}">
                            @if($feed->user->profile->avatar)
                                <img src="{{ asset($feed->user->profile->avatar) }}" alt="{{ $feed->user->name }}" class="w-12 h-12 shadow-xl rounded-full object-cover">
                            @else
                                <img src="{{ asset('images/avatar.jpg') }}" alt="{{ $feed->user->name }}" class="w-12 h-12 shadow-xl rounded-full object-cover">
                            @endif
                        </a>
                    </div>
                    <div class="flex-auto ml-2" >
                        <div class="flex">
                            <div class="flex-auto">
                                <div class="font-semibold">
                                    <a href="{{ route('user.profile', $feed->user->profile->username) }}" class="text-red-600 hover:underline">
                                        {{ $feed->user->name }}
                                    </a>
                                </div>
                                <div class="text-xs text-gray-500">{{ $feed->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <div class="text-sm my-2">
                            <a href="{{ route('post', $feed->slug) }}" class="text-xl text-red-600">
                                {{ $feed->title }}
                            </a>
                        </div>
                        @if($feed->image)
                            <div class="flex justify-center h-auto lg:h-96 w-[90%] shadow-lg rounded-lg">
                                <a href="{{ route('post', $feed->slug) }}">
                                    <img src="{{ asset($feed->image) }}" alt="" class="object-cover w-auto h-auto max-h-40 lg:max-h-full lg:h-full rounded-lg lg:rounded-none" >
                                </a>
                            </div>
                        @endif
                        <div class="text-sm my-4 w-[90%] ">
                            <div class="w-full">
                                {!! nl2br(Str::limit(strip_tags($feed->content), 180)) !!}
                            </div>
                        </div>
                        <div class="text-lg text-gray-500">
                            {{ $feed->location }}
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
    <div class="w-full lg:w-1/4">
        <div class="text-center w-full pt-8 box-content">
            <div class="text-2xl font-semibold text-red-600">Advertisement</div>
            <div class="grid grid-cols-1">
                @if($advertisements->count() > 0)
                    @foreach ($advertisements as $advertisement)
                        @if($advertisement->image)
                            <div class="relative w-full p-1 m-1 h-64 max-h-64">
                                <!-- <div class="absolute text-xs right-[4px] top-[4px] rounded-sm bg-white text-black">ads</div> -->
                                <a href="{{ $advertisement->url }}" target="_blank">
                                    <img src="{{ asset($advertisement->image) }}" alt="" class="object-fit w-full h-full rounded-lg shadow-md">
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<div class="md:flex-1 flex-auto" style="margin-top: 100px;">
    {{ $feeds->links() }}
</div>
@endsection