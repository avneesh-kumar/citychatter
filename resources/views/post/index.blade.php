@extends('layouts.app')

@section('content')
<div>
    <a href="{{ url()->previous() }}" class="text-red-600 hover:underline">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
    </a>
</div>
<div class="grid lg:grid-cols-1 md:grid-cols-2 grid-cols-1 gap-0 mb-4"> 
    <div class="h-auto mb-4 ">
        <div class="mb-4">
            <div class="flex">
                <img src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="" class="rounded-full w-12 h-12">
                <div class="ml-2">
                    <a href="{{ route('user.profile') }}" class="text-red-600 hover:underline align-baseline ">
                        {{ $post->user->name }}
                    </a>
                    <div class="text-xs text-gray-500">
                        {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <h1 class="text-2xl text-red-700">
                {{ $post["title"] }}
            </h1>
        </div>
        <div class="items-center justify-center h-auto shadow-lg bg-gray-50">
            <img class="object-cover w-full h-full" src="{{ asset($post['image']) }}" alt="{{ $post['title'] }}" />
        </div>
        <div class="mt-4">
            <p class="text-gray-700 text-justify">
                {!! $post["content"] !!}
            </p>
        </div>
        <div class="p-2">
            <div class="my-4 border-b-2">
                <div class="grid grid-cols-3 gap-4">
                    <div class="text-left">
                        {{ $post->postLikes->count() }} Likes
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
                            {{ date('d M Y h:m:i', strtotime($post['created_at']))  }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="w-full mt-8 hidden" id="commentingsection">
                <textarea name="comment" id="comment" class="whitespace-pre-line h-28 w-full border-none ring-2 ring-blue-600 shadow-md text-gray-700 focus:ring-2 rounded-sm"></textarea>
                <!-- show error to fill comment box -->
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
                                <img src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="" class="w-8 h-8 object-cover">
                                <div class="ml-2">
                                    <span class="text-red-600">
                                        <a href="{{ route('user.profile') }}">
                                            {{ $comment->user->name }}
                                        </a>
                                    </span> <br>
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