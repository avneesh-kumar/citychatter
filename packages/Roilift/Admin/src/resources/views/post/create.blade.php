@extends('admin::layouts.app')
<style>
    .ck-editor__editable[role="textbox"] {
        min-height: 300px;
    }
</style>
@section('content')
    <div class="flex">
        <div class="flex-1">
            <h1 class="text-gray-700 text-lg font-semibold pb-2 border-b border-gray-700">
                {{ $title }}
            </h1>
        </div>
        <div class="flex-1 items-end text-right">
            <a href="{{ $backUrl }}" class="float-right hover:bg-blue-700 bg-blue-600 text-white font-bold py-2 px-4  rounded text-xs">
                Back
            </a>
        </div>
    </div>

    <div class="flex">
        <div class="flex-auto mt-8">
            <form action="{{ route('admin.post.store') }}" method="post">
                @csrf
                <div class="mb-4 w-1/2">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                        Name
                    </label>
                    <input type="text" name="name" id="name" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring focus:ring-2 focus:ring-blue-600 w-full p-2 rounded-lg" value="{{ isset($post) ? $post->name : old('name') }}" />
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="slug" class="block text-gray-700 text-sm font-bold mb-2">
                        Slug
                    </label>
                    <input type="text" name="slug" id="slug" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring-2 focus:ring-blue-600 w-full p-2 rounded-lg" value="{{ isset($post) ? $post->slug : old('slug') }}" />
                    @error('slug')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <!-- image upload section -->
                <div class="mb-4 w-1/2">
                    <label for="image" class="block text-blue-700 text-sm font-bold mb-2">
                        Image
                    </label>
                    <input type="file" name="image" id="image" class="bg-blue-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring-2 focus:ring-blue-600 w-full p-2 rounded-lg " />
                    @error('image')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                    @if(isset($post) && $post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->name }}" class="w-1/2 mt-4" />
                    @endif
                </div>
                <div class="mb-4 w-1/2">
                    <label for="content" class="block text-gray-700 text-sm font-bold mb-2">
                        Content
                    </label>
                    <textarea name="content" id="content" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring focus:ring-2 focus:ring-blue-600 w-full p-2 rounded-lg">{{ isset($post) ? $post->content : old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4 w-1/2">
                    <label for="user" class="block text-gray-700 text-sm font-bold mb-2">
                        User
                    </label>
                    <input type="hidden" name="user_id" id="user_id" />
                    <input type="text" name="user" id="user" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring-2 focus:ring-blue-600 w-full p-2 rounded-lg" value="{{ isset($post) ? $post->user : old('user') }}" />
                    <div class="select-dropdown hidden absolute bg-gray-100 mt-1 p-4 rounded-md w-1/3 shadow">
                        <ul></ul>
                    </div>
                    @error('user')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4 w-1/2">
                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
                        Status
                    </label>
                    <select name="status" id="status" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring focus:ring-2 focus:ring-blue-600 w-full p-2 rounded-lg">
                        <option value="1" {{ isset($category) && $category->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ isset($category) && $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <button type="submit" class="text-white bg-blue-600 hover:bg-blue-500 font-bold py-2 px-4 rounded text-xs">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let slug = document.querySelector('#slug');
        let name = document.querySelector('#name');

        name.addEventListener('keyup', function() {
            slug.value = name.value.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        });

        $('#user').on('keyup', function() {
            let q = $(this).val();
            $('.select-dropdown').removeClass('hidden');
            $.ajax({
                url: "{{ route('admin.user.get') }}",
                dataType: 'json',
                type: 'GET',
                data: {q: q},
                success: function(response) {
                    if(response.success) {
                        let html = '';
                        $.each(response.data, function(index, value) {
                            html += '<li class="cursor-pointer hover:underline line-value pb-2" data-id="'+value.id+'" data-text="'+value.text+'" onclick="setTextId(this)" >' + value.text + ' (' + value.email + ')</li>';
                        });
                        $('.select-dropdown ul').html(html);
                    }
                },
                error : function(jqXHR,errorThrown,status) {console.log(jqXHR.responseText)}
            });
        });

        function setTextId(thisObj) {
            let id = $(thisObj).data('id');
            $('#user_id').val(id);
            let text = $(thisObj).data('text');
            $('#user').val(text);
            $('.select-dropdown').addClass('hidden');
        }

    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection