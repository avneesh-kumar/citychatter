@extends('layouts.app') 
@section('content')

<div class="md:flex">
    <div class="md:flex-1 flex-auto ">
        @if($feeds->count() > 0)
            @foreach ($feeds as $feed)
                <div class="flex w-3/4 mb-8">
                    <div class="flex-none">
                        <a href="{{ route('user.profile') }}">
                            <img src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="" class="rounded-full w-12 h-12">
                        </a>
                    </div>
                    <div class="flex-auto ml-2">
                        <div class="flex">
                            <div class="flex-auto">
                                <div class="font-semibold">
                                    <a href="{{ route('user.profile') }}">
                                        {{ $feed->user->name }}
                                    </a>
                                </div>
                                <div class="text-xs text-gray-500">{{ $feed->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <div class="text-sm my-2">
                            <a href="{{ route('post', $feed->slug) }}" class="text-red-600">
                                {{ $feed->title }}
                            </a>
                        </div>
                        <div class="flex-none w-2/3 h-1/2">
                            <a href="{{ route('post', $feed->slug) }}">
                                <img src="{{ asset($feed->image ) }}" alt="" class="w-full h-full">
                            </a>
                            <div class="text-sm my-2">
                                {{ Str::limit($feed->content, 210) }}
                            </div>
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

    <!-- show pagination links -->
</div>
<div class="md:flex-1 flex-auto">
    {{ $feeds->links() }}
</div>

@endsection