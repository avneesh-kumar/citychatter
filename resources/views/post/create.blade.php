@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <style>
        @media (max-width: 767px) {
            .form-container {
                width: 100%; /* Full width on mobile */
            }
        }
        .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
    <div class="relative lg:flex">
        <div class="w-full lg:w-3/4">
            <div class="form-container w-full p-2 lg:p-8">
                <form action="{{ route('post.store') }}" method="post" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    @if(isset($post))
                        <input type="hidden" name="id" value="{{ $post->id }}" />
                    @endif
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title
                            <span class="text-red-500"> *</span>
                        </label>
                        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required autocomplete="off" value="{{isset($post) ? $post->title : old('title') }}" placeholder="Title of your post" />
                        @if ($errors->has('title'))
                            <span class="text-red-600 text-sm">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div>
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 ">Details
                            <span class="text-red-500"> *</span>
                        </label>
                        <textarea type="content" name="content" id="content" class="h-36 whitespace-pre-line bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="Detail of your post"  >{{isset($post) ? $post->content : old('content') }}</textarea>
                        @if ($errors->has('content'))
                            <span class="text-red-600 text-sm">{{ $errors->first('content') }}</span>
                        @endif
                    </div>

                    <div>
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 ">Main Image</label>
                        <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">

                        @if(isset($post) && $post->image)
                            <img src="{{ asset($post->image) }}" class="mt-2 w-56" id="tempImage" />
                        @else
                            <img src="" class="mt-2 w-56 rounded-lg " id="tempImage" />
                        @endif
                        @if ($errors->has('image'))
                            <span class="text-red-600 text-sm">{{ $errors->first('image') }}</span>
                        @endif
                    </div>

                    <div>
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 ">Additional Images</label>
                        <input type="file" name="images[]" id="images" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" multiple>

                        <div class="mt-2 grid grid-cols-3 md:grid-cols-4 gap-4" id="tempImages">
                            @if(isset($post))
                                @foreach($post->images as $image)
                                    <div class="relative w-32 h-32 m-2">
                                        <img src="{{ asset($image->image) }}" class="max-w-32 max-h-32 w-32 h-32 rounded-lg object-cover" style="max-height: 8rem" />
                                        <input type="hidden" name="old_images[]" value="{{ $image->id }}" />
                                        <button type="button" class="h-4 w-4 absolute top-0 right-0 bg-red-500 text-white text-sm rounded-full text-center" onclick="this.parentElement.remove()" style="line-height:1" >x</button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Category
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
                        <label for="sub_category" class="block mb-2 text-sm font-medium text-gray-900 ">Sub Category
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
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 ">Location
                            <span class="text-red-500"> *</span>
                        </label>
                        <input type="text" name="location" id="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required autocomplete="off" value="{{ isset($post) ? $post->location : old('location') }}">
                        <input type="hidden" name="latitude" id="latitude" value="{{ isset($post) ? $post->latitude : old('latitude') }}" >
                        <input type="hidden" name="longitude" id="longitude" value="{{ isset($post) ? $post->longitude : old('longitude') }}">
                        @if ($errors->has('location'))
                            <span class="text-red-600 text-sm">{{ $errors->first('location') }}</span>
                        @endif
                    </div>

                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 ">Visibility
                            <span class="text-red-500"> *</span>
                        </label>
                        <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required>
                            <option value="">Select Visibility</option>
                            @if(isset($post) && $post->status == 1)
                                <option value="1" selected>Public</option>
                            @elseif(old('status') == 1)
                                <option value="1" selected>Public</option>
                            @else
                                <option value="1">Public</option>
                            @endif
                            @if(isset($post) && $post->status == 0)
                                <option value="0" selected>Private</option>
                            @elseif(old('status') === 0)
                                <option value="0" selected>Private</option>
                            @else
                                <option value="0">Private</option>
                            @endif
                        </select>
                        @if ($errors->has('status'))
                            <span class="text-red-600 text-sm">{{ $errors->first('status') }}</span>
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
        <div class="w-1/3 ">

        </div>
    </div>
    
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script> -->
    <!-- <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> -->
    <script src="https://cdn.tiny.cloud/1/cer1c08zh0qn5ttc7nhhrsuadtnur2vgr82nnll4q5rst3bs/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    
    <script>

        $(document).ready(function() {
            tinymce.init({
                selector: 'textarea',
                menubar: 'edit view format insert',
            });

            document.getElementById('image').addEventListener('change', function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('tempImage').src = e.target.result;
                }
                reader.readAsDataURL(file);
            });

            document.getElementById('images').addEventListener('change', function(e) {
                var files = e.target.files;
                var tempImages = document.getElementById('tempImages');
                var html = tempImages.innerHTML;
                if(files.length > 10) {
                    alert('You can only upload maximum 10 images');
                    this.value = '';
                    return;
                }

                for(var i = 0; i < files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        html += '<div class="relative w-32 h-32 m-2">';
                        html += '<img src="' + e.target.result + '" class="max-w-32 max-h-32 w-32 h-32 rounded-lg object-cover" style="max-height: 8rem" />';
                        html += '<button type="button" class="h-4 w-4 absolute top-0 right-0 bg-red-500 text-white text-sm rounded-full text-center" onclick="this.parentElement.remove()" style="line-height:1" >x</button>';
                        html += '</div>';

                        tempImages.innerHTML = html;
                    }
                    reader.readAsDataURL(files[i]);
                }
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

            function init() {
                var input = document.getElementById('location');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    console.log(place.geometry.location.lat());
                    console.log(place.geometry.location.lng());
                    document.getElementById('latitude').value = place.geometry.location.lat();
                    document.getElementById('longitude').value = place.geometry.location.lng();
                });
            }

            init();
        });

    </script>

@endsection