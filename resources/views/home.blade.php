@extends('layouts.app')

@section('content')
<div class="text-center p-4">
    <div class="text-2xl text-red-500 p-4 font-semibold">
        CityChatter
    </div>
    <div class="">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non asperiores quam modi et fugiat voluptatum ex ullam ducimus soluta. Porro, consectetur amet rerum facilis dignissimos repudiandae nemo delectus ratione veritatis.
    </div>
</div>
<div class="md:flex">
    <div class="md:flex-1 flex-auto ">
        <div class="flex gap-3 columns-3">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                @foreach ($feeds as $feed)
                    <div class="w-full p-4">
                        <div class="bg-white rounded-lg shadow-lg">
                            <div class="bg-cover bg-center h-56 p-4">
                                <img src="{{ $feed['image'] }}" alt="{{ $feed['title'] }}">
                            </div>
                            <div class="p-4">
                                <p class="uppercase tracking-wide text-sm font-bold text-gray-700">{{ $feed['title'] }}</p>
                                <p class="text-md text-gray-900">{{ $feed['description'] }}</p>
                                <p class="text-gray-700">{{ $feed['location'] }}</p>
                                <div class="mt-4">
                                    <a href="#" class="text-red-500 hover:underline">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>    
    </div>
</div>
@endsection