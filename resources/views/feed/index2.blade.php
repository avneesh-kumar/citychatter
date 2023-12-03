@extends('layouts.app') 
@section('content')

   @if($feeds->count() > 0)
      <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3 mb-4">
         @foreach($feeds as $feed)
            <div class="h-auto mb-4 shadow-lg">
               <div class="items-center justify-center h-56 bg-gray-50">
                  <img class="object-cover w-full h-full" src="{{ asset($feed['image']) }}" alt="{{ $feed['title'] }}" />
               </div>
               <div class="p-2">
                  <div class="mt-2">
                     <a href="{{ route('post', $feed->slug) }}">
                        <h1 class="text-xl font-bold text-blue-500 hover:underline">
                              {{ $feed->title }}
                        </h1>
                     </a>
                     <p class="text-gray-700 dark:text-gray-300">
                        {{ implode(' ', array_slice(explode(' ', $feed->content), 0, 20)) }}...
                     </p>
                  </div>
                  <!-- <div class="my-4">
                     <div class="grid grid-cols-3 gap-4">
                        <div class="text-left">
                           <span class="text-blue-400 cursor-pointer">
                              Like
                           </span>
                        </div>
                        <div class="text-center">
                           <span class="text-blue-400 cursor-pointer">
                              Comment
                           </span>
                        </div>
                        <div class="text-right">
                           <span class="text-blue-400 cursor-pointer">
                              Share
                           </span>
                        </div>
                     </div>
                  </div> -->
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
               </div>
            </div>
         @endforeach
      </div>

      <div class="flex items-center justify-center">
         {{ $feeds->links() }}
      </div>
   @else
      <div class="flex items-center justify-center h-screen">
         <div class="text-center">
            <h1 class="text-2xl font-bold text-red-600">
               No feeds found
            </h1>
            <p class="text-red-700">
               Please try again later
            </p>
         </div>
      </div>
   @endif

@endsection