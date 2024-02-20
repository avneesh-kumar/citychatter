@extends('layouts.app')

@section('content')
    <style>
        @media (max-width: 767px) {
            .form-container {
                width: 100%; /* Full width on mobile */
            }
        }
    </style>
    <!-- create a div and center its content -->
    <div class="flex justify-center">
        <div class="form-container w-1/2">
            <form action="{{ route('post.store') }}" method="post" class="space-y-4" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title
                        <span class="text-red-500"> *</span>
                    </label>
                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required autocomplete="off" value="{{isset($post) ? $post->title : old('title') }}" />
                    <input type="hidden" name="slug" id="slug" value="{{ old('slug') }}" />
                    @if ($errors->has('title'))
                        <span class="text-red-600 text-sm">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div>
                    <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Details
                        <span class="text-red-500"> *</span>
                    </label>
                    <textarea type="content" name="content" id="content" class="h-36 whitespace-pre-line bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required>{{isset($post) ? $post->content : old('content') }}</textarea>
                    @if ($errors->has('content'))
                        <span class="text-red-600 text-sm">{{ $errors->first('content') }}</span>
                    @endif
                </div>

                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image
                        <span class="text-red-500"> *</span>
                    </label>
                    <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required multiple>
                    @if(isset($post))
                        <img src="{{ asset($post->image) }}" class="mt-2 w-56" />
                    @endif
                    @if ($errors->has('image'))
                        <span class="text-red-600 text-sm">{{ $errors->first('image') }}</span>
                    @endif
                </div>

                <div id="images">
                    @if(isset($post))
                        @foreach($post->images as $image)
                            <div class="mt-4">
                                <img src="{{ asset($image->image) }}" class="w-56" />
                            </div>
                        @endforeach
                    @endif
                </div>
                
                <div>
                    <button type="button" id="addImageBtn" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">Add Image</button>
                </div>

                <div>
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                        <span class="text-red-500"> *</span>
                    </label>
                    <select name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            @if(isset($post) && $category->id == $post->category_id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @elseif($category->id == old('category'))
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('category'))
                        <span class="text-red-600 text-sm">{{ $errors->first('category') }}</span>
                    @endif
                </div>

                <div class="hidden" id="child-category-block">
                    <label for="sub_category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub Category
                        <span class="text-red-500"> *</span>
                    </label>
                    <select name="sub_category" id="sub_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5>
                        <option value="">Select Sub Category</option>
                    </select>
                    @if ($errors->has('sub_category'))
                        <span class="text-red-600 text-sm">{{ $errors->first('sub_category') }}</span>
                    @endif
                </div>

                <div>
                    <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location
                        <span class="text-red-500"> *</span>
                    </label>
                    <input type="text" name="location" id="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required autocomplete="off" value="{{ isset($post) ? $post->location : old('location') }}">
                    <input type="hidden" name="latitude" value="{{ isset($post) ? $post->latitude : '' }}" >
                    <input type="hidden" name="longitude" value="{{ isset($post) ? $post->longitude : '' }}">
                    @if ($errors->has('location'))
                        <span class="text-red-600 text-sm">{{ $errors->first('location') }}</span>
                    @endif
                </div>

                <div>
                    <label for="visibility" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Visibility
                        <span class="text-red-500"> *</span>
                    </label>
                    <select name="visibility" id="visibility" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required>
                        <option value="">Select Visibility</option>
                        @if(isset($post) && $post->visibility == 1)
                            <option value="1" selected>Public</option>
                        @elseif(old('visibility') == 1)
                            <option value="1" selected>Public</option>
                        @else
                            <option value="1">Public</option>
                        @endif
                        @if(isset($post) && $post->visibility == 0)
                            <option value="0" selected>Private</option>
                        @elseif(old('visibility') == 0)
                            <option value="0" selected>Private</option>
                        @else
                            <option value="0">Private</option>
                        @endif
                    </select>
                    @if ($errors->has('visibility'))
                        <span class="text-red-600 text-sm">{{ $errors->first('visibility') }}</span>
                    @endif
                </div>

                <div class="text-right">
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.getElementById('addImageBtn').addEventListener('click', function(e) {
            var html = '<div class="mt-4"><input type="file" name="images[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required></div>';
            document.getElementById('images').insertAdjacentHTML('beforeend', html);
        });

        @if(isset($post) && $post->category->parent_id)
            document.getElementById('child-category-block').classList.remove('hidden');
            document.getElementById('category').value = {{ $post->category->parent_id }};
            $.ajax({
                url: "{{ route('category.search') }}",
                type: 'GET',
                data: {
                    id: {{ $post->category->parent_id }}
                },
                success: function(response) {
                    if(response.status) {
                        var html = '<option value="">Select Sub Category</option>';
                        response.categories.forEach(function(category) {
                            if(category.id == {{ $post->category->id }}) {
                                html += '<option value="' + category.id + '" selected>' + category.name + '</option>';
                            } else {
                                html += '<option value="' + category.id + '">' + category.name + '</option>';
                            }
                        });
                        document.getElementById('sub_category').innerHTML = html;
                    }
                }
            });
            document.getElementById('sub_category').value = {{ $post->category_id }};
        @endif

        document.getElementById('category').addEventListener('change', function(e) {
            $.ajax({
                url: "{{ route('category.search') }}",
                type: 'GET',
                data: {
                    id: this.value
                },
                success: function(response) {
                    if(response.status) {
                        var html = '<option value="">Select Sub Category</option>';
                        response.categories.forEach(function(category) {
                            html += '<option value="' + category.id + '">' + category.name + '</option>';
                        });
                        document.getElementById('child-category-block').classList.remove('hidden');
                        document.getElementById('sub_category').innerHTML = html;
                    } else {
                        document.getElementById('child-category-block').classList.add('hidden');
                    }
                }
            }); 
        });
    </script>

    <script>
        document.getElementById('title').addEventListener('keyup', function(e) {
            document.getElementById('slug').value = slugify(this.value);
        });

        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        }

    </script>
    <script>
        function initAutocomplete() {
            var input = document.getElementById('location');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                document.getElementsByName('latitude')[0].value = place.geometry.location.lat();
                document.getElementsByName('longitude')[0].value = place.geometry.location.lng();
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&libraries=places&callback=initAutocomplete" async defer></script>

@endsection