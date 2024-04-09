@extends('layouts.app')

@section('content')

<!-- <div>
    <a href="{{ url()->previous() }}" class="text-red-600 hover:underline">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
    </a>
</div> -->
<!-- create next and previous buttons -->
<div class="md:flex">
    <div class="md:flex-1 flex-auto">
        <div class="flex justify-between">
            <div>
                @if($previousPost)
                    <a href="{{ route('post', $previousPost->slug) }}" class="text-red-600 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                @endif
            </div>
            <div class="mr-8">
                @if($nextPost)
                    <a href="{{ route('post', $nextPost->slug) }}" class="text-red-600 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @endif
            </div>
        </div>
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
                        <div class="grid grid-cols-2 ">
                            <div>
                                <div class="font-semibold">
                                    <a href="{{ route('user.profile', $post->user->profile->username) }}" class="text-red-600 hover:underline">
                                        {{ $post->user->name }}
                                    </a>
                                </div>
                                <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="text-right">
                                @if(auth()->user()->id != $post->user->id)
                                    <button class="py-1 px-2 text-white bg-red-500 border border-transparent rounded-md shadow-sm hover:bg-red-600 focus:outline-none" data-modal-target="message-modal" data-modal-toggle="message-modal">Message</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-xl my-2">
                    <a href="{{ route('post', $post->slug) }}" class="text-red-600">
                        {{ $post->title }}
                    </a>
                </div>
                <div class="flex-none h-auto ">
                    @if($post->image)
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
                        <style>
                            .swiper-button-prev {
                                color: #ff0000;
                            }

                            .swiper-button-next {
                                color: #ff0000;
                            }
                        </style>
                        <div class="swiper mySwiper relative h-56 overflow-hidden rounded-lg md:h-96">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img src="{{ asset($post->image) }}" class="object-cover "></div>
                                @foreach($post->images as $image)
                                    <div class="swiper-slide"><img src="{{ asset($image->image) }}" class="object-cover "></div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    @endif
                    <div class="text-sm my-8 h-auto text-justify">
                        {!! nl2br($post->content) !!}
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

                <div class="my-4">
                    <div id="map" class="w-full h-96"></div>
                </div>

                <div class="p-2">
                    <div class="my-4 border-b-2">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-left">
                                <span id="likeCount">{{ $post->postLikes->count() }}</span> Likes
                            </div>
                            <div class="text-right">
                                <span class="">
                                    {{ $post->postComments->count() }} Comments
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="my-4 ">
                        <div class="grid grid-cols-2 gap-4">
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
                            <div class="text-right">
                                <span class="cursor-pointer" id="commentBtn">
                                    Comment
                                </span>
                            </div>
                            <!-- <div class="text-right">    
                                <span class="cursor-pointer" >
                                    Share
                                </span>
                            </div> -->
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
                            <button type="button" class="px-4 py-2 bg-red-500 text-white shadow-sm rounded-md" id="commentSubmitBtn">Comment</button>
                        </div>
                    </div>
                    <div class="w-full ">
                        @if($post->postComments)
                            @foreach($post->postComments as $comment)
                                <div class="p-2 shadow-lg rounded-sm">
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
                                    <div>
                                        @if($comment->replies->count() > 0)
                                            <div id="commentreplyTogglebtn-{{ $comment->id }}" class="commentreplyTogglebtn inline-block bg-red-500 text-white p-2 mt-2 text-xs rounded-md cursor-pointer  " style="margin-left: 36px;">Show Replies</div>
                                        @endif
                                        <div id="commentreplybtn-{{ $comment->id }}" class="commentreplybtn inline-block bg-red-500 text-white p-2 mt-2 text-xs rounded-md cursor-pointer  " style="margin-left: 36px;">Reply</div>
                                        <div id="commentreplytextarea-{{ $comment->id }}" class="commentreplytextarea hidden mt-2" style="margin-left: 36px;">
                                            <textarea name="comment" id="comment" class="whitespace-pre-line h-28 w-full border-none ring-2 ring-blue-600 shadow-md text-gray-700 focus:ring-2 rounded-sm"></textarea>
                                            <div>
                                                <span class="text-red-500 hidden" id="commentError-{{ $comment->id }}">
                                                    Please fill reply box
                                                </span>
                                            </div>
                                            <div class="text-right mt-2">
                                                <button type="button" class="commentReplySubmitBtn px-4 py-2 bg-red-500 text-white shadow-sm rounded-md text-xs" id="commentReplySubmitBtn-{{ $comment->id }}">Comment</button>
                                            </div>
                                        </div>
                                        <div class="hidden commentreplyToggleArea" id="commentreplyToggleArea-{{ $comment->id }}">
                                            <div class="p-2 shadow rounded-sm mt-2" id="commentReplyBox-{{ $comment->id }} ">
                                                @foreach($comment->replies as $reply)
                                                    <div class="flex">
                                                        @if($reply->user->profile->avatar)
                                                            <img src="{{ asset($reply->user->profile->avatar) }}" alt="{{ $reply->user->name }}" class="shadow-xl rounded-full object-cover w-8 h-8">
                                                        @else
                                                            <img src="{{ asset('images/avatar.jpg') }}" alt="{{ $reply->user->name }}" class="shadow-xl rounded-full object-cover w-8 h-8">
                                                        @endif
                                                        <div class="ml-2">
                                                            <span class="text-red-600">
                                                                <a href="{{ route('user.profile', $reply->user->profile->username) }}">
                                                                    {{ $reply->user->name }}
                                                                </a>
                                                            </span> <br>
                                                            <span class="text-gray-600 font-normal text-xs ">
                                                                {{ $reply->created_at->diffForHumans() }}
                                                            </span><br />
                                                            <span>
                                                                {{ $reply->reply }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
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



<!-- Modal for messaging -->
@if(auth()->user()->id != $post->user->id)
    <div id="message-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-red-600 dark:text-white">
                        Send message to - 
                        <a href="{{ route('user.profile', $post->user->profile->username) }}" class="text-red-600 hover:underline">
                            {{ $post->user->name }}
                        </a>
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="message-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div id="modal-message-block" class="text-center text-lg text-red-600 p-2"></div>
                <form class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="post_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post Title</label>
                            <input type="text" readonly name="post_title" id="post_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" value="{{ $post->title }}" >
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="user_to" value="{{ $post->user->id }}">
                        </div>
                        <div class="col-span-2">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Message
                                <span class="text-red-500"> *</span>
                            </label>
                            <textarea id="message" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="Enter your message here" required></textarea>                    
                        </div>
                        <span id="messageError" class="text-red-600 text-sm"></span>
                    </div>
                    <button type="button" id="sendMessageBtn" class="py-1 px-2 text-white bg-red-500 border border-transparent rounded-md shadow-sm hover:bg-red-600 focus:outline-none">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>

<script>
    $(document).ready(function() {

        // loading map for the post location
        var map;
        var lat = {{ $post->latitude }};
        var lng = {{ $post->longitude }};
        
        // addEventListener('DOMContentLoaded', initMap);

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: lat, lng: lng},
                zoom: 10
            });
        }

        initMap();
        // end here
        
        $('.postImage').click(function() {
            let src = $(this).attr('src');
            $('#mainImage').attr('src', src);
        });

        $('#commentBtn').click(function() {
            $('#commentingsection').removeClass('hidden');
        });

        $('.commentreplybtn').click(function() {
            let id = $(this).attr('id').split('-')[1];
            $('.commentreplytextarea').addClass('hidden');
            $('#commentreplytextarea-' + id).removeClass('hidden');
        });

        $('.commentreplyTogglebtn').click(function() {
            let id = $(this).attr('id').split('-')[1];
            $('.commentreplyToggleArea').addClass('hidden');
            $('#commentreplyToggleArea-' + id).toggleClass('hidden');
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

        $('.commentReplySubmitBtn').click(function() {
            var id = $(this).attr('id').split('-')[1];
            var comment = $('#commentreplytextarea-' + id + ' textarea').val();
            if(comment == '') {
                $('#commentError-' + id).removeClass('hidden');
                return false;
            }
            $.ajax({
                url: "{{ route('post.comment.reply') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "post_comment_id": id,
                    "reply": comment,
                },
                success: function(response) {
                    if(response.success) {
                        $('#commentreplytextarea-' + id + ' textarea').val('');
                        $('#commentreplytextarea-' + id).addClass('hidden');
                        location.reload();
                    } else {
                        $('#commentError-' + id).text(response.message).removeClass('hidden');
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        $('#sendMessageBtn').click(function() {
            const $this = $(this);
            var post_id = $('input[name="post_id"]').val();
            var user_to = $('input[name="user_to"]').val();
            var message = $('#message').val();
            if(message == '') {
                $('#messageError').html('Please enter a message');
                return false;
            }
            $.ajax({
                url: "{{ route('message.send') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "post_id": post_id,
                    "user_to": user_to,
                    "message": message,
                },
                beforeSend: function() {
                    $('#messageError').addClass('hidden');
                    $this.text('Sending...').attr('disabled', true).addClass('cursor-not-allowed bg-gray-400').removeClass('bg-red-500 hover:bg-red-600');
                },
                success: function(response) {
                    $this.text('Send').attr('disabled', false).removeClass('cursor-not-allowed bg-gray-400').addClass('bg-red-500 hover:bg-red-600');
                    if(response.success) {
                        $('#message').val('');
                        $('#modal-message-block').html(response.message);
                        setTimeout(function() {
                            $('#modal-message-block').html('');
                        }, 3000);
                    } else {
                        $('#messageError').html(response.message);
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