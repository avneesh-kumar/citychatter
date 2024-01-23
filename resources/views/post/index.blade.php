@extends('layouts.app')

@section('content')

<!-- <div>
    <a href="{{ url()->previous() }}" class="text-red-600 hover:underline">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
    </a>
</div> -->
<div class="md:flex">
    <div class="md:flex-1 flex-auto">
        <div class="flex p-8">
            <div class="flex-none">
                <a href="{{ route('user.profile', $post->user->profile->username) }}">
                    @if($post->user->profile->avatar)
                        <img src="{{ asset($post->user->profile->avatar) }}" alt="{{ $post->user->name }}" class="w-12 h-12 shadow-xl rounded-full object-cover">
                    @else
                        <img src="{{ asset('images/avatar.jpg') }}" alt="{{ $post->user->name }}" class="w-12 h-12 shadow-xl rounded-full object-cover">
                    @endif
                </a>
            </div>
            <div class="flex-auto ml-2 max-w-4xl" >
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
                    <a href="{{ route('post', $post->slug) }}" class="text-red-600">
                        {{ $post->title }}
                    </a>
                </div>
                <div class="flex-none h-auto ">
                    <a href="{{ route('post', $post->slug) }}">
                        <img src="{{ asset($post->image) }}" alt="" class="object-cover w-full h-full">
                    </a>
                    <div class="text-sm my-2 h-auto text-justify">
                        {!! nl2br($post->content) !!}
                    </div>
                </div>

                <div class="p-2">
                    <div class="my-4 border-b-2">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="text-left">
                                <span id="likeCount">{{ $post->postLikes->count() }}</span> Likes
                            </div>
                            <div class="text-center">
                                <span class="">
                                    {{ $post->postComments->count() }} Comments
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="my-4 ">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="text-left">
                                @if($like)
                                    <span class="text-blue-500 cursor-pointer" id="unlikeBtn">
                                        Liked
                                    </span>
                                    <span class="hidden cursor-pointer" id="likeBtn">
                                        Like
                                    </span>
                                @else
                                    <span class="hidden text-blue-500 cursor-pointer" id="unlikeBtn">
                                        Liked
                                    </span>
                                    <span class="cursor-pointer" id="likeBtn">
                                        Like
                                    </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <span class="cursor-pointer" id="commentBtn">
                                    Comment
                                </span>
                            </div>
                            <div class="text-right">    
                                <span class="cursor-pointer" >
                                    Share
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="my-4 border-t-2">
                        <div class="grid grid-cols-2">
                            <div class="text-left">
                                <span class="text-gray-400 ">
                                    {{ $post['location'] }}
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-gray-400 ">
                                    <!-- {{ date('d M Y h:m:i', strtotime($post['created_at']))  }} -->
                                    {{ $post->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="w-full mt-8 hidden" id="commentingsection">
                        <textarea name="comment" id="comment" class="whitespace-pre-line h-28 w-full border-none ring-2 ring-blue-600 shadow-md text-gray-700 focus:ring-2 rounded-sm"></textarea>
                        <div>
                            <span class="text-red-500 hidden" id="commentError">
                                Please fill comment box
                            </span>
                        </div>
                        <div class="text-right">
                            <button type="button" class="px-4 py-2 bg-blue-500 text-white shadow-sm rounded-md" id="commentSubmitBtn">Comment</button>
                        </div>
                    </div>
                    <div class="w-full ">
                        @if($post->postComments)
                            @foreach($post->postComments as $comment)
                                <div class="p-2 shadow-sm rounded-sm">
                                    <div class="flex">
                                        @if($comment->user->profile->avatar)
                                            <img src="{{ asset($comment->user->profile->avatar) }}" alt="{{ $comment->user->name }}" class="shadow-xl rounded-full object-cover w-8 h-8">
                                        @else
                                            <img src="{{ asset('images/avatar.jpg') }}" alt="{{ $comment->user->name }}" class="shadow-xl rounded-full object-cover w-8 h-8">
                                        @endif
                                        <div class="ml-2">
                                            <span class="text-red-600">
                                                <a href="{{ route('user.profile', $comment->user->profile->username) }}">
                                                    {{ $comment->user->name }}
                                                </a>
                                            </span> <br>
                                            <span class="text-gray-600 font-normal text-xs ">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </span><br />
                                            <span>{{ $comment['comment'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div>
                                No comments
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-1/4 border-2 border-gray-900">
        <div class="text-center">
            Advertisement
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#commentBtn').click(function() {
            $('#commentingsection').removeClass('hidden');
        });

        $('#likeBtn').click(function() {
            $.ajax({
                url: "{{ route('post.like') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "post_id": "{{ $post['id'] }}",
                },
                success: function(response) {
                    if(response.success) {
                        $('#likeBtn').addClass('hidden');
                        $('#unlikeBtn').removeClass('hidden');
                        let likes = parseInt($('#likeCount').text());
                        $('#likeCount').text(likes + 1);
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        $('#unlikeBtn').click(function() {
            $.ajax({
                url: "{{ route('post.unlike') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "post_id": "{{ $post['id'] }}",
                },
                success: function(response) {
                    if(response.success) {
                        $('#unlikeBtn').addClass('hidden');
                        $('#likeBtn').removeClass('hidden');
                        let likes = parseInt($('#likeCount').text());
                        $('#likeCount').text(likes - 1);
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        $('#commentSubmitBtn').click(function() {
            var comment = $('#comment').val();
            if(comment == '') {
                $('#commentError').removeClass('hidden');
                return false;
            }
            $.ajax({
                url: "{{ route('post.comment') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "post_id": "{{ $post['id'] }}",
                    "comment": comment,
                },
                success: function(response) {
                    if(response.success) {
                        $('#comment').val('');
                        $('#commentingsection').addClass('hidden');
                        location.reload();
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

    });

    
</script>
@endsection