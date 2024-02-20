@extends('admin::layouts.app')

@section('content')
    <div class="flex">
        <div class="flex-1">
            <h1 class="text-gray-700 text-lg font-semibold pb-2 border-b border-gray-700">
                {{ $title }}
            </h1>
        </div>
        <div class="flex-1 items-end text-right">
            <a href="{{ $backUrl }}" class="float-right hover:bg-red-700 bg-red-600 text-white font-bold py-2 px-4  rounded text-xs">
                Back
            </a>
        </div>
    </div>

    <div class="flex">
        <div class="flex-auto mt-8">
            <form action="{{ route('admin.category.store') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ isset($category) ? $category->id : '' }}" />
                <div class="mb-4 w-1/2">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                        Name
                    </label>
                    <input type="text" name="name" id="name" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" value="{{ isset($category) ? $category->name : old('name') }}" />
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
                    <input type="text" name="slug" id="slug" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" value="{{ isset($category) ? $category->slug : old('slug') }}" />
                    @error('slug')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                        Description
                    </label>
                    <textarea name="description" id="description" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg">{{ isset($category) ? $category->description : old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
                        Status
                    </label>
                    <select name="status" id="status" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg">
                        <option value="1" {{ isset($category) && $category->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ isset($category) && $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="sort_by" class="block text-gray-700 text-sm font-bold mb-2">
                        Sort Order
                    </label>
                    <input type="number" name="sort_by" id="sort_by" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg" value="{{ isset($category) ? $category->sort_by : old('sort_by') }}" />
                    @error('sort_by')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4 w-1/2">
                    <label for="parent_id" class="block text-gray-700 text-sm font-bold mb-2">
                        Parent Category
                    </label>
                    <select name="parent_id" id="parent_id" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none  focus:ring-red-500 focus:ring-2 w-full p-2 rounded-lg">
                        <option value="">Select Parent Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ isset($category) && $category->parent_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-500 font-bold py-2 px-4 rounded text-xs">
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
    </script>
@endsection