@extends('layouts.app')

@section('content')
    <div class="h-screen ">
        <!-- add a back button without backgroud -->
        <div class="flex justify-start items-center h-8">
            <a href="{{ route('message') }}" class="text-red-500 hover:text-red-600 hover:underline">
                <!-- unicode for left arrow -->
                <span class="font-semibold">&#x2190;</span>
                Back to messages
            </a>
        </div>
        @if(session('success'))
            <div class="flex justify-center items-center h-12">
                <p class="text-green text-center">{{ session('message') }}</p>
            </div>
        @endif
        <div class="flex">
            <!-- <div class="w-96 overflow-y-hidden max-h-screen shadow-md" style="height: 743px;">
                @if($message->fromUser->id != auth()->user()->id)
                    <div class="flex justify-center items-center h-16 ">
                        <h1 class="text-2xl text-red-500 underline">Sender information</h1>
                    </div>
                    <div class="flex justify-center items-center h-28 ">
                        <div class="w-24 h-24 bg-gray-300 rounded-full">
                            @if($message->fromUser->profile->avatar)
                                <img src="{{ asset($message->fromUser->profile->avatar) }}" alt="avatar" class="w-24 h-24 rounded-full shadow-lg">
                            @else
                                <img src="{{ asset('images/avatar.jpg') }}" alt="avatar" class="w-24 h-24 rounded-full shadow-lg">
                            @endif
                        </div>
                    </div>
                    <div class=" justify-center items-center">
                        <div class="m-2">
                            <div class="text-center">
                                <a href="{{ route('user.profile', $message->fromUser->profile->username) }}" class="hover:text-red-500 hover:underline" target="_blank">
                                    {{ $message->fromUser->name }}
                                    @if($message->fromUser->profile->show_username)
                                    <br>
                                        <span class="text-red-500"> ({{ $message->fromUser->profile->username }})</span>
                                    @endif
                                </a>
                            </div>
                            <div class="text-justify my-8">
                                <div class="text-center mb-2">
                                    <span class="text-red-500 underline">Initial Message:</span>
                                </div>
                                {!! nl2br($message->message) !!}
                            </div>
                        </div>
                    </div>
                    @if($message->fromUser->posts->count() > 0)
                        <div class="flex justify-center items-center">
                            <h1 class="text-2xl text-red-500 underline">Latest posts</h1>
                        </div>
                        <div class="flex justify-center items-center">
                            <div class="w-96 h-96 overflow-y-auto">
                                @foreach($message->fromUser->posts as $key => $post)
                                    <div class="border p-2 m-2">
                                        <a href="{{ route('post', $post->slug) }}" class="hover:text-red-500 hover:underline">
                                            {{ $post->title }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <div class="flex justify-center items-center h-16 ">
                        <h1 class="text-2xl text-red-500 underline">Recipient information</h1>
                    </div>
                    <div class="flex justify-center items-center h-28 ">
                        <div class="w-24 h-24 bg-gray-300 rounded-full">
                            @if($message->toUser->profile->avatar)
                                <img src="{{ asset($message->toUser->profile->avatar) }}" alt="avatar" class="w-24 h-24 rounded-full shadow-lg">
                            @else
                                <img src="{{ asset('images/avatar.jpg') }}" alt="avatar" class="w-24 h-24 rounded-full shadow-lg">
                            @endif
                        </div>
                    </div>
                    <div class=" justify-center items-center">
                        <div class="m-2">
                            <div class="text-center">
                                <a href="{{ route('user.profile', $message->toUser->profile->username) }}" class="hover:text-red-500 hover:underline" target="_blank">
                                    {{ $message->toUser->name }}
                                    @if($message->toUser->profile->show_username)
                                    <br>
                                        <span class="text-red-500"> ({{ $message->toUser->profile->username }})</span>
                                    @endif
                                </a>
                            </div>
                            <div class="text-justify my-8">
                                <div class="text-center mb-2">
                                    <span class="text-red-500 underline">Initial Message:</span>
                                </div>
                                {!! nl2br($message->message) !!}
                            </div>
                        </div>
                    </div>
                    @if($message->toUser->posts->count() > 0)
                        <div class="flex justify-center items-center">
                            <h1 class="text-2xl text-red-500 underline">Latest posts</h1>
                        </div>
                        <div class="flex justify-center items-center">
                            <div class="w-96 h-96 overflow-y-auto">
                                @foreach($message->toUser->posts as $key => $post)
                                    <div class="border p-2 m-2">
                                        <a href="{{ route('post', $post->slug) }}" class="hover:text-red-500 hover:underline">
                                            {{ substr($post->title, 0, 35) }}{{ strlen($post->title) > 35 ? '...' : '' }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            </div> -->
            <input type="hidden" name="post_message_id" value="{{ $message->id }}" >
            <input type="hidden" name="post_id" value="{{ $message->post_id ? $message->post_id : null }}" />
            @if($message->fromUser->id != auth()->user()->id)
                <input type="hidden" name="to" value="{{ $message->fromUser->id }}" />
            @else
                <input type="hidden" name="to" value="{{ $message->toUser->id }}" />
            @endif

            <div class="w-full overflow-y-hidden p-2 ">
                <!-- @if($message->fromUser->id != auth()->user()->id)
                    <div class="flex justify-center items-center h-16 ">
                        <h1 class="text-2xl text-red-500 underline">Sender information</h1>
                    </div>
                    <div class="flex justify-center items-center h-28 ">
                        <div class="w-24 h-24 bg-gray-300 rounded-full">
                            @if($message->fromUser->profile->avatar)
                                <img src="{{ asset($message->fromUser->profile->avatar) }}" alt="avatar" class="w-24 h-24 rounded-full shadow-lg">
                            @else
                                <img src="{{ asset('images/avatar.jpg') }}" alt="avatar" class="w-24 h-24 rounded-full shadow-lg">
                            @endif
                        </div>
                    </div>
                    <div class=" justify-center items-center">
                        <div class="m-2">
                            <div class="text-center">
                                <a href="{{ route('user.profile', $message->fromUser->profile->username) }}" class="hover:text-red-500 hover:underline" target="_blank">
                                    {{ $message->fromUser->name }}
                                    @if($message->fromUser->profile->show_username)
                                    <br>
                                        <span class="text-red-500"> ({{ $message->fromUser->profile->username }})</span>
                                    @endif
                                </a>
                            </div>
                            <div class="text-justify my-8">
                                <div class="text-center mb-2">
                                    <span class="text-red-500 underline">Initial Message:</span>
                                </div>
                                {!! nl2br($message->message) !!}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex justify-center items-center h-16 ">
                        <h1 class="text-2xl text-red-500 underline">Recipient information</h1>
                    </div>
                    <div class="flex justify-center items-center h-28 ">
                        <div class="w-24 h-24 bg-gray-300 rounded-full">
                            @if($message->toUser->profile->avatar)
                                <img src="{{ asset($message->toUser->profile->avatar) }}" alt="avatar" class="w-24 h-24 rounded-full shadow-lg">
                            @else
                                <img src="{{ asset('images/avatar.jpg') }}" alt="avatar" class="w-24 h-24 rounded-full shadow-lg">
                            @endif
                        </div>
                    </div>
                    <div class=" justify-center items-center">
                        <div class="m-2">
                            <div class="text-center">
                                <a href="{{ route('user.profile', $message->toUser->profile->username) }}" class="hover:text-red-500 hover:underline" target="_blank">
                                    {{ $message->toUser->name }}
                                    @if($message->toUser->profile->show_username)
                                    <br>
                                        <span class="text-red-500"> ({{ $message->toUser->profile->username }})</span>
                                    @endif
                                </a>
                            </div>
                            <div class="text-justify my-8">
                                <div class="text-center mb-2">
                                    <span class="text-red-500 underline">Initial Message:</span>
                                </div>
                                {!! nl2br($message->message) !!}
                            </div>
                        </div>
                    </div>
                @endif -->
                
                <div id="reply-container" class="p-2 border-t-2 mt-2 border-x-2 overflow-y-auto " style="height: 680px; max-height: 680px;">
                    <div class="flex">
                        <div class="w-12 ">
                            @if($message->fromUser->profile->avatar)
                                <img src="{{ asset($message->fromUser->profile->avatar) }}" alt="avatar" class="w-12 h-12 rounded-full shadow-lg">
                            @else
                                <img src="{{ asset('images/avatar.jpg') }}" alt="avatar" class="w-12 h-12 rounded-full shadow-lg">
                            @endif
                        </div>
                        <div class="w-full ml-4">
                            <div class="flex justify-between">
                                <div>
                                    <a href="{{ route('user.profile', $message->fromUser->profile->username) }}" class="hover:text-red-500 hover:underline">
                                        {{ $message->fromUser->name }}
                                        @if($message->fromUser->profile->show_username)
                                        <br>
                                            <span class="text-red-500"> ({{ $message->fromUser->profile->username }})</span>
                                        @endif
                                    </a>
                                </div>
                                <div>
                                    <p class="text-xs">{{ $message->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="text-justify my-8">
                                <b>Initial Message:</b> {!! nl2br($message->message) !!}
                            </div>
                        </div>
                    </div>
                    @if($message->replies->count() > 0)
                        @foreach($message->replies as $reply)
                        <div class="flex">
                            <div class="w-12 ">
                                @if($reply->fromUser->profile->avatar)
                                    <img src="{{ asset($reply->fromUser->profile->avatar) }}" alt="avatar" class="w-12 h-12 rounded-full shadow-lg">
                                @else
                                    <img src="{{ asset('images/avatar.jpg') }}" alt="avatar" class="w-12 h-12 rounded-full shadow-lg">
                                @endif
                            </div>
                            <div class="w-full ml-4">
                                <div class="flex justify-between">
                                    <div>
                                        <a href="{{ route('user.profile', $reply->fromUser->profile->username) }}" class="hover:text-red-500 hover:underline">
                                            {{ $reply->fromUser->name }}
                                            @if($reply->fromUser->profile->show_username)
                                            <br>
                                                <span class="text-red-500"> ({{ $reply->fromUser->profile->username }})</span>
                                            @endif
                                        </a>
                                    </div>
                                    <div>
                                        <p class="text-xs">{{ $reply->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="text-justify my-6">
                                    {!! nl2br($reply->comment) !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center">
                            <!-- <p class="text-red-500">No replies yet</p> -->
                        </div>
                    @endif
                </div>
                <div class="w-full flex items-end">
                    <textarea name="reply" id="reply" class="w-full border-2 border-gray-200 h-12 rounded-md" placeholder="Enter your reply here"></textarea>
                    <button class="bg-red-300 text-white px-4 py-2 h-12 rounded-md mx-2" disabled id="replyBtn">Send</button>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function() {
            $('#reply-container').scrollTop($('#reply-container')[0].scrollHeight);
        

            $('#reply').on('keyup', function() {
                const reply = $('#reply').val();
                if(reply != '') {
                    $('#replyBtn').prop('disabled', false).addClass('bg-red-500').removeClass('bg-red-300');
                } else {
                    $('#replyBtn').prop('disabled', true).addClass('bg-red-300').removeClass('bg-red-500');
                }
            });

            $('#replyBtn').on('click', function() {
            $this = $(this);
            const reply = $('#reply').val();
            const post_message_id = $('input[name="post_message_id"]').val();
            const post_id = $('input[name="post_id"]').val();
            const to = $('input[name="to"]').val();
            if(reply != '') {
                $.ajax({
                    url: "{{ route('message.reply') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        reply: reply,
                        post_message_id: post_message_id,
                        post_id: post_id,
                        to: to
                    },
                    beforeSend: function() {
                        $this.text('Sending...').attr('disabled', true).addClass('cursor-not-allowed bg-gray-400').removeClass('bg-red-500 hover:bg-red-600');
                    },
                    success: function(response) {
                        $this.text('Send').attr('disabled', false).addClass('bg-red-500 hover:bg-red-600').removeClass('cursor-not-allowed bg-gray-400');
                        if(response.success) {
                            $('#reply').val('');
                            // location.reload();
                        } else {
                            console.log(response.message);
                        }
                    }
                });
            } else {
                return;
            }
        })
        });
    </script>
@endsection