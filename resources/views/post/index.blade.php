@extends('layouts.app')

@section('content')
<div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-3 mb-4">
    <div class="h-auto mb-4 ">
        <div class="mb-4">
            <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                {{ $post["title"] }}
            </h1>
        </div>
        <div class="items-center justify-center h-auto shadow-lg bg-gray-50">
            <img class="object-cover w-full h-full" src="{{ asset($post['image']) }}" alt="{{ $post['title'] }}" />
        </div>
        <!-- <div class="grid lg:grid-cols-6 md:grid-cols-4 grid-cols-3 gap-1 m-4">
            <div class="flex items-center justify-center h-auto shadow-lg">
                <img class="object-cover w-full h-full" src="{{ $post['image'] }}" alt="{{ $post['title'] }}" />
            </div>
            <div class="flex items-center justify-center h-auto shadow-lg">
                <img class="object-cover w-full h-full" src="{{ $post['image'] }}" alt="{{ $post['title'] }}" />
            </div>
            <div class="flex items-center justify-center h-auto shadow-lg">
                <img class="object-cover w-full h-full" src="{{ $post['image'] }}" alt="{{ $post['title'] }}" />
            </div>
            <div class="flex items-center justify-center h-auto shadow-lg">
                <img class="object-cover w-full h-full" src="{{ $post['image'] }}" alt="{{ $post['title'] }}" />
            </div>
            <div class="flex items-center justify-center h-auto shadow-lg">
                <img class="object-cover w-full h-full" src="{{ $post['image'] }}" alt="{{ $post['title'] }}" />
            </div>
            <div class="flex items-center justify-center h-auto shadow-lg">
                <img class="object-cover w-full h-full" src="{{ $post['image'] }}" alt="{{ $post['title'] }}" />
            </div>
            <div class="flex items-center justify-center h-auto shadow-lg">
                <img class="object-cover w-full h-full" src="{{ $post['image'] }}" alt="{{ $post['title'] }}" />
            </div>
        </div> -->
        <div class="mt-4">
            <p class="text-gray-700 dark:text-gray-300">
                {{ $post["content"] }}
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

            <!-- show comments  -->
            <div class="w-full ">
                @foreach($post->postComments as $comment)
                    <div class="p-2 shadow-sm rounded-sm">
                        <div class="flex">
                            <img src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="" class="w-8 h-8 object-cover">
                            <div class="ml-2">
                                <span class="text-red-600">{{ $comment->user->name }}</span> <br>
                                <span>{{ $comment['comment'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="h-auto mb-4 ">
        <div class="flex items-center justify-center">
            <div class="w-1/2 p-4 shadow-lg">
                <div class="flex justify-center">
                    <img src="https://st3.depositphotos.com/15648834/17930/v/450/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" class="h-36 w-36 rounded-full shadow-md" alt="">
                </div>
                <div class="block text-center">
                    <a href="{{ route('user.profile') }}">
                        <h1 class="text-xl font-bold text-red-400 mt-2">
                            Avneesh kumar
                        </h1>
                    </a>
                    <p class="text-gray-700 ">
                        avneesh@roilift.com
                    </p>
                </div>
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