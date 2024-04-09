@extends('layouts.app')

@section('content')

<div class="md:flex">
    <div class="md:flex-1 flex-auto">
        @if($feeds->count() > 0)
            @foreach ($feeds as $feed)
                <div class="flex p-8">
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
                            <div class="flex-none h-80 " style="width: 90%;">
                                <a href="{{ route('post', $feed->slug) }}">
                                    <img src="{{ asset($feed->image) }}" alt="" class="object-cover w-full h-full rounded-lg shadow-md" >
                                </a>
                            </div>
                        @endif
                        <div class="text-sm my-4 " style="width: 90%;">
                            {!! nl2br(Str::limit($feed->content, 180)) !!}
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
    <div class="w-1/3 border-2 border-gray-900">
        <div class="text-center">
            Advertisement
        </div>
    </div>

</div>
<div class="md:flex-1 flex-auto" style="margin-top: 100px;">
    {{ $feeds->links() }}
</div>
@endsection