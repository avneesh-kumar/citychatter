@extends('layouts.app')

@section('content')
    <div class="w-full lg:w-3/4 p-2 lg:p-8">
        <h1 class="text-2xl text-red-500 text-center mb-8 underline">Messages</h1>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">

        @if($messages->count() > 0)
            <div class="overflow-x-auto mt-4">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2 text-left">Sender</th>
                            <th class="border px-4 py-2 text-left">Title of the post</th>
                            <th class="border px-4 py-2 text-left">Message</th>
                            <th class="border px-4 py-2 text-left">Date</th>
                            <th class="border px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            @if($message->seen)
                                <tr class="font-semibold">
                            @else
                                <tr >
                            @endif
                                <td class="border px-4 py-2">
                                    <a href="{{ route('user.profile', $message->fromUser->profile->username) }}" class="hover:text-red-500 hover:underline">
                                        @if($message->from == auth()->user()->id)
                                        You
                                        @else
                                        {{ $message->fromUser->name }}
                                        @endif
                                    </a>
                                </td>
                                <td class="border px-4 py-2">
                                    <p>{{ $message->post ? $message->post->title : 'No Title' }}</p>
                                </td>
                                <td class="border px-4 py-2">
                                    <p>{{ $message->message }}</p>
                                </td>
                                <td class="border px-4 py-2">
                                    <p>{{ $message->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('message.view', ['id' => $message->id]) }}" class="inline-block text-blue-500">View</a>
                                    <form action="{{ route('message.delete') }}" method="post" class="ml-4 inline-block">
                                        @csrf
                                        <input type="hidden" name="message_id" value="{{ $message->id }}">
                                        <button type="button" class="deleteBtn text-red-500">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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