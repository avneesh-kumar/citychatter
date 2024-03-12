@extends('layouts.app')

@section('content')
    <div class="h-screen ">

        <h1 class="text-2xl text-red-500 text-center mb-8 underline">Messages</h1>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">

        @if($messages->count() > 0)
        <div class="grid grid-cols-5">
            <div class="border text-left p-2 text-semibold">
                Sender
            </div>
            <div class="border text-left p-2 text-semibold">
                Title of the post
            </div>
            <div class="border text-left p-2 text-semibold">
                Message
            </div>
            <div class="border text-left p-2 text-semibold">
                Date
            </div>
            <div class="border text-left p-2 text-semibold">
                Action
            </div>
        </div>
        <div class="grid grid-cols-5">
            @foreach($messages as $message)
                @if($message->seen)
                    <div class="border p-2">
                        <p>
                            <a href="{{ route('user.profile', $message->fromUser->profile->username) }}" class="hover:text-red-500 hover:underline">
                                @if($message->from == auth()->user()->id)
                                You
                                @else
                                {{ $message->fromUser->name }}
                                @endif
                            </a>
                        </p>
                    </div>
                    <div class="border p-2">
                        <p>{{ $message->post->title }}</p>
                    </div>
                    <div class="border p-2">
                        <p>{{ $message->message }}</p>
                    </div>
                    <div class="border p-2">
                        <p>{{ $message->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="border p-2">
                        <a href="{{ route('message.view', ['id' => $message->id]) }}" class="inline-block text-blue-500">View</a>
                        <form action="{{ route('message.delete') }}" method="post" class="ml-4 inline-block">
                            @csrf
                            <input type="hidden" name="message_id" value="{{ $message->id }}">
                            <button type="button" class="deleteBtn text-red-500">Delete</button>
                        </form>
                    </div>
                @else
                    <div class="border p-2 font-semibold ">
                        <p>
                            <a href="{{ route('user.profile', $message->fromUser->profile->username) }}" class="hover:text-red-500  hover:underline">
                                @if($message->from == auth()->user()->id)
                                You
                                @else
                                {{ $message->fromUser->name }}
                                @endif
                            </a>
                        </p>
                    </div>
                    <div class="border p-2 font-semibold">
                        <p>{{ $message->post->title }}</p>
                    </div>
                    <div class="border p-2 font-semibold">
                        <p>{!! nl2br($message->message) !!}</p>
                    </div>
                    <div class="border p-2 font-semibold">
                        <p>{{ $message->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="border p-2">
                        <a href="{{ route('message.view', ['id' => $message->id]) }}" class="inline-block text-blue-500 font-semibold">View</a>
                        <form action="{{ route('message.delete') }}" method="post" class="ml-4 inline-block">
                            @csrf
                            <input type="hidden" name="message_id" value="{{ $message->id }}">
                            <button type="button" class="deleteBtn text-red-500">Delete</button>
                        </form>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="mt-10">
            {{ $messages->links() }}
        </div>
        @else
            <div class="col-span-4 mt-4">
                <p class="text-center">No message found</p>
            </div>
        @endif
    </div>
    <script>
        $(document).ready(function(){
            $('.deleteBtn').click(function(){
                if(confirm('Are you sure you want to delete this message?')){
                    $(this).parent().submit();
                }
            });
        });
    </script>
        
@endsection