@extends('admin::layouts.app')

@section('content')
    <div class="flex">
        <div class="flex-1">
            <h1 class="text-gray-700 text-lg font-semibold pb-2 border-b border-gray-700">
                Add new category
            </h1>
        </div>
        <div class="flex-1 items-end text-right">
            <a href="{{ route('admin.category') }}" class="float-right hover:bg-blue-700 bg-blue-600 text-white font-bold py-2 px-4  rounded text-xs">
                Back
            </a>
        </div>
    </div>

    <div class="flex">
        <div class="flex-auto mt-8">
            <form action="{{ route('admin.category.store') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                        Name
                    </label>
                    <input type="text" name="name" id="name" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring focus:ring-2 focus:ring-blue-600 w-full p-2 rounded-lg" value="{{ old('name') }}" />
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="slug" class="block text-gray-700 text-sm font-bold mb-2">
                        Slug
                    </label>
                    <input type="text" name="slug" id="slug" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring focus:ring-2 focus:ring-blue-600 w-full p-2 rounded-lg" value="{{ old('slug') }}" readonly />
                    @error('slug')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                        Description
                    </label>
                    <textarea name="description" id="description" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring focus:ring-2 focus:ring-blue-600 w-full p-2 rounded-lg">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
                        Status
                    </label>
                    <select name="status" id="status" class="bg-gray-100 border-none ring-1 ring-gray-700 focus:border-none focus:ring focus:ring-2 focus:ring-blue-600 w-full p-2 rounded-lg">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
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
    </script>
@endsection